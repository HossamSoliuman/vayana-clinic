@extends('layouts.admin')

@section('title', 'Inquiry Details')

@section('content')
<div class="flex items-center justify-between mb-8">
    <h2 class="text-2xl font-bold text-text">{{ __('messages.inquiry_details') }}</h2>
    <a href="{{ route('admin.business-inquiries.index') }}" class="inline-flex items-center gap-2 px-4 py-2 border border-border text-text-muted rounded-lg hover:bg-surface-secondary transition-colors text-sm"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><path d="m12 19-7-7 7-7"/><path d="M19 12H5"/></svg> Back</a>
</div>
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="lg:col-span-2">
        <div class="bg-surface rounded-xl border border-border">
            <div class="px-6 py-4 border-b border-border font-semibold text-sm text-text">Information</div>
            <div class="p-6">
                <table class="w-full text-sm">
                    <tbody>
                        <tr><td class="px-0 py-2 text-text-muted font-medium w-48">Organization:</td><td class="px-0 py-2 text-text">{{ $inquiry->organization_name }}</td></tr>
                        <tr><td class="px-0 py-2 text-text-muted font-medium">Contact Person:</td><td class="px-0 py-2 text-text">{{ $inquiry->contact_person_name }}</td></tr>
                        <tr><td class="px-0 py-2 text-text-muted font-medium">Email:</td><td class="px-0 py-2 text-text">{{ $inquiry->email }}</td></tr>
                        <tr><td class="px-0 py-2 text-text-muted font-medium">Phone:</td><td class="px-0 py-2 text-text">{{ $inquiry->phone }}</td></tr>
                        <tr><td class="px-0 py-2 text-text-muted font-medium">Type of Service:</td><td class="px-0 py-2 text-text">{{ $inquiry->type_of_service ?? 'N/A' }}</td></tr>
                        <tr><td class="px-0 py-2 text-text-muted font-medium">Organization Size:</td><td class="px-0 py-2 text-text">{{ $inquiry->organization_size ?? 'N/A' }}</td></tr>
                        <tr><td class="px-0 py-2 text-text-muted font-medium align-top">Message:</td><td class="px-0 py-2 text-text">{{ $inquiry->message ?? 'N/A' }}</td></tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="lg:col-span-1">
        <div class="bg-surface rounded-xl border border-border">
            <div class="px-6 py-4 border-b border-border font-semibold text-sm text-text">Manage</div>
            <div class="p-6">
                <form action="{{ route('admin.business-inquiries.update', $inquiry) }}" method="POST">
                    @csrf
                    <label class="block text-sm font-medium text-text mb-1.5">{{ __('messages.status') }}</label>
                    <select name="status" class="w-full rounded-lg border border-border px-3 py-2 text-sm text-text bg-surface focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary mb-3">
                        <option value="new" {{ $inquiry->status=='new'?'selected':'' }}>New</option>
                        <option value="in_progress" {{ $inquiry->status=='in_progress'?'selected':'' }}>In Progress</option>
                        <option value="contacted" {{ $inquiry->status=='contacted'?'selected':'' }}>Contacted</option>
                        <option value="closed" {{ $inquiry->status=='closed'?'selected':'' }}>Closed</option>
                    </select>
                    <label class="block text-sm font-medium text-text mb-1.5">{{ __('messages.assign_to') }}</label>
                    <select name="assigned_to" class="w-full rounded-lg border border-border px-3 py-2 text-sm text-text bg-surface focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary mb-3">
                        <option value="">{{ __('messages.unassigned') }}</option>
                        @foreach($staff as $s)
                            <option value="{{ $s->id }}" {{ $inquiry->assigned_to==$s->id?'selected':'' }}>{{ $s->full_name }}</option>
                        @endforeach
                    </select>
                    <textarea name="admin_notes" class="w-full rounded-lg border border-border px-3 py-2 text-sm text-text bg-surface focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary mb-4" placeholder="Notes...">{{ $inquiry->admin_notes }}</textarea>
                    <button type="submit" class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-primary text-white rounded-lg hover:bg-primary-hover transition-colors text-sm font-medium">{{ __('messages.update') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
