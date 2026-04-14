@extends('dashboard.layouts.app')

@section('title', 'Database Backups')

@section('content')

<div class="row">
    <div class="col-sm-12">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card card-rounded">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="card-title">Database Backups</h4>
                    <form action="{{ route('backups.create') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary text-white me-0">
                            <i class="mdi mdi-database-plus"></i> Create New Backup
                        </button>
                    </form>
                </div>
                
                <p class="card-description">Manage your manual database backups here. The database dumps are saved in the storage of the project.</p>
                
                <div class="table-responsive">
                    <table class="table table-hover" id="backupsTable">
                        <thead>
                            <tr>
                                <th>File Name</th>
                                <th>Size</th>
                                <th>Date Created</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($backups as $backup)
                            <tr>
                                <td>{{ $backup['name'] }}</td>
                                <td>{{ $backup['size'] }}</td>
                                <td>{{ $backup['date'] }}</td>
                                <td>
                                    <form action="{{ route('backups.download') }}" method="POST" style="display:inline;">
                                        @csrf
                                        <input type="hidden" name="file_name" value="{{ $backup['name'] }}">
                                        <button type="submit" class="btn btn-sm btn-icon btn-success text-white" title="Download">
                                            <i class="mdi mdi-download"></i>
                                        </button>
                                    </form>
                                    <form action="{{ route('backups.destroy') }}" method="POST" style="display:inline;">
                                        @csrf
                                        <input type="hidden" name="file_name" value="{{ $backup['name'] }}">
                                        <button type="submit" class="btn btn-sm btn-icon btn-danger text-white" onclick="return confirm('Are you sure you want to delete this backup file?')" title="Delete">
                                            <i class="mdi mdi-delete"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center">No backups found.</td>
                            </tr>
                            @endforelse
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
        if ($('#backupsTable tbody tr').length > 1 || (!$('.text-center').length && $('#backupsTable tbody tr').length == 1)) {
            $('#backupsTable').DataTable({
                "order": [[ 2, "desc" ]]
            });
        }
    });
</script>
@endpush

@endsection
