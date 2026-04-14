@extends('dashboard.layouts.app')

@section('title', 'Site Settings')

@section('content')

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">General Configuration</h4>
                <p class="card-description">Manage your store's public identity and contact details.</p>
                <form action="{{ route('settings.update') }}" method="POST" class="forms-sample">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="site_name">Site Name</label>
                        <input type="text" name="site_name" class="form-control" id="site_name" value="{{ $settings['site_name'] ?? '' }}" placeholder="My Awesome Store">
                    </div>
                    <div class="form-group mb-3">
                        <label for="site_email">Support Email</label>
                        <input type="email" name="site_email" class="form-control" id="site_email" value="{{ $settings['site_email'] ?? '' }}" placeholder="support@myapp.com">
                    </div>
                    <div class="form-group mb-3">
                        <label for="contact_phone">Contact Phone</label>
                        <input type="text" name="contact_phone" class="form-control" id="contact_phone" value="{{ $settings['contact_phone'] ?? '' }}" placeholder="+1 234 567 890">
                    </div>
                    <div class="form-group mb-3">
                        <label for="address">Business Address</label>
                        <textarea name="address" class="form-control" id="address" rows="3">{{ $settings['address'] ?? '' }}</textarea>
                    </div>
                    <hr>
                    <h4 class="card-title mt-4">Social Links</h4>
                    <div class="form-group mb-3">
                        <label for="facebook">Facebook URL</label>
                        <input type="url" name="facebook" class="form-control" id="facebook" value="{{ $settings['facebook'] ?? '' }}">
                    </div>
                    <div class="form-group mb-3">
                        <label for="instagram">Instagram URL</label>
                        <input type="url" name="instagram" class="form-control" id="instagram" value="{{ $settings['instagram'] ?? '' }}">
                    </div>
                    <button type="submit" class="btn btn-primary me-2 text-white">Save All Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
