<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session;

class StripeController extends Controller
{
    public function index()
    {
        return view('stripe');
    }

    public function checkout(Request $request)
    {
        $cart = session('cart');

        if (!$cart || count($cart) == 0) {
            return redirect()->back()->with('error', 'Your cart is empty.');
        }

        Stripe::setApiKey(config('services.stripe.secret'));

        $lineItems = [];

        foreach ($cart as $id => $details) {
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => $details['name'],
                    ],
                    // Stripe requires amount in cents
                    'unit_amount' => round($details['price'] * 100), 
                ],
                'quantity' => $details['quantity'],
            ];
        }

        // Fetch shipping cost from settings
        $settings = \App\Models\Setting::all()->pluck('value', 'key');
        $shipping = floatval($settings['shipping_cost'] ?? 8.00);

        if ($shipping > 0) {
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => 'Flat Rate Shipping (' . ($settings['shipping_location'] ?? 'Standard') . ')',
                    ],
                    'unit_amount' => round($shipping * 100),
                ],
                'quantity' => 1,
            ];
        }

        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => route('stripe.success'),
            'cancel_url' => route('stripe.cancel'),
        ]);

        return redirect($session->url);
    }

    public function success()
    {
        return "Payment Successful";
    }

    public function cancel()
    {
        return "Payment Cancelled";
    }
}