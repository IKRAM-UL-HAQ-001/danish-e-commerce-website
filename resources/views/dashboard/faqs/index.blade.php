@extends('dashboard.layouts.app')

@section('title', 'Manage FAQs')

@section('content')

<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h4 class="card-title">Frequently Asked Questions</h4>
                        <p class="card-description">Manage standard FAQs shown to your customers.</p>
                    </div>
                    <button type="button" class="btn btn-primary text-white" data-bs-toggle="modal" data-bs-toggle="modal" data-bs-target="#addFaqModal">
                        Add New FAQ
                    </button>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Question</th>
                                <th>Answer</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($faqs as $faq)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ Str::limit($faq->question, 40) }}</td>
                                <td>{{ Str::limit($faq->answer, 40) }}</td>
                                <td>
                                    @if($faq->status)
                                        <label class="badge badge-success">Active</label>
                                    @else
                                        <label class="badge badge-danger">Hidden</label>
                                    @endif
                                </td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-info text-white" data-bs-toggle="modal" data-bs-target="#editFaqModal{{ $faq->slug }}">
                                        Edit
                                    </button>
                                    <form action="{{ route('faqs.destroy') }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this FAQ?');">
                                        @csrf
                                        <input type="hidden" name="slug" value="{{ $faq->slug }}">
                                        <button type="submit" class="btn btn-sm btn-danger text-white">Delete</button>
                                    </form>
                                </td>
                            </tr>

                            <!-- Edit Modal -->
                            <div class="modal fade" id="editFaqModal{{ $faq->slug }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit FAQ</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('faqs.update') }}" method="POST">
                                             @csrf
                                             <input type="hidden" name="slug" value="{{ $faq->slug }}">
                                             <div class="modal-body">
                                                <div class="form-group mb-3">
                                                    <label for="question">Question</label>
                                                    <input type="text" name="question" class="form-control" value="{{ $faq->question }}" required>
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="answer">Answer</label>
                                                    <textarea name="answer" class="form-control" rows="4" required>{{ $faq->answer }}</textarea>
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="status">Status</label>
                                                    <select name="status" class="form-control" required>
                                                        <option value="1" {{ $faq->status ? 'selected' : '' }}>Active</option>
                                                        <option value="0" {{ !$faq->status ? 'selected' : '' }}>Hidden</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary text-white">Save Changes</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-4">No FAQs configured yet.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Modal -->
<div class="modal fade" id="addFaqModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create FAQ</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('faqs.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="question">Question</label>
                        <input type="text" name="question" class="form-control" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="answer">Answer</label>
                        <textarea name="answer" class="form-control" rows="4" required></textarea>
                    </div>
                    <div class="form-group mb-3">
                        <label for="status">Status</label>
                        <select name="status" class="form-control" required>
                            <option value="1">Active</option>
                            <option value="0">Hidden</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary text-white">Create FAQ</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
