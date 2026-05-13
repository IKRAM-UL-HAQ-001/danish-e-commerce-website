@extends('dashboard.layouts.app')

@section('title', 'Edit Terms and Conditions')

@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-header">Edit Terms and Conditions</div>

            <div class="card-body">

                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('dashboard.terms.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group mb-3">
                        <label for="content">Content</label>

                        <textarea
                            name="content"
                            id="content"
                            rows="10"
                            class="form-control"
                        >{{ old('content', $term ? $term->content : '') }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">
                        Save
                    </button>
                </form>

            </div>
        </div>
    </div>
</div>

<!-- CKEditor -->
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>

<script>
    ClassicEditor
        .create(document.querySelector('#content'))
        .catch(error => {
            console.error(error);
        });
</script>
@endsection
