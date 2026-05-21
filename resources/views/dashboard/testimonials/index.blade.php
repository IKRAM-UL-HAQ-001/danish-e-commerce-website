@extends('dashboard.layouts.app')
@section('title', 'Testimonials')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4>Testimonials</h4>
                <a href="{{ route('dashboard.testimonials.create') }}" class="btn btn-primary btn-sm">Add New</a>
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Author</th>
                            <th>Designation</th>
                            <th>Text</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($testimonials as $testimonial)
                        <tr>
                            <td>
                                @if($testimonial->image)
                                    <img src="{{ asset('storage/' . $testimonial->image) }}" alt="{{ $testimonial->author }}" width="60" height="60" style="object-fit:cover; border-radius:50%;">
                                @else
                                    <span class="text-muted">No Image</span>
                                @endif
                            </td>
                            <td>{{ $testimonial->author }}</td>
                            <td>{{ $testimonial->designation }}</td>
                            <td>{{ Str::limit($testimonial->text, 50) }}</td>
                            <td>
                                <a href="{{ route('dashboard.testimonials.edit', $testimonial) }}" class="btn btn-sm btn-info">Edit</a>
                                <form action="{{ route('dashboard.testimonials.destroy', $testimonial) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this testimonial?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
