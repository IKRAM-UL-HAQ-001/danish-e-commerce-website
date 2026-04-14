@extends('dashboard.layouts.app')

@section('title', 'Edit About Us')

@section('content')

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Manage About Us Content</h4>
                <p class="card-description">This content will be displayed on the frontend About page.</p>
                <form action="{{ route('pages.about.update') }}" method="POST" class="forms-sample">
                    @csrf
                    <div class="form-group mb-4">
                        <label for="content">Page Content (HTML support)</label>
                        <textarea name="content" class="form-control" id="content" rows="15" placeholder="Enter About Us content...">{{ $content->value ?? '' }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary me-2 text-white">Update About Page</button>
                    <a href="{{ route('dashboard') }}" class="btn btn-light">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
