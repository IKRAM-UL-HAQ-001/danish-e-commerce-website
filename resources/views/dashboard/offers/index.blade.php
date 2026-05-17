@extends('dashboard.layouts.app')

@section('title', 'Offers Management')

@section('content')

<div class="row">
    <div class="col-sm-12">
        <div class="card card-rounded">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="card-title">Site Offers</h4>
                    <button type="button" class="btn btn-primary btn-sm text-white mb-0 me-0" data-bs-toggle="modal" data-bs-target="#addOfferModal">
                        <i class="mdi mdi-plus"></i> Add New Offer
                    </button>
                </div>
                <div class="table-responsive">
                    <table class="table" id="offersTable">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Title</th>
                                <th>Price</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($offers as $offer)
                            <tr>
                                <td>
                                    @if($offer->image)
                                        <img src="{{ asset('storage/' . $offer->image) }}" alt="Offer" style="width: 100px; height: 50px; border-radius: 5px; object-fit: cover;">
                                    @else
                                        No Image
                                    @endif
                                </td>
                                <td>{{ $offer->title }}</td>
                                <td>${{ number_format($offer->price, 2) }}</td>
                                <td>
                                    <label class="badge {{ $offer->status ? 'badge-success' : 'badge-danger' }}">
                                        {{ $offer->status ? 'Active' : 'Inactive' }}
                                    </label>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-icon edit-btn" 
                                        data-id="{{ $offer->id }}" 
                                        data-title="{{ $offer->title }}"
                                        data-description="{{ $offer->description }}"
                                        data-price="{{ $offer->price }}"
                                        data-old_price="{{ $offer->old_price }}"
                                        data-status="{{ $offer->status }}"
                                        data-bs-toggle="modal" data-bs-target="#editOfferModal">
                                        <i class="mdi mdi-pencil text-primary"></i>
                                    </button>
                                    <form action="{{ route('offers.destroy') }}" method="POST" style="display:inline;">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $offer->id }}">
                                        <button type="submit" class="btn btn-sm btn-icon" onclick="return confirm('Delete this offer?')">
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

<!-- Add Offer Modal -->
<div class="modal fade" id="addOfferModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('offers.store') }}" method="POST" enctype="multipart/form-data" class="modal-content">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title">Add New Offer</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group mb-3">
                    <label>Offer Title</label>
                    <input type="text" name="title" class="form-control" required>
                </div>
                <div class="form-group mb-3">
                    <label>Offer Image</label>
                    <input type="file" name="image" class="form-control">
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label>Price</label>
                            <input type="number" step="0.01" name="price" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label>Old Price (Optional)</label>
                            <input type="number" step="0.01" name="old_price" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="form-group mb-3">
                    <label>Detailed Description</label>
                    <textarea name="description" class="form-control" rows="5" required></textarea>
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
                <button type="submit" class="btn btn-primary">Save Offer</button>
            </div>
        </form>
    </div>
</div>

<!-- Edit Offer Modal -->
<div class="modal fade" id="editOfferModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form id="editOfferForm" action="{{ route('offers.update') }}" method="POST" enctype="multipart/form-data" class="modal-content">
            @csrf
            <input type="hidden" name="id" id="edit_offer_id">
            <div class="modal-header">
                <h5 class="modal-title">Edit Offer</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group mb-3">
                    <label>Offer Title</label>
                    <input type="text" name="title" id="edit_title" class="form-control" required>
                </div>
                <div class="form-group mb-3">
                    <label>Image (Leave blank to keep current)</label>
                    <input type="file" name="image" class="form-control">
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label>Price</label>
                            <input type="number" step="0.01" name="price" id="edit_price" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label>Old Price (Optional)</label>
                            <input type="number" step="0.01" name="old_price" id="edit_old_price" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="form-group mb-3">
                    <label>Detailed Description</label>
                    <textarea name="description" id="edit_description" class="form-control" rows="5" required></textarea>
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
                <button type="submit" class="btn btn-primary">Update Offer</button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        $('#offersTable').DataTable();

        $('.edit-btn').on('click', function() {
            var id = $(this).data('id');
            $('#edit_offer_id').val(id);
            $('#edit_title').val($(this).data('title'));
            $('#edit_price').val($(this).data('price'));
            $('#edit_old_price').val($(this).data('old_price'));
            $('#edit_description').val($(this).data('description'));
            $('#edit_status').val($(this).data('status'));
        });
    });
</script>
@endpush

@endsection
