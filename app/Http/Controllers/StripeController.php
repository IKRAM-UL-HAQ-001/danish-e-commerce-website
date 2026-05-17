<?php

namespace App\Http\Controllers;

use App\Mail\OrderPaymentStatusMail;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use Stripe\Webhook;
use Throwable;

class StripeController extends Controller
{
    public function index()
    {
        return view('stripe');
    }

    public function checkout(Request $request)
    {
        $cart = session('cart', []);

        if (empty($cart)) {
            return redirect()->back()->with('error', 'Your cart is empty.');
        }

        $stripeSecret = config('services.stripe.secret');

        if (!$stripeSecret) {
            return redirect()->back()->with('error', 'Stripe is not configured yet.');
        }

        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'company' => ['nullable', 'string', 'max:255'],
            'country' => ['required', 'string', 'max:255'],
            'address_line_1' => ['required', 'string', 'max:255'],
            'address_line_2' => ['nullable', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'state' => ['required', 'string', 'max:255'],
            'zip_code' => ['required', 'string', 'max:50'],
            'phone' => ['required', 'string', 'max:50'],
            'email' => ['required', 'email', 'max:255'],
            'order_notes' => ['nullable', 'string', 'max:2000'],
        ]);

        $settings = Setting::all()->pluck('value', 'key');
        $shipping = floatval($settings['shipping_cost'] ?? 8.00);
        $subtotal = collect($cart)->sum(fn ($details) => floatval($details['price']) * intval($details['quantity']));

        // Apply coupon from session
        $discount = 0;
        $couponCode = null;
        $appliedCoupon = session('applied_coupon');

        if ($appliedCoupon) {
            $coupon = Coupon::where('code', $appliedCoupon['code'])->where('status', true)->first();
            if ($coupon
                && (!$coupon->expiry_date || now()->lte($coupon->expiry_date))
                && (!$coupon->usage_limit || $coupon->used_count < $coupon->usage_limit)
            ) {
                $discount = $coupon->type === 'percent'
                    ? round($subtotal * ($coupon->value / 100), 2)
                    : min(floatval($coupon->value), $subtotal);
                $couponCode = $coupon->code;
            }
        }

        $total = max(0, $subtotal + $shipping - $discount);

        try {
            $order = DB::transaction(function () use ($request, $cart, $total, $discount, $couponCode) {
                $order = Order::create([
                    'user_id'         => Auth::id(),
                    'customer_name'   => trim($request->input('first_name') . ' ' . $request->input('last_name')),
                    'customer_email'  => $request->input('email'),
                    'customer_phone'  => $request->input('phone'),
                    'total_price'     => $total,
                    'status'          => 'pending',
                    'shipping_address'=> $this->formatSubmittedAddress($request),
                    'coupon_code'     => $couponCode,
                    'discount_amount' => $discount > 0 ? $discount : null,
                ]);

                foreach ($cart as $productId => $details) {
                    $order->items()->create([
                        'product_id' => $productId,
                        'quantity' => max(1, intval($details['quantity'])),
                        'price' => floatval($details['price']),
                    ]);
                }

                // Increment coupon usage count
                if ($couponCode) {
                    Coupon::where('code', $couponCode)->increment('used_count');
                    session()->forget('applied_coupon');
                }

                return $order;
            });
        } catch (Throwable $exception) {
            Log::error('Unable to create local order for Stripe checkout.', [
                'message' => $exception->getMessage(),
            ]);

            return redirect()->back()->with('error', 'Unable to create your order. Please try again.');
        }

        Stripe::setApiKey($stripeSecret);

        $lineItems = $this->buildLineItems($cart, $shipping, $settings['shipping_location'] ?? 'Standard');

        try {
            $session = Session::create([
                'payment_method_types' => ['card'],
                'line_items' => $lineItems,
                'mode' => 'payment',
                'client_reference_id' => $order->order_number,
                'metadata' => [
                    'order_id' => (string) $order->id,
                    'order_number' => $order->order_number,
                ],
                'billing_address_collection' => 'required',
                'phone_number_collection' => [
                    'enabled' => true,
                ],
                'customer_email' => $request->input('email'),
                'success_url' => route('stripe.success') . '?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('stripe.cancel') . '?order_number=' . urlencode($order->order_number),
            ]);

            $order->update([
                'stripe_checkout_session_id' => $session->id,
            ]);
        } catch (Throwable $exception) {
            Log::error('Unable to create Stripe Checkout session.', [
                'order_number' => $order->order_number,
                'message' => $exception->getMessage(),
            ]);

            $order->update(['status' => 'cancelled']);

            return redirect()->back()->with('error', 'Unable to start Stripe Checkout. Please try again.');
        }

        return redirect()->away($session->url);
    }

    public function success(Request $request)
    {
        if (!$request->filled('session_id')) {
            return redirect()->route('public.checkout')->with('error', 'Stripe checkout session was not found.');
        }

        try {
            $stripeSecret = config('services.stripe.secret');
            \Stripe\Stripe::setApiKey($stripeSecret);
            
            $session = \Stripe\Checkout\Session::retrieve($request->session_id);
            
            if ($session && $session->payment_status === 'paid') {
                $orderNumber = $session->metadata->order_number ?? null;
                if ($orderNumber) {
                    $order = Order::where('order_number', $orderNumber)->first();
                    if ($order && $order->status === 'pending') {
                        $order->update([
                            'status' => 'completed',
                            'stripe_payment_intent_id' => $session->payment_intent ?? $order->stripe_payment_intent_id,
                            'shipping_address' => $this->formatStripeCustomerDetails($session) ?: $order->shipping_address,
                        ]);
                        $this->sendPaymentStatusEmail($order, 'success');
                    }
                }
            }
        } catch (\Throwable $e) {
            Log::error('Error verifying Stripe session in success route: ' . $e->getMessage());
        }

        session()->forget('cart');

        return redirect()->route('public.shop')->with('success', 'Payment successful. Thank you for your order!');
    }

    public function cancel(Request $request)
    {
        if ($request->filled('order_number')) {
            Order::where('order_number', $request->order_number)
                ->where('status', 'pending')
                ->update(['status' => 'cancelled']);
        }

        return redirect()->route('public.checkout')->with('error', 'Payment cancelled. Your cart is still available.');
    }

    public function webhook(Request $request)
    {
        $payload = $request->getContent();
        $signature = $request->header('Stripe-Signature');
        $webhookSecret = config('services.stripe.webhook_secret');

        if (!$webhookSecret) {
            Log::error('Stripe webhook secret is not configured.');

            return response('Webhook secret is not configured.', 400);
        }

        try {
            $event = Webhook::constructEvent($payload, $signature, $webhookSecret);
        } catch (Throwable $exception) {
            Log::warning('Stripe webhook signature verification failed.', [
                'message' => $exception->getMessage(),
            ]);

            return response('Invalid Stripe webhook payload.', 400);
        }

        match ($event->type) {
            'checkout.session.completed' => $this->handleCheckoutSessionCompleted($event->data->object),
            'checkout.session.expired'   => $this->handleCheckoutSessionExpired($event->data->object),
            default                      => null,
        };

        return response('Webhook handled.', 200);
    }

    private function buildLineItems(array $cart, float $shipping, string $shippingLocation): array
    {
        $lineItems = [];

        foreach ($cart as $details) {
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => $details['name'],
                    ],
                    'unit_amount' => (int) round(floatval($details['price']) * 100),
                ],
                'quantity' => max(1, intval($details['quantity'])),
            ];
        }

        if ($shipping > 0) {
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => 'Flat Rate Shipping (' . $shippingLocation . ')',
                    ],
                    'unit_amount' => (int) round($shipping * 100),
                ],
                'quantity' => 1,
            ];
        }

        return $lineItems;
    }

    private function handleCheckoutSessionCompleted(object $session): void
    {
        $orderNumber = $session->metadata->order_number ?? null;

        if (!$orderNumber) {
            Log::warning('Stripe checkout session completed without order metadata.', [
                'stripe_checkout_session_id' => $session->id ?? null,
            ]);

            return;
        }

        $order = Order::where('order_number', $orderNumber)->first();

        if (!$order) {
            Log::warning('Stripe checkout session completed for missing order.', [
                'order_number' => $orderNumber,
                'stripe_checkout_session_id' => $session->id ?? null,
            ]);

            return;
        }

        $order->update([
            'status' => 'completed',
            'stripe_checkout_session_id' => $session->id ?? $order->stripe_checkout_session_id,
            'stripe_payment_intent_id' => $session->payment_intent ?? $order->stripe_payment_intent_id,
            'shipping_address' => $this->formatStripeCustomerDetails($session) ?: $order->shipping_address,
        ]);

        $this->sendPaymentStatusEmail($order, 'success');
    }

    private function handleCheckoutSessionExpired(object $session): void
    {
        $orderNumber = $session->metadata->order_number ?? null;

        if (!$orderNumber) {
            return;
        }

        $order = Order::where('order_number', $orderNumber)->first();

        if (!$order) {
            return;
        }

        $order->update(['status' => 'cancelled']);

        $this->sendPaymentStatusEmail($order, 'failed');
    }

    private function sendPaymentStatusEmail(Order $order, string $status): void
    {
        if ($order->payment_status_email_sent_at) {
            return;
        }

        $email = $order->customer_email ?? ($order->user?->email ?? null);

        if (!$email) {
            Log::warning('No email address for order payment status notification.', [
                'order_number' => $order->order_number,
            ]);
            return;
        }

        try {
            Mail::to($email)->send(new OrderPaymentStatusMail($order, $status));
            $order->update(['payment_status_email_sent_at' => now()]);
        } catch (Throwable $e) {
            Log::error('Failed to send payment status email.', [
                'order_number' => $order->order_number,
                'message' => $e->getMessage(),
            ]);
        }
    }

    private function formatSubmittedAddress(Request $request): string
    {
        $parts = array_filter([
            trim($request->input('first_name') . ' ' . $request->input('last_name')),
            $request->input('company'),
            $request->input('email'),
            $request->input('phone'),
            trim($request->input('address_line_1') . ' ' . $request->input('address_line_2')),
            trim(collect([
                $request->input('city'),
                $request->input('state'),
                $request->input('zip_code'),
                $request->input('country'),
            ])->filter()->implode(', ')),
            $request->filled('order_notes') ? 'Notes: ' . $request->input('order_notes') : null,
        ]);

        return $parts ? implode("\n", $parts) : 'Address will be collected by Stripe Checkout.';
    }

    private function formatStripeCustomerDetails(object $session): ?string
    {
        $customer = $session->customer_details ?? null;

        if (!$customer) {
            return null;
        }

        $address = $customer->address ?? null;
        $addressParts = $address ? array_filter([
            $address->line1 ?? null,
            $address->line2 ?? null,
            trim(collect([
                $address->city ?? null,
                $address->state ?? null,
                $address->postal_code ?? null,
                $address->country ?? null,
            ])->filter()->implode(', ')),
        ]) : [];

        $parts = array_filter([
            $customer->name ?? null,
            $customer->email ?? null,
            $customer->phone ?? null,
            ...$addressParts,
        ]);

        return $parts ? implode("\n", $parts) : null;
    }
}
