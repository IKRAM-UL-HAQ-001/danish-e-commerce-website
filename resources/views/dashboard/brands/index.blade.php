@extends('dashboard.layouts.app')

@section('title', 'Brands')

@section('content')

<div class="row">
    <div class="col-sm-12">
        <div class="card card-rounded">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="card-title">Brands</h4>
                    <button type="button" class="btn btn-primary btn-sm text-white mb-0 me-0" data-bs-toggle="modal" data-bs-target="#addBrandModal">
                        <i class="mdi mdi-plus"></i> Add New Brand
                    </button>
                </div>
                <div class="table-responsive">
                    <table class="table" id="brandsTable">
                        <thead>
                            <tr>
                                <th>Logo</th>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($brands as $brand)
                            <tr>
                                <td>
                                    @if($brand->logo)
                                        <img src="{{ asset('storage/' . $brand->logo) }}" alt="{{ $brand->name }}" style="width: 50px; height: 50px; border-radius: 5px;">
                                    @else
                                        <span class="text-muted">No Logo</span>
                                    @endif
                                </td>
                                <td>{{ $brand->name }}</td>
                                <td>
                                    <label class="badge {{ $brand->status ? 'badge-success' : 'badge-danger' }}">
                                        {{ $brand->status ? 'Active' : 'Inactive' }}
                                    </label>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-icon edit-btn" 
                                        data-slug="{{ $brand->slug }}" 
                                        data-name="{{ $brand->name }}"
                                        data-status="{{ $brand->status }}"
                                        data-bs-toggle="modal" data-bs-target="#editBrandModal">
                                        <i class="mdi mdi-pencil text-primary"></i>
                                    </button>
                                    <form action="{{ route('brands.destroy') }}" method="POST" style="display:inline;">
                                        @csrf
                                        <input type="hidden" name="slug" value="{{ $brand->slug }}">
                                        <button type="submit" class="btn btn-sm btn-icon" onclick="return confirm('Are you sure?')">
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

<!-- Add Brand Modal -->
<div class="modal fade" id="addBrandModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('brands.store') }}" method="POST" enctype="multipart/form-data" class="modal-content">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title">Add New Brand</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group mb-3">
                    <label for="name">Brand Name</label>
                    <input type="text" name="name" class="form-control" placeholder="Enter name" required>
                </div>
                <div class="form-group mb-3">
                    <label for="logo">Brand Logo</label>
                    <input type="file" name="logo" class="form-control">
                </div>
                <div class="form-group mb-3">
                    <label for="status">Status</label>
                    <select name="status" class="form-select">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save Brand</button>
            </div>
        </form>
    </div>
</div>

<!-- Edit Brand Modal -->
<div class="modal fade" id="editBrandModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form id="editBrandForm" action="{{ route('brands.update') }}" method="POST" enctype="multipart/form-data" class="modal-content">
            @csrf
            <input type="hidden" name="slug" id="edit_slug">
            <div class="modal-header">
                <h5 class="modal-title">Edit Brand</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group mb-3">
                    <label for="edit_name">Brand Name</label>
                    <input type="text" name="name" id="edit_name" class="form-control" required>
                </div>
                <div class="form-group mb-3">
                    <label for="edit_logo">Brand Logo (Leave blank to keep current)</label>
                    <input type="file" name="logo" class="form-control">
                </div>
                <div class="form-group mb-3">
                    <label for="edit_status">Status</label>
                    <select name="status" id="edit_status" class="form-select">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Update Brand</button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<link rel="stylesheet" href="{{ asset('assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">
<script src="{{ asset('assets/vendors/datatables.net/jquery.dataTables.js') }}"></script>
<script src="{{ asset('assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>
<script>
    $(document).ready(function() {
        $('#brandsTable').DataTable();

        // Handle Edit Button Click
        $('.edit-btn').on('click', function() {
            var slug = $(this).data('slug');
            var name = $(this).data('name');
            var status = $(this).data('status');

            // Set form action dynamically
            // No longer needed to set action with slug, but we'll populate the hidden slug field
            $('#edit_slug').val(slug);

            // Populate fields
            $('#edit_name').val(name);
            $('#edit_status').val(status);
        });
    });
</script>
@endpush

@endsection
