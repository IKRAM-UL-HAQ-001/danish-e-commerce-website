<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $paymentStatus === 'success' ? 'Payment Successful' : 'Payment Failed' }}</title>
</head>
<body style="font-family: Arial, sans-serif; color: #222; line-height: 1.5;">
    <h2>{{ $paymentStatus === 'success' ? 'Payment Successful' : 'Payment Failed' }}</h2>

    @if($paymentStatus === 'success')
        <p>Thank you for your order. Your payment has been received successfully.</p>
    @else
        <p>Your payment was not completed. Your order has been marked as cancelled.</p>
    @endif

    <p><strong>Order:</strong> {{ $order->order_number }}</p>
    <p><strong>Status:</strong> {{ ucfirst($order->status) }}</p>
    <p><strong>Total:</strong> ${{ number_format($order->total_price, 2) }}</p>

    <h3>Receipt</h3>
    <table width="100%" cellpadding="8" cellspacing="0" border="1" style="border-collapse: collapse; border-color: #ddd;">
        <thead>
            <tr>
                <th align="left">Item</th>
                <th align="center">Qty</th>
                <th align="right">Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->items as $item)
                <tr>
                    <td>{{ $item->product->name ?? 'Product #' . $item->product_id }}</td>
                    <td align="center">{{ $item->quantity }}</td>
                    <td align="right">${{ number_format($item->price * $item->quantity, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @if($order->stripe_payment_intent_id)
        <p><strong>Stripe Payment ID:</strong> {{ $order->stripe_payment_intent_id }}</p>
    @endif
</body>
</html>
