<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $paymentStatus === 'success' ? 'Payment Successful' : 'Payment Status' }} - Order {{ $order->order_number }}</title>
    <style>
        body { font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif; color: #333; }
        .email-wrap { max-width: 680px; margin: 0 auto; padding: 24px; background: #ffffff; }
        .header { display:flex; justify-content:space-between; align-items:center; border-bottom: 1px solid #e6e6e6; padding-bottom:16px; }
        .brand { font-size:20px; font-weight:700; color:#111; }
        .company-info { text-align:right; font-size:12px; color:#666; }
        h1 { font-size:18px; margin:18px 0 6px; }
        .muted { color:#6b7280; font-size:13px; }
        .details { display:flex; justify-content:space-between; gap:12px; margin:16px 0; }
        .box { background:#f9fafb; padding:12px; border:1px solid #eee; border-radius:6px; font-size:13px; }
        table.items { width:100%; border-collapse:collapse; margin-top:12px; }
        table.items th, table.items td { padding:10px 8px; border-bottom:1px solid #edf2f7; text-align:left; }
        table.items th { background:#fbfdff; font-weight:600; font-size:13px; }
        .text-right { text-align:right; }
        .totals { margin-top:12px; width:100%; }
        .totals td { padding:6px 8px; }
        .total-amount { font-size:18px; font-weight:700; }
        .foot { margin-top:22px; font-size:12px; color:#6b7280; }
        .label { color:#374151; font-weight:600; }
    </style>
</head>
<body style="background:#f3f4f6; padding:28px;">
    <div class="email-wrap">
        <div class="header">
            <div class="brand">
                @if($settings = \App\Models\Setting::all()->pluck('value','key') and !empty($settings['company_logo']))
                    <img src="{{ asset('storage/' . $settings['company_logo']) }}" alt="{{ $settings['company_name'] ?? config('app.name') }}" style="max-height:48px;">
                @else
                    {{ config('app.name', 'Our Store') }}
                @endif
            </div>
            <div class="company-info">
                @if(isset($settings) && $settings->count())
                    <div>{{ $settings['company_name'] ?? config('app.name') }}</div>
                    <div class="muted">{{ $settings['company_email'] ?? 'support@company.example' }}</div>
                @else
                    <div>{{ config('app.name') }}</div>
                @endif
            </div>
        </div>

        <h1>{{ $paymentStatus === 'success' ? 'Payment Received' : 'Payment Status: ' . ucfirst($paymentStatus) }}</h1>
        <p class="muted">{{ $paymentStatus === 'success' ? 'Thank you — we have received your payment.' : 'There was an issue with the payment for this order.' }}</p>

        <div class="details">
            <div class="box">
                <div class="label">Order</div>
                <div>#{!! $order->order_number !!}</div>
                <div class="muted">Placed: {{ $order->created_at?->toDayDateTimeString() ?? now()->toDayDateTimeString() }}</div>
            </div>

            <div class="box">
                <div class="label">Billing / Contact</div>
                <div>{{ $order->customer_name ?? ($order->user?->name ?? '-') }}</div>
                <div class="muted">{{ $order->customer_email ?? ($order->user?->email ?? '-') }}</div>
                @if($order->customer_phone)
                    <div class="muted">{{ $order->customer_phone }}</div>
                @endif
            </div>
        </div>

        <table class="items">
            <thead>
                <tr>
                    <th>Item</th>
                    <th style="width:80px; text-align:center;">Qty</th>
                    <th style="width:140px; text-align:right;">Line Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->items as $item)
                    <tr>
                        <td>{{ $item->product->name ?? 'Product #' . $item->product_id }}<div class="muted" style="font-size:12px;">Unit price: £{{ number_format($item->price,2) }}</div></td>
                        <td style="text-align:center;">{{ $item->quantity }}</td>
                        <td style="text-align:right;">£{{ number_format($item->price * $item->quantity, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <table class="totals" cellpadding="0" cellspacing="0">
            <tr>
                <td style="width:60%;"></td>
                <td style="width:40%;">
                    <table style="width:100%;">
                        <tr>
                            <td class="muted">Subtotal</td>
                            <td class="text-right">£{{ number_format($order->items->sum(fn($i) => $i->price * $i->quantity), 2) }}</td>
                        </tr>
                        @if($order->discount_amount)
                        <tr>
                            <td class="muted">Discount</td>
                            <td class="text-right">-£{{ number_format($order->discount_amount, 2) }}</td>
                        </tr>
                        @endif
                        @php
                            $shipping = floatval(\App\Models\Setting::all()->pluck('value','key')['shipping_cost'] ?? 0);
                        @endphp
                        <tr>
                            <td class="muted">Shipping</td>
                            <td class="text-right">£{{ number_format($order->shipping_cost ?? $shipping, 2) }}</td>
                        </tr>
                        <tr>
                            <td class="label">Total</td>
                            <td class="text-right total-amount">£{{ number_format($order->total_price, 2) }}</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

        <div class="foot">
            @if($order->stripe_payment_intent_id)
                <div><strong>Payment ID:</strong> {{ $order->stripe_payment_intent_id }}</div>
            @endif
            <div><strong>Payment method:</strong> Stripe Checkout</div>
            <p style="margin-top:8px;">If you have any questions about this receipt, reply to this email or contact our support team.</p>
            <p class="muted">&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
