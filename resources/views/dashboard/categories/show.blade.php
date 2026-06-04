@extends('dashboard.layouts.app')

@section('title', 'Dashboard')

@section('content')

<div class="row">
    <div class="col-sm-12">
        <div class="card card-rounded">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="card-title">Categories & Subcategories</h4>
                    <button type="button" class="btn btn-primary btn-sm text-white mb-0 me-0" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
                        <i class="mdi mdi-plus"></i> Add New Category
                    </button>
                </div>
                <div class="table-responsive">
                    <table class="table" id="categoriesTable">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Category Name</th>
                                <th>Parent Category</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $category)
                            <tr>
                                <td>
                                    @if($category->image_mobile)
                                        <img src="{{ asset('storage/' . $category->image_mobile) }}" alt="{{ $category->name }} (mobile)" style="width: 50px; height: 50px; object-fit: cover; border-radius: 5px;">
                                    @elseif(isset($siteLogo) && $siteLogo)
                                        <img src="{{ asset($siteLogo) }}" alt="{{ $category->name }} (logo)" style="width: 50px; height: 50px; object-fit: cover; border-radius: 5px;">
                                    @else
                                        <span class="text-muted">No Image</span>
                                    @endif
                                </td>
                                <td>
                                    @if($category->parent_id) 
                                        <span class="text-muted">—</span> 
                                    @endif
                                    {{ $category->name }}
                                </td>
                                <td>
                                    @if($category->parent)
                                        <span class="badge badge-outline-info">{{ $category->parent->name }}</span>
                                    @else
                                        <span class="text-muted">Main Category</span>
                                    @endif
                                </td>
                                <td>
                                    <label class="badge {{ $category->status ? 'badge-success' : 'badge-danger' }}">
                                        {{ $category->status ? 'Active' : 'Inactive' }}
                                    </label>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-icon edit-btn" 
                                        data-slug="{{ $category->slug }}" 
                                        data-name="{{ $category->name }}"
                                        data-parent="{{ $category->parent_id ?? '' }}"
                                        data-status="{{ $category->status }}"
                                        data-image_mobile="{{ $category->image_mobile ? asset('storage/' . $category->image_mobile) : '' }}"
                                        data-image_desktop="{{ $category->image_desktop ? asset('storage/' . $category->image_desktop) : '' }}"
                                        data-bs-toggle="modal" data-bs-target="#editCategoryModal">
                                        <i class="mdi mdi-pencil text-primary"></i>
                                    </button>
                                    <form action="{{ route('categories.destroy') }}" method="POST" style="display:inline;">
                                        @csrf
                                        <input type="hidden" name="slug" value="{{ $category->slug }}">
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

<!-- Add Category Modal -->
<div class="modal fade" id="addCategoryModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data" class="modal-content">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title">Add New Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group mb-3">
                    <label for="name">Category Name</label>
                    <input type="text" name="name" class="form-control" placeholder="Enter name" required>
                </div>
                <div class="form-group mb-3">
                    <label for="parent_id">Parent Category (Optional)</label>
                    <select name="parent_id" class="form-select">
                        <option value="">-- No Parent (Main Category) --</option>
                        @foreach($allCategories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                    <small class="text-muted">Select a parent if you want to create a subcategory.</small>
                </div>
                <div class="form-group mb-3">
                    <label for="status">Status</label>
                    <select name="status" class="form-select">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label for="image_mobile">Category Image (Mobile)</label>
                    <input type="file" name="image_mobile" class="form-control">
                </div>
                <div class="form-group mb-3">
                    <label for="image_desktop">Category Image (Laptop)</label>
                    <input type="file" name="image_desktop" class="form-control">
                    <small class="text-muted">Recommended size: 300x300px.</small>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save Category</button>
            </div>
        </form>
    </div>
</div>

<!-- Edit Category Modal -->
<div class="modal fade" id="editCategoryModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form id="editCategoryForm" action="{{ route('categories.update') }}" method="POST" enctype="multipart/form-data" class="modal-content">
            @csrf
            <input type="hidden" name="slug" id="edit_slug">
            <div class="modal-header">
                <h5 class="modal-title">Edit Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group mb-3">
                    <label for="edit_name">Category Name</label>
                    <input type="text" name="name" id="edit_name" class="form-control" required>
                </div>
                <div class="form-group mb-3">
                    <label for="edit_parent_id">Parent Category (Optional)</label>
                    <select name="parent_id" id="edit_parent_id" class="form-select">
                        <option value="">-- No Parent (Main Category) --</option>
                        @foreach($allCategories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label for="edit_status">Status</label>
                    <select name="status" id="edit_status" class="form-select">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label for="edit_image_mobile">Category Image (Mobile) (Leave blank to keep current)</label>
                    <input type="file" name="image_mobile" id="edit_image_mobile" class="form-control">
                    <div id="current_image_mobile_preview" class="mt-2"></div>
                </div>
                <div class="form-group mb-3">
                    <label for="edit_image_desktop">Category Image (Laptop) (Leave blank to keep current)</label>
                    <input type="file" name="image_desktop" id="edit_image_desktop" class="form-control">
                    <div id="current_image_desktop_preview" class="mt-2"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Update Category</button>
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
        $('#categoriesTable').DataTable();

        // Handle Edit Button Click
        $('.edit-btn').on('click', function() {
            var slug = $(this).data('slug');
            var name = $(this).data('name');
            var parent = $(this).data('parent');
            var status = $(this).data('status');
            var image = $(this).data('image');
            var image_mobile = $(this).data('image_mobile') || '{{ isset($siteLogo) ? asset($siteLogo) : "" }}';
            var image_desktop = $(this).data('image_desktop');

            // Set form action dynamically
            // No longer needed to set action with slug, but we populate the hidden slug field
            $('#edit_slug').val(slug);

            // Populate fields
            $('#edit_name').val(name);
            $('#edit_parent_id').val(parent);
            $('#edit_status').val(status);

            // Preview current image
            if (image) {
                $('#current_image_preview').html('<img src="' + image + '" style="width: 100px; height: 100px; object-fit: cover; border-radius: 5px;">');
            } else {
                $('#current_image_preview').html('');
            }

            if (image_mobile) {
                $('#current_image_mobile_preview').html('<img src="' + image_mobile + '" style="width: 100px; height: 100px; object-fit: cover; border-radius: 5px;">');
            } else {
                $('#current_image_mobile_preview').html('');
            }

            if (image_desktop) {
                $('#current_image_desktop_preview').html('<img src="' + image_desktop + '" style="width: 100px; height: 100px; object-fit: cover; border-radius: 5px;">');
            } else {
                $('#current_image_desktop_preview').html('');
            }
        });
    });
</script>
@endpush

@endsection