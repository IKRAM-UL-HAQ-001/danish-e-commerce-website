@extends('dashboard.layouts.app')

@section('title', 'Coupons Management')

@section('content')

<div class="row">
    <div class="col-sm-12">
        <div class="card card-rounded">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="card-title">Promo Codes & Coupons</h4>
                    <button type="button" class="btn btn-primary btn-sm text-white mb-0 me-0" data-bs-toggle="modal" data-bs-target="#addCouponModal">
                        <i class="mdi mdi-plus"></i> Create Coupon
                    </button>
                </div>
                <div class="table-responsive">
                    <table class="table" id="couponsTable">
                        <thead>
                            <tr>
                                <th>Code</th>
                                <th>Type</th>
                                <th>Value</th>
                                <th>Min Spend</th>
                                <th>Expiry</th>
                                <th>Usage</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($coupons as $coupon)
                            <tr>
                                <td><strong>{{ $coupon->code }}</strong></td>
                                <td>{{ ucfirst($coupon->type) }}</td>
                                <td>{{ $coupon->type == 'percent' ? $coupon->value.'%' : '$'.$coupon->value }}</td>
                                <td>${{ number_format($coupon->min_order_value, 2) }}</td>
                                <td>{{ $coupon->expiry_date ? \Carbon\Carbon::parse($coupon->expiry_date)->format('M d, Y') : 'Never' }}</td>
                                <td>{{ $coupon->used_count }} / {{ $coupon->usage_limit ?? '∞' }}</td>
                                <td>
                                    <label class="badge {{ $coupon->status ? 'badge-success' : 'badge-danger' }}">
                                        {{ $coupon->status ? 'Active' : 'Expired/Paused' }}
                                    </label>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-icon edit-btn" 
                                        data-id="{{ $coupon->id }}" 
                                        data-code="{{ $coupon->code }}"
                                        data-type="{{ $coupon->type }}"
                                        data-value="{{ $coupon->value }}"
                                        data-min="{{ $coupon->min_order_value }}"
                                        data-expiry="{{ $coupon->expiry_date }}"
                                        data-limit="{{ $coupon->usage_limit }}"
                                        data-status="{{ $coupon->status }}"
                                        data-bs-toggle="modal" data-bs-target="#editCouponModal">
                                        <i class="mdi mdi-pencil text-primary"></i>
                                    </button>
                                    <form action="{{ route('coupons.destroy', $coupon->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-icon" onclick="return confirm('Delete this coupon?')">
                                            <i class="mdi mdi-delete text-danger"></i>
                                        </button>
                                    </form>
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

<!-- Add Coupon Modal -->
<div class="modal fade" id="addCouponModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('coupons.store') }}" method="POST" class="modal-content">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title">Create New Coupon</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group mb-3">
                    <label>Coupon Code</label>
                    <input type="text" name="code" class="form-control" placeholder="SUMMER2024" required>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Discount Type</label>
                        <select name="type" class="form-select" required>
                            <option value="fixed">Fixed Amount ($)</option>
                            <option value="percent">Percentage (%)</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Discount Value</label>
                        <input type="number" step="0.01" name="value" class="form-control" required>
                    </div>
                </div>
                <div class="form-group mb-3">
                    <label>Minimum Order Value ($)</label>
                    <input type="number" step="0.01" name="min_order_value" class="form-control" value="0">
                </div>
                <div class="form-group mb-3">
                    <label>Expiry Date</label>
                    <input type="date" name="expiry_date" class="form-control">
                </div>
                <div class="form-group mb-3">
                    <label>Usage Limit (Total uses)</label>
                    <input type="number" name="usage_limit" class="form-control" placeholder="Leave empty for unlimited">
                </div>
                <div class="form-group mb-3">
                    <label>Status</label>
                    <select name="status" class="form-select">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save Coupon</button>
            </div>
        </form>
    </div>
</div>

<!-- Edit Coupon Modal -->
<div class="modal fade" id="editCouponModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form id="editCouponForm" method="POST" class="modal-content">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title">Edit Coupon</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group mb-3">
                    <label>Coupon Code</label>
                    <input type="text" name="code" id="edit_code" class="form-control" required>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Discount Type</label>
                        <select name="type" id="edit_type" class="form-select" required>
                            <option value="fixed">Fixed Amount ($)</option>
                            <option value="percent">Percentage (%)</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Discount Value</label>
                        <input type="number" step="0.01" name="value" id="edit_value" class="form-control" required>
                    </div>
                </div>
                <div class="form-group mb-3">
                    <label>Minimum Order Value ($)</label>
                    <input type="number" step="0.01" name="min_order_value" id="edit_min" class="form-control">
                </div>
                <div class="form-group mb-3">
                    <label>Expiry Date</label>
                    <input type="date" name="expiry_date" id="edit_expiry" class="form-control">
                </div>
                <div class="form-group mb-3">
                    <label>Usage Limit</label>
                    <input type="number" name="usage_limit" id="edit_limit" class="form-control">
                </div>
                <div class="form-group mb-3">
                    <label>Status</label>
                    <select name="status" id="edit_status" class="form-select">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Update Coupon</button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        $('#couponsTable').DataTable();

        $('.edit-btn').on('click', function() {
            var id = $(this).data('id');
            $('#editCouponForm').attr('action', '/dashboard/coupons/' + id + '/update');
            $('#edit_code').val($(this).data('code'));
            $('#edit_type').val($(this).data('type'));
            $('#edit_value').val($(this).data('value'));
            $('#edit_min').val($(this).data('min'));
            $('#edit_expiry').val($(this).data('expiry'));
            $('#edit_limit').val($(this).data('limit'));
            $('#edit_status').val($(this).data('status'));
        });
    });
</script>
@endpush

@endsection
