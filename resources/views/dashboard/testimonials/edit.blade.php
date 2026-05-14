@extends('dashboard.layouts.app')
@section('title', 'Edit Testimonial')
@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-header">Edit Testimonial</div>
            <div class="card-body">
                <form action="{{ route('dashboard.testimonials.update', $testimonial) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group mb-3">
                        <label for="author">Author</label>
                        <input type="text" name="author" id="author" class="form-control" value="{{ old('author', $testimonial->author) }}" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="designation">Designation</label>
                        <input type="text" name="designation" id="designation" class="form-control" value="{{ old('designation', $testimonial->designation) }}">
                    </div>
                    <div class="form-group mb-3">
                        <label for="text">Testimonial</label>
                        <textarea name="text" id="text" rows="4" class="form-control" required>{{ old('text', $testimonial->text) }}</textarea>
                    </div>
                    <div class="form-group mb-3">
                        <label for="image">Image</label>
                        <input type="file" name="image" id="image" class="form-control">
                        @if($testimonial->image)
                            <img src="{{ asset('storage/' . $testimonial->image) }}" alt="{{ $testimonial->author }}" width="60" height="60" style="object-fit:cover; border-radius:50%; margin-top:10px;">
                        @endif
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
