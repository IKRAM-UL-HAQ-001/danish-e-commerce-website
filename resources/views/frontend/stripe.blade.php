<!DOCTYPE html>
<html>
<head>
    <title>Stripe Payment</title>
</head>
<body>

    <h2>Pay with Card</h2>

    <form action="{{ route('stripe.checkout') }}" method="POST">
        @csrf

        <button type="submit">
            Pay $10
        </button>
    </form>

</body>
</html>