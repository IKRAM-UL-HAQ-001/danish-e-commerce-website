@extends('dashboard.layouts.app')

@section('title', 'Edit Contact Us')

@section('content')

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Manage Contact Us Content</h4>
                <p class="card-description">Updates here will reflect on your frontend Contact page.</p>
                <form action="{{ route('pages.contact.update') }}" method="POST" class="forms-sample">
                    @csrf
                    <div class="form-group mb-4">
                        <label for="content">Page Content (HTML support)</label>
                        <textarea name="content" class="form-control" id="content" rows="15" placeholder="Enter Contact Us information...">{{ $content->value ?? '' }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary me-2 text-white">Update Contact Page</button>
                    <a href="{{ route('dashboard') }}" class="btn btn-light">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
