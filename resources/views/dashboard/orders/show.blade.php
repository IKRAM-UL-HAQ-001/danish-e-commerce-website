@extends('dashboard.layouts.app')

@section('title', 'Order Details - #' . $order->order_number)

@section('content')

<div class="row">
    <div class="col-md-12 mb-3">
        <a href="{{ route('orders.index') }}" class="btn btn-outline-secondary btn-icon-text">
            <i class="mdi mdi-arrow-left btn-icon-prepend"></i> Back to Orders
        </a>
    </div>
</div>

<div class="row">
    <!-- Order Info Card -->
    <div class="col-md-8 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="card-title">Order #{{ $order->order_number }}</h4>
                    <div>
                        @php
                            $statusClass = [
                                'pending' => 'badge-warning',
                                'processing' => 'badge-info',
                                'completed' => 'badge-success',
                                'cancelled' => 'badge-danger'
                            ][$order->status] ?? 'badge-secondary';
                        @endphp
                        <span class="badge {{ $statusClass }} fs-6">
                            {{ ucfirst($order->status) }}
                        </span>
                    </div>
                </div>

                <div class="table-responsive mb-4">
                    <table class="table table-bordered">
                        <thead>
                            <tr class="bg-light">
                                <th>Item</th>
                                <th class="text-center">Quantity</th>
                                <th class="text-right">Price</th>
                                <th class="text-right">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $calculatedSubtotal = 0;
                            @endphp
                            @foreach($order->items as $item)
                                @php
                                    $itemSubtotal = $item->price * $item->quantity;
                                    $calculatedSubtotal += $itemSubtotal;
                                @endphp
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            @if($item->product && $item->product->image)
                                                <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}" style="width: 50px; height: 50px; object-fit: cover; border-radius: 4px; margin-right: 15px;">
                                            @endif
                                            <div>
                                                <strong>{{ $item->product->name ?? 'Unknown Product' }}</strong>
                                                <br>
                                                <small class="text-muted">SKU: {{ $item->product->sku ?? 'N/A' }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">{{ $item->quantity }}</td>
                                    <td class="text-right">£{{ number_format($item->price, 2) }}</td>
                                    <td class="text-right">£{{ number_format($itemSubtotal, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="row">
                    <div class="col-md-6 offset-md-6">
                        <div class="border p-3 rounded bg-light">
                                <div class="d-flex justify-content-between mb-2">
                                <span>Subtotal</span>
                                <strong>£{{ number_format($calculatedSubtotal, 2) }}</strong>
                            </div>
                            
                            <!-- Fetch Shipping cost from overall total, default flat rate difference if available -->
                            @php
                                $shippingCost = 0;
                                if (isset($order->total_price)) {
                                    $couponDiscount = $order->discount_amount ?? 0;
                                    // shipping = total - subtotal + discount
                                    $shippingCost = max(0, $order->total_price - $calculatedSubtotal + $couponDiscount);
                                }
                            @endphp
                            <div class="d-flex justify-content-between mb-2">
                                <span>Shipping</span>
                                <strong>£{{ number_format($shippingCost, 2) }}</strong>
                            </div>

                            @if($order->coupon_code)
                                <div class="d-flex justify-content-between text-success mb-2">
                                    <span>Coupon Code ({{ $order->coupon_code }})</span>
                                    <strong>-£{{ number_format($order->discount_amount ?? 0, 2) }}</strong>
                                </div>
                            @endif

                            <hr>

                            <div class="d-flex justify-content-between fs-5 fw-bold">
                                <span>Total Price</span>
                                <span class="text-primary">£{{ number_format($order->total_price, 2) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Customer details & Actions Card -->
    <div class="col-md-4 grid-margin stretch-card">
        <div class="row w-100 m-0">
            <!-- Customer Info -->
            <div class="col-100 p-0 mb-4 stretch-card">
                <div class="card w-100">
                    <div class="card-body">
                        <h4 class="card-title mb-3">Customer Information</h4>
                        <ul class="list-unstyled">
                            <li class="mb-3">
                                <strong class="text-muted d-block">Name:</strong>
                                <span>{{ $order->customer_name ?? ($order->user->name ?? 'Guest User') }}</span>
                            </li>
                            <li class="mb-3">
                                <strong class="text-muted d-block">Email:</strong>
                                <span>{{ $order->customer_email ?? ($order->user->email ?? 'No email provided') }}</span>
                            </li>
                            <li class="mb-3">
                                <strong class="text-muted d-block">Phone:</strong>
                                <span>{{ $order->customer_phone ?? 'N/A' }}</span>
                            </li>
                            <li class="mb-3">
                                <strong class="text-muted d-block">Account Type:</strong>
                                <span class="badge {{ $order->user_id ? 'badge-info' : 'badge-secondary' }}">
                                    {{ $order->user_id ? 'Registered User' : 'Guest Checkout' }}
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Shipping Address -->
            <div class="col-100 p-0 mb-4 stretch-card">
                <div class="card w-100">
                    <div class="card-body">
                        <h4 class="card-title mb-3">Shipping Address</h4>
                        <div class="bg-light p-3 rounded border text-pre-line" style="white-space: pre-line;">{!! e($order->shipping_address) !!}</div>
                    </div>
                </div>
            </div>

            <!-- Stripe / Payment Details -->
            @if($order->stripe_checkout_session_id || $order->stripe_payment_intent_id)
            <div class="col-100 p-0 mb-4 stretch-card">
                <div class="card w-100">
                    <div class="card-body">
                        <h4 class="card-title mb-3">Payment details</h4>
                        <ul class="list-unstyled">
                            @if($order->stripe_payment_intent_id)
                            <li class="mb-2">
                                <strong class="text-muted d-block">Payment Intent ID:</strong>
                                <code class="text-break">{{ $order->stripe_payment_intent_id }}</code>
                            </li>
                            @endif
                            @if($order->stripe_checkout_session_id)
                            <li class="mb-2">
                                <strong class="text-muted d-block">Stripe Session ID:</strong>
                                <code class="text-break">{{ $order->stripe_checkout_session_id }}</code>
                            </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
            @endif

            <!-- Update Status action -->
            <div class="col-100 p-0 stretch-card">
                <div class="card w-100">
                    <div class="card-body">
                        <h4 class="card-title mb-3">Update Order Status</h4>
                        <form action="{{ route('orders.updateStatus') }}" method="POST">
                            @csrf
                            <input type="hidden" name="order_number" value="{{ $order->order_number }}">
                            <div class="form-group mb-3">
                                <select name="status" class="form-select form-control">
                                    @foreach(['pending', 'processing', 'completed', 'cancelled'] as $status)
                                        <option value="{{ $status }}" {{ $order->status === $status ? 'selected' : '' }}>
                                            {{ ucfirst($status) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary text-white w-100">Update Status</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
