<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: DejaVu Sans, Roboto, Arial, sans-serif; color:#222; font-size:12px; }
        .container { max-width:800px; margin:0 auto; padding:20px; }
        .header { display:flex; justify-content:space-between; align-items:center; }
        .brand { font-size:20px; font-weight:700; }
        .company { text-align:right; font-size:11px; color:#444; }
        .items { width:100%; border-collapse:collapse; margin-top:16px; }
        .items th, .items td { border-bottom:1px solid #ddd; padding:8px; text-align:left; }
        .totals { margin-top:12px; width:100%; }
        .right { text-align:right; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="brand">{{ config('app.name') }}</div>
            <div class="company">
                @if($settings = \App\Models\Setting::all()->pluck('value','key'))
                    <div>{{ $settings['company_name'] ?? config('app.name') }}</div>
                    <div>{{ $settings['company_address'] ?? '' }}</div>
                    <div>{{ $settings['company_email'] ?? '' }}</div>
                @endif
            </div>
        </div>

        <h2>Receipt — Order #{{ $order->order_number }}</h2>
        <div>
            <strong>Date:</strong> {{ $order->created_at?->toDateString() ?? now()->toDateString() }}<br>
            <strong>Customer:</strong> {{ $order->customer_name ?? ($order->user?->name ?? '-') }}<br>
            <strong>Email:</strong> {{ $order->customer_email ?? ($order->user?->email ?? '-') }}
        </div>

        <table class="items">
            <thead>
                <tr>
                    <th>Item</th>
                    <th style="width:60px; text-align:center;">Qty</th>
                    <th style="text-align:right;">Unit</th>
                    <th style="text-align:right;">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->items as $item)
                    <tr>
                        <td>{{ $item->product->name ?? 'Product #' . $item->product_id }}</td>
                        <td style="text-align:center;">{{ $item->quantity }}</td>
                        <td style="text-align:right;">£{{ number_format($item->price,2) }}</td>
                        <td style="text-align:right;">£{{ number_format($item->price * $item->quantity,2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <table class="totals">
            <tr>
                <td style="width:70%;"></td>
                <td style="width:30%;">
                    <table style="width:100%;">
                        <tr>
                            <td>Subtotal</td>
                            <td class="right">£{{ number_format($order->items->sum(fn($i) => $i->price * $i->quantity),2) }}</td>
                        </tr>
                        @if($order->discount_amount)
                        <tr>
                            <td>Discount</td>
                            <td class="right">-£{{ number_format($order->discount_amount,2) }}</td>
                        </tr>
                        @endif
+                        @php
+                            $shipping = floatval(\App\Models\Setting::all()->pluck('value','key')['shipping_cost'] ?? 0);
+                        @endphp
+                        <tr>
+                            <td>Shipping</td>
+                            <td class="right">£{{ number_format($order->shipping_cost ?? $shipping,2) }}</td>
+                        </tr>
+                        <tr>
+                            <td><strong>Total</strong></td>
+                            <td class="right"><strong>£{{ number_format($order->total_price,2) }}</strong></td>
+                        </tr>
+                    </table>
+                </td>
+            </tr>
+        </table>
+
+        @if($order->stripe_payment_intent_id)
+            <div style="margin-top:12px; font-size:11px;">Payment ID: {{ $order->stripe_payment_intent_id }}</div>
+        @endif
+
+        <div style="margin-top:18px; font-size:11px; color:#666;">Thank you for your purchase.</div>
+    </div>
+</body>
+</html>
