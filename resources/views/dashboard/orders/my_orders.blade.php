@extends('dashboard.layouts.app')

@section('title', 'My Orders')

@section('content')

<div class="row">
    <div class="col-sm-12">
        <div class="card card-rounded">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="card-title">Order History</h4>
                </div>
                <div class="table-responsive">
                    <table class="table" id="myOrdersTable">
                        <thead>
                            <tr>
                                <th>Order #</th>
                                <th>Date</th>
                                <th>Shipping Address</th>
                                <th>Total Price</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                            <tr>
                                <td><strong>#{{ $order->id }}</strong></td>
                                <td>{{ $order->created_at->format('M d, Y') }}</td>
                                <td>{{ Str::limit($order->shipping_address, 30) }}</td>
                                <td>${{ number_format($order->total_price, 2) }}</td>
                                <td>
                                    <label class="badge {{ $order->status == 'completed' ? 'badge-success' : ($order->status == 'cancelled' ? 'badge-danger' : 'badge-warning') }}">
                                        {{ ucfirst($order->status) }}
                                    </label>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-icon"><i class="mdi mdi-eye text-primary"></i></button>
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
<script>
    $(document).ready(function() {
        $('#myOrdersTable').DataTable();
    });
</script>
@endpush

@endsection
