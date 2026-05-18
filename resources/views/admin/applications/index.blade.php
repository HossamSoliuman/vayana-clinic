@extends('layouts.admin')

@section('title', 'Provider Applications')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Provider Applications</h2>
</div>

<div class="card">
    <div class="card-body">
        <form method="GET" class="row g-3 mb-3">
            <div class="col-md-3">
                <select name="status" class="form-select" onchange="this.form.submit()">
                    <option value="">All Status</option>
                    <option value="submitted" {{ request('status') === 'submitted' ? 'selected' : '' }}>Submitted</option>
                    <option value="under_review" {{ request('status') === 'under_review' ? 'selected' : '' }}>Under Review</option>
                    <option value="interview_scheduled" {{ request('status') === 'interview_scheduled' ? 'selected' : '' }}>Interview Scheduled</option>
                    <option value="approved" {{ request('status') === 'approved' ? 'selected' : '' }}>Approved</option>
                    <option value="rejected" {{ request('status') === 'rejected' ? 'selected' : '' }}>Rejected</option>
                </select>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Specialty</th>
                        <th>Work Type</th>
                        <th>Status</th>
                        <th>Applied</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($applications as $app)
                        <tr>
                            <td>{{ $app->full_name }}</td>
                            <td>{{ $app->email }}</td>
                            <td>{{ $app->specialty ?? 'N/A' }}</td>
                            <td>{{ $app->preferred_work_type }}</td>
                            <td><span class="badge bg-{{ $app->status === 'approved' ? 'success' : ($app->status === 'rejected' ? 'danger' : ($app->status === 'interview_scheduled' ? 'info' : 'warning text-dark')) }}">{{ $app->status }}</span></td>
                            <td>{{ $app->created_at->format('M d, Y') }}</td>
                            <td class="table-actions">
                                <a href="{{ route('admin.applications.show', $app) }}" class="btn btn-sm btn-info"><i class="bi bi-eye"></i></a>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="7" class="text-center text-muted">No applications found</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{ $applications->links() }}
    </div>
</div>
@endsection
