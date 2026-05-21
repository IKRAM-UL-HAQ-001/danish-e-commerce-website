@extends('dashboard.layouts.app')

@section('title', 'Edit Terms & Conditions')

@section('content')

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Manage Terms & Conditions</h4>
                <p class="card-description">This content will be linked on the registration page.</p>

                <form action="{{ route('pages.terms.update') }}" method="POST" class="forms-sample">
                    @csrf

                    <div class="form-group mb-4">
                        <label for="content">Policy Content (HTML support)</label>

                        <textarea
                            name="content"
                            id="content"
                            class="form-control"
                            rows="15"
                            placeholder="Enter full terms and conditions..."
                        >{{ $content->value ?? '' }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-primary me-2 text-white">Update Terms</button>
                    <a href="{{ route('dashboard') }}" class="btn btn-light">Cancel</a>
                    <a href="{{ route('public.terms') }}" target="_blank" class="btn btn-info text-white">View Public Link</a>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- CKEditor -->
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
