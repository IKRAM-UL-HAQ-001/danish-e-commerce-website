@extends('dashboard.layouts.app')

@section('title', 'View Message')

@section('content')

<div class="row">
    <div class="col-md-8 mx-auto grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="card-title mb-0">Message Options</h4>
                    <a href="{{ route('messages.index') }}" class="btn btn-sm btn-light">Back to Inbox</a>
                </div>
                <hr>
                
                <h5 class="mt-4 fw-bold">From:</h5>
                <p>{{ $message->name }} &lt;{{ $message->email }}&gt;</p>
                
                <h5 class="mt-4 fw-bold">Subject:</h5>
                <p>{{ $message->subject ?? 'No Subject' }}</p>
                
                <h5 class="mt-4 fw-bold">Date:</h5>
                <p>{{ $message->created_at->format('F d, Y - h:i A') }}</p>
                
                <h5 class="mt-4 fw-bold border-top pt-4">Message:</h5>
                <div class="p-3 bg-light rounded" style="white-space: pre-wrap;">{{ $message->message }}</div>
                
                <div class="mt-4 text-end">
                    <a href="mailto:{{ $message->email }}" class="btn btn-primary text-white">Reply via Email</a>
                    <form action="{{ route('messages.destroy', $message) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this message?');">
                        @csrf
                        <button type="submit" class="btn btn-danger text-white">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
