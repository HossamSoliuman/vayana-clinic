@extends('layouts.admin')

@section('title', 'Application Details')

@section('content')
<div class="flex items-center justify-between mb-8">
    <h2 class="text-2xl font-bold text-text">Application Details</h2>
    <a href="{{ route('admin.applications.index') }}" class="inline-flex items-center gap-2 px-4 py-2 border border-border text-text-muted rounded-lg hover:bg-surface-secondary transition-colors text-sm"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><path d="m12 19-7-7 7-7"/><path d="M19 12H5"/></svg> Back</a>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="lg:col-span-2">
        <div class="bg-surface rounded-xl border border-border">
            <div class="px-6 py-4 border-b border-border font-semibold text-sm text-text">Applicant Information</div>
            <div class="p-6">
                <table class="w-full text-sm">
                    <tbody>
                        <tr><td class="px-0 py-2 text-text-muted font-medium w-48">Full Name:</td><td class="px-0 py-2 text-text">{{ $application->full_name }}</td></tr>
                        <tr><td class="px-0 py-2 text-text-muted font-medium">Email:</td><td class="px-0 py-2 text-text">{{ $application->email }}</td></tr>
                        <tr><td class="px-0 py-2 text-text-muted font-medium">Phone:</td><td class="px-0 py-2 text-text">{{ $application->phone }}</td></tr>
                        <tr><td class="px-0 py-2 text-text-muted font-medium">Specialty:</td><td class="px-0 py-2 text-text">{{ $application->specialty ?? 'N/A' }}</td></tr>
                        <tr><td class="px-0 py-2 text-text-muted font-medium">License Number:</td><td class="px-0 py-2 text-text">{{ $application->license_number }}</td></tr>
                        <tr><td class="px-0 py-2 text-text-muted font-medium">Preferred Work Type:</td><td class="px-0 py-2 text-text">{{ $application->preferred_work_type }}</td></tr>
                        <tr><td class="px-0 py-2 text-text-muted font-medium">Availability:</td><td class="px-0 py-2 text-text">{{ $application->availability_description ?? 'N/A' }}</td></tr>
                        <tr><td class="px-0 py-2 text-text-muted font-medium">Biography:</td><td class="px-0 py-2 text-text">{{ $application->biography }}</td></tr>
                        <tr><td class="px-0 py-2 text-text-muted font-medium">Documents:</td>
                            <td class="px-0 py-2">
                                <div class="flex gap-2">
                                @if($application->license_document_path) <a href="{{ Storage::disk('private')->url($application->license_document_path) }}" target="_blank" class="inline-flex items-center gap-1.5 px-3 py-1.5 border border-primary/30 text-primary rounded-lg hover:bg-primary/5 text-xs font-medium transition-colors"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"/><path d="M14 2v4a2 2 0 0 0 2 2h4"/><path d="M10 9H8"/><path d="M16 13H8"/><path d="M16 17H8"/></svg> License</a> @endif
                                @if($application->cv_path) <a href="{{ Storage::disk('private')->url($application->cv_path) }}" target="_blank" class="inline-flex items-center gap-1.5 px-3 py-1.5 border border-primary/30 text-primary rounded-lg hover:bg-primary/5 text-xs font-medium transition-colors"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"/><path d="M14 2v4a2 2 0 0 0 2 2h4"/><path d="M10 9H8"/><path d="M16 13H8"/><path d="M16 17H8"/></svg> CV</a> @endif
                                </div>
                            </td>
                        </tr>
                        <tr><td class="px-0 py-2 text-text-muted font-medium">Current Status:</td><td class="px-0 py-2 text-text"><span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-primary text-white">{{ $application->status }}</span></td></tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="lg:col-span-1">
        <div class="bg-surface rounded-xl border border-border">
            <div class="px-6 py-4 border-b border-border font-semibold text-sm text-text">Actions</div>
            <div class="p-6">
                <form action="{{ route('admin.applications.status', $application) }}" method="POST" class="mb-6">
                    @csrf
                    <label class="block text-sm font-medium text-text mb-1.5">Update Status</label>
                    <select name="status" class="w-full rounded-lg border border-border px-3 py-2 text-sm text-text bg-surface focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary mb-3">
                        <option value="submitted" {{ $application->status === 'submitted' ? 'selected' : '' }}>Submitted</option>
                        <option value="under_review" {{ $application->status === 'under_review' ? 'selected' : '' }}>Under Review</option>
                        <option value="interview_scheduled" {{ $application->status === 'interview_scheduled' ? 'selected' : '' }}>Interview Scheduled</option>
                        <option value="approved" {{ $application->status === 'approved' ? 'selected' : '' }}>Approved</option>
                        <option value="rejected" {{ $application->status === 'rejected' ? 'selected' : '' }}>Rejected</option>
                    </select>
                    <textarea name="review_notes" class="w-full rounded-lg border border-border px-3 py-2 text-sm text-text bg-surface focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary mb-3" placeholder="Review notes...">{{ $application->review_notes }}</textarea>
                    <textarea name="rejection_reason" class="w-full rounded-lg border border-border px-3 py-2 text-sm text-text bg-surface focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary mb-3" placeholder="Rejection reason (if rejecting)...">{{ $application->rejection_reason }}</textarea>
                    <button type="submit" class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-primary text-white rounded-lg hover:bg-primary-hover transition-colors text-sm font-medium">Update Status</button>
                </form>

                @if($application->status !== 'interview_scheduled' && $application->status !== 'approved' && $application->status !== 'rejected')
                    <div class="border-t border-border pt-6 mt-2">
                        <form action="{{ route('admin.applications.interview', $application) }}" method="POST">
                            @csrf
                            <label class="block text-sm font-medium text-text mb-1.5">Schedule Interview</label>
                            <input type="datetime-local" name="interview_date" class="w-full rounded-lg border border-border px-3 py-2 text-sm text-text bg-surface focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary mb-3" required>
                            <button type="submit" class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-info text-white rounded-lg hover:bg-blue-600 transition-colors text-sm font-medium">Schedule Interview</button>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
