@extends('layouts.admin')

@section('title', 'Business Inquiries')

@section('content')
<div class="flex items-center justify-between mb-8">
    <h2 class="text-2xl font-bold text-text">{{ __('messages.business_inquiries') }}</h2>
</div>
<div class="bg-surface rounded-xl border border-border">
    <div class="p-6">
        <form method="GET" class="flex flex-wrap items-center gap-4 mb-6">
            <div class="w-full sm:w-auto">
                <select name="status" class="rounded-lg border border-border bg-surface px-3 py-2 text-sm text-text focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary w-full" onchange="this.form.submit()">
                    <option value="">{{ __('messages.all') }}</option>
                    <option value="new" {{ request('status')=='new'?'selected':'' }}>{{ __('messages.new') }}</option>
                    <option value="in_progress" {{ request('status')=='in_progress'?'selected':'' }}>{{ __('messages.in_progress') }}</option>
                    <option value="contacted" {{ request('status')=='contacted'?'selected':'' }}>{{ __('messages.contacted') }}</option>
                    <option value="closed" {{ request('status')=='closed'?'selected':'' }}>{{ __('messages.closed') }}</option>
                </select>
            </div>
        </form>
        <div class="overflow-x-auto mb-4">
            <table class="w-full text-sm ltr:text-left rtl:text-right">
                <thead>
                    <tr>
                        <th class="px-6 py-3 text-xs font-semibold uppercase tracking-wider text-text-muted bg-surface-secondary border-b border-border">{{ __('messages.organization') }}</th>
                        <th class="px-6 py-3 text-xs font-semibold uppercase tracking-wider text-text-muted bg-surface-secondary border-b border-border">{{ __('messages.contact') }}</th>
                        <th class="px-6 py-3 text-xs font-semibold uppercase tracking-wider text-text-muted bg-surface-secondary border-b border-border">{{ __('messages.service') }}</th>
                        <th class="px-6 py-3 text-xs font-semibold uppercase tracking-wider text-text-muted bg-surface-secondary border-b border-border">{{ __('messages.status') }}</th>
                        <th class="px-6 py-3 text-xs font-semibold uppercase tracking-wider text-text-muted bg-surface-secondary border-b border-border">{{ __('messages.assigned_to') }}</th>
                        <th class="px-6 py-3 text-xs font-semibold uppercase tracking-wider text-text-muted bg-surface-secondary border-b border-border">{{ __('messages.submitted') }}</th>
                        <th class="px-6 py-3 text-xs font-semibold uppercase tracking-wider text-text-muted bg-surface-secondary border-b border-border">{{ __('messages.actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($inquiries as $inquiry)
                        <tr class="border-b border-border hover:bg-surface-secondary/50 transition-colors">
                            <td class="px-6 py-4 text-sm text-text">{{ $inquiry->organization_name }}</td>
                            <td class="px-6 py-4 text-sm text-text">{{ $inquiry->contact_person_name }}<br><small class="text-text-muted">{{ $inquiry->email }}</small></td>
                            <td class="px-6 py-4 text-sm text-text">{{ $inquiry->type_of_service ?? 'N/A' }}</td>
                            <td class="px-6 py-4 text-sm text-text"><span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $inquiry->status=='new'?'bg-blue-50 text-blue-700':($inquiry->status=='closed'?'bg-slate-100 text-slate-600':($inquiry->status=='contacted'?'bg-emerald-50 text-emerald-700':'bg-amber-50 text-amber-700')) }}">{{ $inquiry->status }}</span></td>
                            <td class="px-6 py-4 text-sm text-text">{{ $inquiry->assignedUser?->full_name ?? 'Unassigned' }}</td>
                            <td class="px-6 py-4 text-sm text-text">{{ $inquiry->created_at->format('M d, Y') }}</td>
                            <td class="px-6 py-4 text-sm text-text">
                                <div class="flex items-center gap-1.5">
                                    <a href="{{ route('admin.business-inquiries.show',$inquiry) }}" class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-100 transition-colors"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/></svg></a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="7" class="text-center text-text-muted py-8">No inquiries</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{ $inquiries->links() }}
    </div>
</div>
@endsection
