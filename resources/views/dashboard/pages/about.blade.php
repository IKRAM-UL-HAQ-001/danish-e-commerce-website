@extends('dashboard.layouts.app')

@section('title', 'Edit About Us')

@section('content')

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Manage About Us Content</h4>
                <p class="card-description">This content will be displayed on the frontend About page.</p>

                <form action="{{ route('pages.about.update') }}" method="POST" enctype="multipart/form-data" class="forms-sample">
                    @csrf

                    <div class="form-group mb-4">
                        <label for="image">About Us Image</label>
                        <input type="file" name="image" id="image" class="form-control" accept="image/*">
                        @if(isset($image) && $image->value)
                            <div class="mt-2">
                                <img src="{{ asset('storage/' . $image->value) }}" alt="About Image" width="150">
                            </div>
                        @endif
                    </div>

                    <div class="form-group mb-4">
                        <label for="content">Page Content (HTML support)</label>

                        <textarea
                            name="content"
                            id="content"
                            class="form-control"
                            rows="15"
                            placeholder="Enter About Us content..."
                        >{{ $content->value ?? '' }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-primary me-2 text-white">
                        Update About Page
                    </button>

                    <a href="{{ route('dashboard') }}" class="btn btn-light">
                        Cancel
                    </a>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- CKEditor 5 -->
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>

<script>
    ClassicEditor
        .create(document.querySelector('#content'), {
            toolbar: [
                'heading', '|',
                'bold', 'italic', 'link', 'bulletedList', 'numberedList', '|',
                'blockQuote', 'insertTable', 'undo', 'redo'
            ]
        })
        .catch(error => {
            console.error(error);
        });
</script>

@endsection
