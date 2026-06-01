@extends('dashboard.layouts.app')

@section('title', 'Edit Terms and Conditions')

@section('content')
<div class="row">
    <div class="col-md-10 offset-md-1">

        <!-- Sections Card -->
        <div class="card">
            <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                <span>Accordion Sections</span>
                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#addSectionModal">
                    Add New Section
                </button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Order</th>
                                <th>Title</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($sections as $section)
                            <tr>
                                <td>{{ $section->order }}</td>
                                <td>{{ $section->title }}</td>
                                <td>
                                    <button class="btn btn-sm btn-info edit-section-btn" 
                                        data-id="{{ $section->id }}" 
                                        data-title="{{ $section->title }}" 
                                        data-content="{{ $section->content }}" 
                                        data-order="{{ $section->order }}"
                                        data-bs-toggle="modal" data-bs-target="#editSectionModal">Edit</button>
                                    
                                    <form action="{{ route('dashboard.terms.section.delete') }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $section->id }}">
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this section?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="text-center">No sections added yet.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Section Modal -->
<div class="modal fade" id="addSectionModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form action="{{ route('dashboard.terms.section.store') }}" method="POST" class="modal-content">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title">Add New Accordion Section</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group mb-3">
                    <label>Section Title</label>
                    <input type="text" name="title" class="form-control" required placeholder="e.g. Visionary Leadership">
                </div>
                <div class="form-group mb-3">
                    <label>Content</label>
                    <textarea name="content" id="add_section_content" class="form-control" rows="5"></textarea>
                </div>
                <div class="form-group mb-3">
                    <label>Display Order</label>
                    <input type="number" name="order" class="form-control" value="0">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save Section</button>
            </div>
        </form>
    </div>
</div>

<!-- Edit Section Modal -->
<div class="modal fade" id="editSectionModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form action="{{ route('dashboard.terms.section.update') }}" method="POST" class="modal-content">
            @csrf
            <input type="hidden" name="id" id="edit_section_id">
            <div class="modal-header">
                <h5 class="modal-title">Edit Accordion Section</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group mb-3">
                    <label>Section Title</label>
                    <input type="text" name="title" id="edit_section_title" class="form-control" required>
                </div>
                <div class="form-group mb-3">
                    <label>Content</label>
                    <textarea name="content" id="edit_section_content_area" class="form-control" rows="5"></textarea>
                </div>
                <div class="form-group mb-3">
                    <label>Display Order</label>
                    <input type="number" name="order" id="edit_section_order" class="form-control">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Update Section</button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<script>
    let editors = {};

    function initEditor(selector) {
        ClassicEditor
            .create(document.querySelector(selector))
            .then(editor => {
                editors[selector] = editor;
            })
            .catch(error => console.error(error));
    }

    $(document).ready(function() {
        initEditor('#main_content');
        initEditor('#add_section_content');
        initEditor('#edit_section_content_area');

        $('.edit-section-btn').on('click', function() {
            const id = $(this).data('id');
            const title = $(this).data('title');
            const content = $(this).data('content');
            const order = $(this).data('order');

            $('#edit_section_id').val(id);
            $('#edit_section_title').val(title);
            $('#edit_section_order').val(order);
            
            if (editors['#edit_section_content_area']) {
                editors['#edit_section_content_area'].setData(content);
            }
        });
    });
</script>
@endpush
@endsection
