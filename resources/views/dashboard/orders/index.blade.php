@extends('dashboard.layouts.app')

@section('title', 'Orders Management')

@section('content')

<div class="row">
    <div class="col-sm-12">
        <div class="card card-rounded">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="card-title">Customer Orders</h4>
                </div>
                <div class="table-responsive">
                    <table class="table" id="ordersTable">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Customer</th>
                                <th>Total Price</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                            <tr>
                                <td>#{{ $order->order_number }}</td>
                                <td>
                                    <strong>{{ $order->user->name ?? 'Deleted User' }}</strong><br>
                                    <small class="text-muted">{{ $order->user->email ?? '' }}</small>
                                </td>
                                <td>${{ number_format($order->total_price, 2) }}</td>
                                <td>{{ $order->created_at->format('M d, Y H:i') }}</td>
                                <td>
                                    @php
                                        $statusClass = [
                                            'pending' => 'badge-warning',
                                            'processing' => 'badge-info',
                                            'completed' => 'badge-success',
                                            'cancelled' => 'badge-danger'
                                        ][$order->status] ?? 'badge-secondary';
                                    @endphp
                                    <span class="badge {{ $statusClass }}">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-icon" type="button" data-bs-toggle="dropdown">
                                            <i class="mdi mdi-dots-vertical"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><h6 class="dropdown-header">Update Status</h6></li>
                                            @foreach(['pending', 'processing', 'completed', 'cancelled'] as $status)
                                                @if($status !== $order->status)
                                                <li>
                                                    <form action="{{ route('orders.updateStatus') }}" method="POST">
                                                         @csrf
                                                         <input type="hidden" name="order_number" value="{{ $order->order_number }}">
                                                         <input type="hidden" name="status" value="{{ $status }}">
                                                        <button type="submit" class="dropdown-item">{{ ucfirst($status) }}</button>
                                                    </form>
                                                </li>
                                                @endif
                                            @endforeach
                                            <li><hr class="dropdown-divider"></li>
                                            <li>
                                                <form action="{{ route('orders.destroy') }}" method="POST">
                                                     @csrf
                                                     <input type="hidden" name="order_number" value="{{ $order->order_number }}">
                                                     <button type="submit" class="dropdown-item text-danger" onclick="return confirm('Delete this order?')">Delete Order</button>
                                                 </form>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<link rel="stylesheet" href="{{ asset('assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">
<script src="{{ asset('assets/vendors/datatables.net/jquery.dataTables.js') }}"></script>
<script src="{{ asset('assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>
<script>
    $(document).ready(function() {
        $('#ordersTable').DataTable({
            "order": [[ 0, "desc" ]]
        });
    });
</script>
@endpush

@endsection
