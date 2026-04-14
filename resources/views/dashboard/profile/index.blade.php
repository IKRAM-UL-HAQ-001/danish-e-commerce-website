@extends('dashboard.layouts.app')

@section('title', 'My Profile')

@section('content')

<div class="row">
    <div class="col-md-8 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Profile Information</h4>
                <p class="card-description">Update your account detail and password.</p>
                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="forms-sample">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="profile_picture">Profile Picture (Recommended: 300x300, max 15MB)</label>
                        <input type="file" name="profile_picture" class="form-control" id="profile_picture">
                        <small class="text-muted">Use a square image for best results.</small>
                    </div>
                    <div class="form-group mb-3">
                        <label for="name">Full Name</label>
                        <input type="text" name="name" class="form-control" id="name" value="{{ $user->name }}" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="email">Email Address</label>
                        <input type="email" name="email" class="form-control" id="email" value="{{ $user->email }}" required>
                    </div>
                    <hr>
                    <h4 class="card-title mt-4">Security</h4>
                    <div class="form-group mb-3">
                        <label for="password">New Password (Leave blank to keep current)</label>
                        <input type="password" name="password" class="form-control" id="password">
                    </div>
                    <div class="form-group mb-3">
                        <label for="password_confirmation">Confirm New Password</label>
                        <input type="password" name="password_confirmation" class="form-control" id="password_confirmation">
                    </div>
                    <button type="submit" class="btn btn-primary me-2 text-white">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-4 grid-margin stretch-card">
        <div class="card">
            <div class="card-body text-center">
                @if($user->profile_picture)
                    <img class="img-lg rounded-circle mb-3" src="{{ asset('storage/' . $user->profile_picture) }}" alt="Profile image" style="width: 100px; height: 100px; object-fit: cover;">
                @else
                    <img class="img-lg rounded-circle mb-3" src="{{ asset('assets/images/faces/face8.jpg') }}" alt="Profile image">
                @endif
                <h4>{{ $user->name }}</h4>
                <p class="text-muted">{{ ucfirst($user->role) }}</p>
                <p>{{ $user->email }}</p>
                <hr>
                <p class="small text-muted">Member since {{ $user->created_at->format('M d, Y') }}</p>
            </div>
        </div>
    </div>
</div>

@endsection
