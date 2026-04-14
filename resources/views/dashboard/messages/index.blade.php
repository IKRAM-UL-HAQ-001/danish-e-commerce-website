@extends('dashboard.layouts.app')

@section('title', 'Inbox')

@section('content')

<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Customer Messages</h4>
                <p class="card-description">Inquiries and messages from the contact form.</p>
                
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Status</th>
                                <th>Name</th>
                                <th>Subject</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($messages as $message)
                            <tr class="{{ !$message->is_read ? 'fw-bold bg-light' : '' }}">
                                <td>
                                    @if(!$message->is_read)
                                        <label class="badge badge-danger">New</label>
                                    @else
                                        <label class="badge badge-success">Read</label>
                                    @endif
                                </td>
                                <td>
                                    {{ $message->name }}<br>
                                    <small class="text-muted">{{ $message->email }}</small>
                                </td>
                                <td>{{ Str::limit($message->subject ?? 'No Subject', 50) }}</td>
                                <td>{{ $message->created_at->format('M d, Y h:i A') }}</td>
                                <td>
                                    <form action="{{ route('messages.show') }}" method="POST" class="d-inline">
                                        @csrf
                                        <input type="hidden" name="slug" value="{{ $message->slug }}">
                                        <button type="submit" class="btn btn-sm btn-info text-white">View</button>
                                    </form>
                                    <form action="{{ route('messages.destroy') }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this message?');">
                                        @csrf
                                        <input type="hidden" name="slug" value="{{ $message->slug }}">
                                        <button type="submit" class="btn btn-sm btn-danger text-white">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-4">Your inbox is empty.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                <div class="mt-4">
                    {{ $messages->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
