@extends('layouts.admin')

@section('title', 'Appointment Details')

@section('content')
<div class="flex items-center justify-between mb-8">
    <h2 class="text-2xl font-bold text-text">{{ __('messages.appointment_details') }}</h2>
    <a href="{{ route('admin.appointments.index') }}" class="inline-flex items-center gap-2 px-4 py-2 border border-border text-text-muted rounded-lg hover:bg-surface-secondary transition-colors text-sm"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><path d="m12 19-7-7 7-7"/><path d="M19 12H5"/></svg> Back</a>
</div>
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="lg:col-span-2">
        <div class="bg-surface rounded-xl border border-border">
            <div class="px-6 py-4 border-b border-border font-semibold text-sm text-text">Request Information</div>
            <div class="p-6">
                <table class="w-full text-sm">
                    <tbody>
                        <tr><td class="px-0 py-2 text-text-muted font-medium w-48">Name:</td><td class="px-0 py-2 text-text">{{ $appointment->full_name }}</td></tr>
                        <tr><td class="px-0 py-2 text-text-muted font-medium">Email:</td><td class="px-0 py-2 text-text">{{ $appointment->email }}</td></tr>
                        <tr><td class="px-0 py-2 text-text-muted font-medium">Phone:</td><td class="px-0 py-2 text-text">{{ $appointment->phone }}</td></tr>
                        <tr><td class="px-0 py-2 text-text-muted font-medium">Preferred Provider:</td><td class="px-0 py-2 text-text">{{ $appointment->preferredProvider?->user?->full_name ?? 'No preference' }}</td></tr>
                        <tr><td class="px-0 py-2 text-text-muted font-medium">Preferred Date:</td><td class="px-0 py-2 text-text">{{ $appointment->preferred_date?->format('M d, Y') ?? 'N/A' }}</td></tr>
                        <tr><td class="px-0 py-2 text-text-muted font-medium">Preferred Time:</td><td class="px-0 py-2 text-text">{{ $appointment->preferred_time?->format('H:i') ?? 'N/A' }}</td></tr>
                        <tr><td class="px-0 py-2 text-text-muted font-medium">Reason:</td><td class="px-0 py-2 text-text">{{ $appointment->reason_for_visit ?? 'N/A' }}</td></tr>
                        <tr><td class="px-0 py-2 text-text-muted font-medium">Status:</td><td class="px-0 py-2 text-text"><span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-primary text-white">{{ $appointment->status }}</span></td></tr>
                        <tr><td class="px-0 py-2 text-text-muted font-medium">Clinic Location (EN):</td><td class="px-0 py-2 text-text">{{ $appointment->clinic_location_en ?? 'N/A' }}</td></tr>
                        <tr><td class="px-0 py-2 text-text-muted font-medium">Clinic Location (AR):</td><td class="px-0 py-2 text-text">{{ $appointment->clinic_location_ar ?? 'N/A' }}</td></tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="lg:col-span-1">
        <div class="bg-surface rounded-xl border border-border">
            <div class="px-6 py-4 border-b border-border font-semibold text-sm text-text">Update Status</div>
            <div class="p-6">
                <form action="{{ route('admin.appointments.status', $appointment) }}" method="POST">
                    @csrf
                    <label class="block text-sm font-medium text-text mb-1.5">{{ __('messages.status') }}</label>
                    <select name="status" class="w-full rounded-lg border border-border px-3 py-2 text-sm text-text bg-surface focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary mb-3">
                        <option value="pending" {{ $appointment->status=='pending'?'selected':'' }}>Pending</option>
                        <option value="confirmed" {{ $appointment->status=='confirmed'?'selected':'' }}>Confirmed</option>
                        <option value="cancelled" {{ $appointment->status=='cancelled'?'selected':'' }}>Cancelled</option>
                        <option value="completed" {{ $appointment->status=='completed'?'selected':'' }}>Completed</option>
                    </select>
                    <textarea name="admin_notes" class="w-full rounded-lg border border-border px-3 py-2 text-sm text-text bg-surface focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary mb-3" placeholder="Admin notes...">{{ $appointment->admin_notes }}</textarea>
                    <input type="text" name="clinic_location_en" class="w-full rounded-lg border border-border px-3 py-2 text-sm text-text bg-surface focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary mb-3" placeholder="Clinic location (EN)" value="{{ $appointment->clinic_location_en }}">
                    <input type="text" name="clinic_location_ar" class="w-full rounded-lg border border-border px-3 py-2 text-sm text-text bg-surface focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary mb-4" placeholder="Clinic location (AR)" value="{{ $appointment->clinic_location_ar }}">
                    <button type="submit" class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-primary text-white rounded-lg hover:bg-primary-hover transition-colors text-sm font-medium">{{ __('messages.update') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
