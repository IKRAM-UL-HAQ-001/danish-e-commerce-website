@extends('dashboard.layouts.app')
@section('title', 'Add Testimonial')
@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-header">Add Testimonial</div>
            <div class="card-body">
                <form action="{{ route('dashboard.testimonials.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="author">Author</label>
                        <input type="text" name="author" id="author" class="form-control" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="designation">Designation</label>
                        <input type="text" name="designation" id="designation" class="form-control">
                    </div>
                    <div class="form-group mb-3">
                        <label for="text">Testimonial</label>
                        <textarea name="text" id="text" rows="4" class="form-control" required></textarea>
                    </div>
                    <div class="form-group mb-3">
                        <label for="image">Image</label>
                        <input type="file" name="image" id="image" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary">Add</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
