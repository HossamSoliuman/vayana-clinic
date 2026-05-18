@extends('layouts.admin')

@section('title', 'Application Details')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Application Details</h2>
    <a href="{{ route('admin.applications.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left"></i> Back</a>
</div>

<div class="row g-4">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Applicant Information</div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr><td><strong>Full Name:</strong></td><td>{{ $application->full_name }}</td></tr>
                    <tr><td><strong>Email:</strong></td><td>{{ $application->email }}</td></tr>
                    <tr><td><strong>Phone:</strong></td><td>{{ $application->phone }}</td></tr>
                    <tr><td><strong>Specialty:</strong></td><td>{{ $application->specialty ?? 'N/A' }}</td></tr>
                    <tr><td><strong>License Number:</strong></td><td>{{ $application->license_number }}</td></tr>
                    <tr><td><strong>Preferred Work Type:</strong></td><td>{{ $application->preferred_work_type }}</td></tr>
                    <tr><td><strong>Availability:</strong></td><td>{{ $application->availability_description ?? 'N/A' }}</td></tr>
                    <tr><td><strong>Biography:</strong></td><td>{{ $application->biography }}</td></tr>
                    <tr><td><strong>Documents:</strong></td>
                        <td>
                            @if($application->license_document_path) <a href="{{ Storage::disk('private')->url($application->license_document_path) }}" target="_blank" class="btn btn-sm btn-outline-primary"><i class="bi bi-file-earmark-pdf"></i> License</a> @endif
                            @if($application->cv_path) <a href="{{ Storage::disk('private')->url($application->cv_path) }}" target="_blank" class="btn btn-sm btn-outline-primary"><i class="bi bi-file-earmark-pdf"></i> CV</a> @endif
                        </td>
                    </tr>
                    <tr><td><strong>Current Status:</strong></td><td><span class="badge bg-primary">{{ $application->status }}</span></td></tr>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">Actions</div>
            <div class="card-body">
                <form action="{{ route('admin.applications.status', $application) }}" method="POST" class="mb-3">
                    @csrf
                    <label class="form-label">Update Status</label>
                    <select name="status" class="form-select mb-2">
                        <option value="submitted" {{ $application->status === 'submitted' ? 'selected' : '' }}>Submitted</option>
                        <option value="under_review" {{ $application->status === 'under_review' ? 'selected' : '' }}>Under Review</option>
                        <option value="interview_scheduled" {{ $application->status === 'interview_scheduled' ? 'selected' : '' }}>Interview Scheduled</option>
                        <option value="approved" {{ $application->status === 'approved' ? 'selected' : '' }}>Approved</option>
                        <option value="rejected" {{ $application->status === 'rejected' ? 'selected' : '' }}>Rejected</option>
                    </select>
                    <textarea name="review_notes" class="form-control mb-2" placeholder="Review notes...">{{ $application->review_notes }}</textarea>
                    <textarea name="rejection_reason" class="form-control mb-2" placeholder="Rejection reason (if rejecting)...">{{ $application->rejection_reason }}</textarea>
                    <button type="submit" class="btn btn-primary w-100">Update Status</button>
                </form>

                @if($application->status !== 'interview_scheduled' && $application->status !== 'approved' && $application->status !== 'rejected')
                    <form action="{{ route('admin.applications.interview', $application) }}" method="POST" class="mb-3">
                        @csrf
                        <label class="form-label">Schedule Interview</label>
                        <input type="datetime-local" name="interview_date" class="form-control mb-2" required>
                        <button type="submit" class="btn btn-info w-100">Schedule Interview</button>
                    </form>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
