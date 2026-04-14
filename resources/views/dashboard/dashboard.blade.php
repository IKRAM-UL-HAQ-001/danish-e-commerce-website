@extends('dashboard.layouts.app')

@section('title', 'Dashboard')

@section('content')

<div class="row">
    <div class="col-sm-12">
        <div class="statistics-details d-flex align-items-center justify-content-between">
            <div>
                <p class="statistics-title">Total Products</p>
                <h3 class="rate-percentage">{{ number_format($totalProducts) }}</h3>
            </div>
            <div>
                <p class="statistics-title">Total Customers</p>
                <h3 class="rate-percentage">{{ number_format($totalUsers) }}</h3>
            </div>
            <div>
                <p class="statistics-title">Total Orders</p>
                <h3 class="rate-percentage">{{ number_format($totalOrders) }}</h3>
            </div>
            <div class="d-none d-md-block">
                <p class="statistics-title">Total Revenue</p>
                <h3 class="rate-percentage">${{ number_format($totalRevenue, 2) }}</h3>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-lg-8 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="card-title">Weekly Sales Performance</h4>
                </div>
                @if($chartData->isEmpty())
                    <div class="text-center py-5">
                        <i class="mdi mdi-chart-line mdi-48px text-muted"></i>
                        <p class="text-muted">No sales data available for the last 7 days.</p>
                    </div>
                @else
                    <canvas id="dashboardSalesChart" style="height: 250px;"></canvas>
                @endif
            </div>
        </div>
    </div>
    <div class="col-lg-4 grid-margin stretch-card">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <h4 class="card-title text-white">Top Selling Product</h4>
                @if($mostSoldProduct)
                    <div class="text-center mt-4">
                        @if($mostSoldProduct->product->image)
                            <img src="{{ asset('storage/' . $mostSoldProduct->product->image) }}" class="rounded-circle mb-3" style="width: 100px; height: 100px; object-fit: cover; border: 3px solid white;">
                        @else
                            <div class="rounded-circle bg-white text-primary mb-3 mx-auto d-flex align-items-center justify-content-center" style="width: 100px; height: 100px;">
                                <i class="mdi mdi-package-variant mdi-48px"></i>
                            </div>
                        @endif
                        <h5>{{ $mostSoldProduct->product->name }}</h5>
                        <p class="mb-0">{{ number_format($mostSoldProduct->total_qty) }} Items Sold</p>
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="mdi mdi-star-outline mdi-48px"></i>
                        <p>No sales recorded yet.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

    <div class="col-md-6 grid-margin stretch-card">
        <div class="card card-rounded">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="card-title">Recent Transactions</h4>
                    <a href="{{ route('orders.index') }}" class="btn btn-primary btn-sm text-white">View All</a>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Customer</th>
                                <th>Price</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse(\App\Models\Order::with('user')->latest()->take(5)->get() as $order)
                            <tr>
                                <td>#{{ $order->id }}</td>
                                <td>{{ $order->user->name ?? 'N/A' }}</td>
                                <td>${{ number_format($order->total_price, 2) }}</td>
                                <td>
                                    <label class="badge {{ $order->status == 'completed' ? 'badge-success' : 'badge-warning' }}">
                                        {{ ucfirst($order->status) }}
                                    </label>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center py-4">No recent orders.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 grid-margin stretch-card">
        <div class="card card-rounded">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="card-title">Latest Inquiries</h4>
                    <a href="{{ route('messages.index') }}" class="btn btn-primary btn-sm text-white">View All</a>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Subject</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse(\App\Models\ContactMessage::latest()->take(5)->get() as $message)
                            <tr>
                                <td>{{ $message->name }}</td>
                                <td>{{ Str::limit($message->subject ?? 'Generic Inquiry', 20) }}</td>
                                <td>{{ $message->created_at->diffForHumans() }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="text-center py-4">No new messages.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
@if(!$chartData->isEmpty())
<script src="{{ asset('assets/vendors/chart.js/chart.umd.js') }}"></script>
<script>
    $(document).ready(function() {
        const ctx = document.getElementById('dashboardSalesChart');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! json_encode($chartData->pluck('date')) !!},
                datasets: [{
                    label: 'Revenue',
                    data: {!! json_encode($chartData->pluck('total')) !!},
                    borderColor: '#EE2D7A',
                    backgroundColor: 'rgba(238, 45, 122, 0.1)',
                    fill: true,
                    tension: 0.3
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });
    });
</script>
@endif
@endpush

@endsection