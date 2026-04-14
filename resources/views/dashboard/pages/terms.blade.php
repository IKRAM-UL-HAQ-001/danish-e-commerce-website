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
                        <textarea name="content" class="form-control" id="content" rows="15" placeholder="Enter full terms and conditions...">{{ $content->value ?? '' }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary me-2 text-white">Update Terms</button>
                    <a href="{{ route('dashboard') }}" class="btn btn-light">Cancel</a>
                    <a href="{{ route('public.terms') }}" target="_blank" class="btn btn-info text-white">View Public Link</a>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
