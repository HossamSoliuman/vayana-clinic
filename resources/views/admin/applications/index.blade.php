@extends('layouts.admin')

@section('title', 'Provider Applications')

@section('content')
<div class="flex items-center justify-between mb-8">
    <h2 class="text-2xl font-bold text-text">Provider Applications</h2>
</div>

<div class="bg-surface rounded-xl border border-border">
    <div class="p-6">
        <form method="GET" class="flex flex-wrap items-center gap-4 mb-6">
            <div class="w-full sm:w-auto">
                <select name="status" class="rounded-lg border border-border bg-surface px-3 py-2 text-sm text-text focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary w-full" onchange="this.form.submit()">
                    <option value="">All Status</option>
                    <option value="submitted" {{ request('status') === 'submitted' ? 'selected' : '' }}>Submitted</option>
                    <option value="under_review" {{ request('status') === 'under_review' ? 'selected' : '' }}>Under Review</option>
                    <option value="interview_scheduled" {{ request('status') === 'interview_scheduled' ? 'selected' : '' }}>Interview Scheduled</option>
                    <option value="approved" {{ request('status') === 'approved' ? 'selected' : '' }}>Approved</option>
                    <option value="rejected" {{ request('status') === 'rejected' ? 'selected' : '' }}>Rejected</option>
                </select>
            </div>
        </form>

        <div class="overflow-x-auto mb-4">
            <table class="w-full text-sm ltr:text-left rtl:text-right">
                <thead>
                    <tr>
                        <th class="px-6 py-3 text-xs font-semibold uppercase tracking-wider text-text-muted bg-surface-secondary border-b border-border">Name</th>
                        <th class="px-6 py-3 text-xs font-semibold uppercase tracking-wider text-text-muted bg-surface-secondary border-b border-border">Email</th>
                        <th class="px-6 py-3 text-xs font-semibold uppercase tracking-wider text-text-muted bg-surface-secondary border-b border-border">Specialty</th>
                        <th class="px-6 py-3 text-xs font-semibold uppercase tracking-wider text-text-muted bg-surface-secondary border-b border-border">Work Type</th>
                        <th class="px-6 py-3 text-xs font-semibold uppercase tracking-wider text-text-muted bg-surface-secondary border-b border-border">Status</th>
                        <th class="px-6 py-3 text-xs font-semibold uppercase tracking-wider text-text-muted bg-surface-secondary border-b border-border">Applied</th>
                        <th class="px-6 py-3 text-xs font-semibold uppercase tracking-wider text-text-muted bg-surface-secondary border-b border-border">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($applications as $app)
                        <tr class="border-b border-border hover:bg-surface-secondary/50 transition-colors">
                            <td class="px-6 py-4 text-sm text-text">{{ $app->full_name }}</td>
                            <td class="px-6 py-4 text-sm text-text">{{ $app->email }}</td>
                            <td class="px-6 py-4 text-sm text-text">{{ $app->specialty ?? 'N/A' }}</td>
                            <td class="px-6 py-4 text-sm text-text">{{ $app->preferred_work_type }}</td>
                            <td class="px-6 py-4 text-sm text-text"><span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $app->status === 'approved' ? 'bg-emerald-50 text-emerald-700' : ($app->status === 'rejected' ? 'bg-red-50 text-red-700' : ($app->status === 'interview_scheduled' ? 'bg-blue-50 text-blue-700' : 'bg-amber-50 text-amber-700')) }}">{{ $app->status }}</span></td>
                            <td class="px-6 py-4 text-sm text-text">{{ $app->created_at->format('M d, Y') }}</td>
                            <td class="px-6 py-4 text-sm text-text">
                                <div class="flex items-center gap-1.5">
                                    <a href="{{ route('admin.applications.show', $app) }}" class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-100 transition-colors"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/></svg></a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="7" class="text-center text-text-muted py-8">No applications found</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{ $applications->links() }}
    </div>
</div>
@endsection
