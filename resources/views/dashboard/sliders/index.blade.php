@extends('dashboard.layouts.app')

@section('title', 'Hero Sliders')

@section('content')

<div class="row">
    <div class="col-sm-12">
        <div class="card card-rounded">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="card-title">Homepage Sliders</h4>
                    <button type="button" class="btn btn-primary btn-sm text-white mb-0 me-0" data-bs-toggle="modal" data-bs-target="#addSliderModal">
                        <i class="mdi mdi-plus"></i> Add New Slider
                    </button>
                </div>
                <div class="table-responsive">
                    <table class="table" id="slidersTable">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Title</th>
                                <th>URL</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($sliders as $slider)
                            <tr>
                                <td>
                                    <img src="{{ asset('storage/' . $slider->image) }}" alt="Slider" style="width: 100px; height: 50px; border-radius: 5px; object-fit: cover;">
                                </td>
                                <td>{{ $slider->title ?? 'N/A' }}</td>
                                <td><a href="{{ $slider->url }}" target="_blank">{{ Str::limit($slider->url, 20) }}</a></td>
                                <td>
                                    <label class="badge {{ $slider->status ? 'badge-success' : 'badge-danger' }}">
                                        {{ $slider->status ? 'Active' : 'Inactive' }}
                                    </label>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-icon edit-btn" 
                                        data-slug="{{ $slider->slug }}" 
                                        data-title="{{ $slider->title }}"
                                        data-description="{{ $slider->description }}"
                                        data-url="{{ $slider->url }}"
                                        data-status="{{ $slider->status }}"
                                        data-bs-toggle="modal" data-bs-target="#editSliderModal">
                                        <i class="mdi mdi-pencil text-primary"></i>
                                    </button>
                                    <form action="{{ route('sliders.destroy') }}" method="POST" style="display:inline;">
                                        @csrf
                                        <input type="hidden" name="slug" value="{{ $slider->slug }}">
                                        <button type="submit" class="btn btn-sm btn-icon" onclick="return confirm('Delete this slider?')">
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

<!-- Add Slider Modal -->
<div class="modal fade" id="addSliderModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('sliders.store') }}" method="POST" enctype="multipart/form-data" class="modal-content">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title">Add New Slider</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group mb-3">
                    <label>Slider Image</label>
                    <input type="file" name="image" class="form-control" required>
                </div>
                <div class="form-group mb-3">
                    <label>Title (Optional)</label>
                    <input type="text" name="title" class="form-control">
                </div>
                <div class="form-group mb-3">
                    <label>Description (Optional)</label>
                    <textarea name="description" class="form-control"></textarea>
                </div>
                <div class="form-group mb-3">
                    <label>URL / Link</label>
                    <input type="text" name="url" class="form-control" placeholder="https://example.com">
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
                <button type="submit" class="btn btn-primary">Save Slider</button>
            </div>
        </form>
    </div>
</div>

<!-- Edit Slider Modal -->
<div class="modal fade" id="editSliderModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form id="editSliderForm" action="{{ route('sliders.update') }}" method="POST" enctype="multipart/form-data" class="modal-content">
            @csrf
            <input type="hidden" name="slug" id="edit_slider_slug">
            <div class="modal-header">
                <h5 class="modal-title">Edit Slider</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group mb-3">
                    <label>Image (Leave blank to keep current)</label>
                    <input type="file" name="image" class="form-control">
                </div>
                <div class="form-group mb-3">
                    <label>Title</label>
                    <input type="text" name="title" id="edit_title" class="form-control">
                </div>
                <div class="form-group mb-3">
                    <label>Description</label>
                    <textarea name="description" id="edit_description" class="form-control"></textarea>
                </div>
                <div class="form-group mb-3">
                    <label>URL / Link</label>
                    <input type="text" name="url" id="edit_url" class="form-control">
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
                <button type="submit" class="btn btn-primary">Update Slider</button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        $('#slidersTable').DataTable();

        $('.edit-btn').on('click', function() {
            var slug = $(this).data('slug');
            $('#edit_slider_slug').val(slug);
            $('#edit_title').val($(this).data('title'));
            $('#edit_description').val($(this).data('description'));
            $('#edit_url').val($(this).data('url'));
            $('#edit_status').val($(this).data('status'));
        });
    });
</script>
@endpush

@endsection
