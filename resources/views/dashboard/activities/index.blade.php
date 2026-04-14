@extends('dashboard.layouts.app')

@section('title', 'Activity Log')

@section('content')

<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">System Activity Log</h4>
                <p class="card-description">Track recent actions performed on your account and platform.</p>
                
                <div class="table-responsive">
                    <table class="table table-striped text-center">
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Action</th>
                                <th>Description</th>
                                <th>Date & Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($activities as $activity)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center justify-content-center">
                                        @if($activity->user->profile_picture)
                                            <img src="{{ asset('storage/' . $activity->user->profile_picture) }}" alt="alt" class="img-xs rounded-circle me-2" style="object-fit: cover;">
                                        @else
                                            <img src="{{ asset('assets/images/faces/face8.jpg') }}" alt="alt" class="img-xs rounded-circle me-2">
                                        @endif
                                        <span>{{ $activity->user->name }}</span>
                                    </div>
                                </td>
                                <td><span class="badge badge-info text-white">{{ $activity->action }}</span></td>
                                <td>{{ $activity->description }}</td>
                                <td>{{ $activity->created_at->format('M d, Y h:i A') }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center py-4">No activities logged yet.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                <div class="mt-4">
                    {{ $activities->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
