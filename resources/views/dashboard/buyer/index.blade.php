@extends('dashboard.layouts.app')

@section('title', 'My Account')

@section('content')

<div class="row">
    <div class="col-sm-12">
        <div class="statistics-details d-flex align-items-center justify-content-between mb-4">
            <div>
                <p class="statistics-title">My Total Orders</p>
                <h3 class="rate-percentage">{{ number_format($totalMyOrders) }}</h3>
            </div>
            <div>
                <p class="statistics-title">Total Spent</p>
                <h3 class="rate-percentage">${{ number_format($totalSpent, 2) }}</h3>
            </div>
            <div>
                <p class="statistics-title">Pending Orders</p>
                <h3 class="rate-percentage">{{ number_format($pendingOrders) }}</h3>
            </div>
            <div class="d-none d-md-block">
                <p class="statistics-title">Reward Points</p>
                <h3 class="rate-percentage">0</h3>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card card-rounded">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="card-title">My Recent Purchases</h4>
                    <a href="{{ route('my-orders') }}" class="btn btn-primary btn-sm text-white">View Full History</a>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Order #</th>
                                <th>Date</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentOrders as $order)
                            <tr>
                                <td><strong>#{{ $order->id }}</strong></td>
                                <td>{{ $order->created_at->format('M d, Y') }}</td>
                                <td>${{ number_format($order->total_price, 2) }}</td>
                                <td>
                                    <label class="badge {{ $order->status == 'completed' ? 'badge-success' : ($order->status == 'cancelled' ? 'badge-danger' : 'badge-warning') }}">
                                        {{ ucfirst($order->status) }}
                                    </label>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary">Track Order</button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-5">
                                    <i class="mdi mdi-cart-outline mdi-48px text-muted"></i>
                                    <p class="text-muted mt-2">You haven't placed any orders yet.</p>
                                    <a href="#" class="btn btn-primary btn-sm text-white">Start Shopping</a>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
