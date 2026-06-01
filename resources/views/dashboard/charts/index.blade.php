@extends('dashboard.layouts.app')

@section('title', 'Sales Analytics')

@section('content')

<div class="row">
    <div class="col-sm-12">
        <div class="statistics-details d-flex align-items-center justify-content-between mb-4">
            <div>
                <p class="statistics-title">Total Monthly Revenue</p>
                <h3 class="rate-percentage">£{{ number_format($currentMonthSales, 2) }}</h3>
                <p class="{{ $monthGrowth >= 0 ? 'text-success' : 'text-danger' }} d-flex">
                    <i class="mdi {{ $monthGrowth >= 0 ? 'mdi-menu-up' : 'mdi-menu-down' }}"></i>
                    <span>{{ number_format(abs($monthGrowth), 1) }}%</span>
                </p>
            </div>
            <div>
                <p class="statistics-title">Today's Sales</p>
                <h3 class="rate-percentage">£{{ number_format($dailySales->where('date', date('Y-m-d'))->first()->total ?? 0, 2) }}</h3>
            </div>
            <div class="d-none d-md-block">
                <p class="statistics-title">Active Customers</p>
                <h3 class="rate-percentage">{{ \App\Models\User::where('role', 'buyer')->count() }}</h3>
            </div>
            <div class="d-none d-md-block">
                <p class="statistics-title">Total Orders</p>
                <h3 class="rate-percentage">{{ \App\Models\Order::count() }}</h3>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-8 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Daily Sales Performance (Last 7 Days)</h4>
                <canvas id="dailySalesChart"></canvas>
            </div>
        </div>
    </div>
    <div class="col-lg-4 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Yearly Growth Overview</h4>
                <canvas id="monthlySalesChart"></canvas>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Summary Insights</h4>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Period</th>
                                <th>Revenue</th>
                                <th>Growth</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Monthly</td>
                                <td>£{{ number_format($currentMonthSales, 2) }}</td>
                                <td><span class="badge {{ $monthGrowth >= 0 ? 'badge-success' : 'badge-danger' }}">{{ number_format($monthGrowth, 1) }}%</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="{{ asset('assets/vendors/chart.js/chart.umd.js') }}"></script>
<script>
    $(document).ready(function() {
        // Daily Sales Chart
        const dailyCtx = document.getElementById('dailySalesChart');
        new Chart(dailyCtx, {
            type: 'line',
            data: {
                labels: {!! json_encode($dailySales->pluck('date')) !!},
                datasets: [{
                    label: 'Revenue (£)',
                    data: {!! json_encode($dailySales->pluck('total')) !!},
                    borderColor: '#4B49AC',
                    backgroundColor: 'rgba(75, 73, 172, 0.1)',
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: false }
                }
            }
        });

        // Monthly Sales Chart
        const monthlyCtx = document.getElementById('monthlySalesChart');
        const monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
        const monthlyData = {!! json_encode($monthlySales) !!};
        
        new Chart(monthlyCtx, {
            type: 'bar',
            data: {
                labels: monthlyData.map(d => monthNames[d.month - 1]),
                datasets: [{
                    label: 'Monthly Revenue',
                    data: monthlyData.map(d => d.total),
                    backgroundColor: '#FFC100',
                    borderRadius: 5
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: false }
                }
            }
        });
    });
</script>
@endpush

@endsection
