@extends('dashboard.layouts.app')

@section('title', 'Users Management')

@section('content')

<div class="row">
    <div class="col-sm-12">
        <div class="card card-rounded">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="card-title">User Accounts</h4>
                </div>
                <div class="table-responsive">
                    <table class="table" id="usersTable">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Join Date</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <span class="badge {{ $user->role == 'admin' ? 'badge-primary' : 'badge-info' }}">
                                        {{ ucfirst($user->role) }}
                                    </span>
                                </td>
                                <td>{{ $user->created_at->format('M d, Y') }}</td>
                                <td>
                                    <label class="badge {{ $user->status ? 'badge-success' : 'badge-danger' }}">
                                        {{ $user->status ? 'Active' : 'Deactivated' }}
                                    </label>
                                </td>
                                <td>
                                    <form action="{{ route('users.toggleStatus') }}" method="POST" style="display:inline;">
                                        @csrf
                                        <input type="hidden" name="slug" value="{{ $user->slug }}">
                                        <button type="submit" class="btn btn-sm btn-icon" title="{{ $user->status ? 'Deactivate' : 'Activate' }}">
                                            <i class="mdi {{ $user->status ? 'mdi-account-off text-warning' : 'mdi-account-check text-success' }}"></i>
                                        </button>
                                    </form>
                                    @if($user->id !== auth()->id())
                                    <form action="{{ route('users.destroy') }}" method="POST" style="display:inline;">
                                        @csrf
                                        <input type="hidden" name="slug" value="{{ $user->slug }}">
                                        <button type="submit" class="btn btn-sm btn-icon" onclick="return confirm('Are you sure you want to delete this user?')" title="Delete User">
                                            <i class="mdi mdi-delete text-danger"></i>
                                        </button>
                                    </form>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<link rel="stylesheet" href="{{ asset('assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">
<script src="{{ asset('assets/vendors/datatables.net/jquery.dataTables.js') }}"></script>
<script src="{{ asset('assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>
<script>
    $(document).ready(function() {
        $('#usersTable').DataTable();
    });
</script>
@endpush

@endsection
