@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="flex items-center justify-between mb-8">
    <h2 class="text-2xl font-bold text-text">Dashboard</h2>
    <span class="text-text-muted">{{ now()->format('F d, Y') }}</span>
</div>

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="bg-surface rounded-xl border border-border p-6 flex items-center gap-4">
        <div class="w-12 h-12 rounded-xl flex items-center justify-center bg-indigo-50 text-indigo-600">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
        </div>
        <div>
            <h5 class="mb-0 text-xl font-semibold text-text">{{ $stats['total_users'] }}</h5>
            <p class="text-sm text-text-muted">Total Users</p>
        </div>
    </div>
    <div class="bg-surface rounded-xl border border-border p-6 flex items-center gap-4">
        <div class="w-12 h-12 rounded-xl flex items-center justify-center bg-emerald-50 text-emerald-600">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><polyline points="16 11 18 13 22 9"/></svg>
        </div>
        <div>
            <h5 class="mb-0 text-xl font-semibold text-text">{{ $stats['verified_providers'] }}</h5>
            <p class="text-sm text-text-muted">Verified Providers</p>
        </div>
    </div>
    <div class="bg-surface rounded-xl border border-border p-6 flex items-center gap-4">
        <div class="w-12 h-12 rounded-xl flex items-center justify-center bg-amber-50 text-amber-600">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6"><path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"/><path d="M14 2v4a2 2 0 0 0 2 2h4"/><path d="M10 9H8"/><path d="M16 13H8"/><path d="M16 17H8"/></svg>
        </div>
        <div>
            <h5 class="mb-0 text-xl font-semibold text-text">{{ $stats['pending_applications'] }}</h5>
            <p class="text-sm text-text-muted">Pending Applications</p>
        </div>
    </div>
    <div class="bg-surface rounded-xl border border-border p-6 flex items-center gap-4">
        <div class="w-12 h-12 rounded-xl flex items-center justify-center bg-blue-50 text-blue-600">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/><path d="m9 16 2 2 4-4"/></svg>
        </div>
        <div>
            <h5 class="mb-0 text-xl font-semibold text-text">{{ $stats['pending_appointments'] }}</h5>
            <p class="text-sm text-text-muted">Pending Appointments</p>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="bg-surface rounded-xl border border-border">
        <div class="flex items-center justify-between px-6 py-4 border-b border-border">
            <span class="font-semibold text-sm text-text flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"/><path d="M14 2v4a2 2 0 0 0 2 2h4"/><path d="M10 9H8"/><path d="M16 13H8"/><path d="M16 17H8"/></svg>
                Recent Applications
            </span>
            <a href="{{ route('admin.applications.index') }}" class="text-primary hover:text-primary-hover text-sm font-medium transition-colors">View All</a>
        </div>
        <div class="flex flex-col">
            @forelse($recentApplications as $app)
                <a href="{{ route('admin.applications.show', $app) }}" class="block px-6 py-3 border-b border-border last:border-0 hover:bg-surface-secondary transition-colors">
                    <div class="flex items-center justify-between mb-1">
                        <span class="text-sm font-medium text-text">{{ $app->full_name }}</span>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-50 text-amber-700">{{ $app->status }}</span>
                    </div>
                    <p class="text-xs text-text-muted">{{ $app->created_at->diffForHumans() }}</p>
                </a>
            @empty
                <div class="px-6 py-4 text-sm text-text-muted text-center">No pending applications</div>
            @endforelse
        </div>
    </div>
    
    <div class="bg-surface rounded-xl border border-border">
        <div class="flex items-center justify-between px-6 py-4 border-b border-border">
            <span class="font-semibold text-sm text-text flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/><path d="m9 16 2 2 4-4"/></svg>
                Recent Appointments
            </span>
            <a href="{{ route('admin.appointments.index') }}" class="text-primary hover:text-primary-hover text-sm font-medium transition-colors">View All</a>
        </div>
        <div class="flex flex-col">
            @forelse($recentAppointments as $appt)
                <a href="{{ route('admin.appointments.show', $appt) }}" class="block px-6 py-3 border-b border-border last:border-0 hover:bg-surface-secondary transition-colors">
                    <div class="flex items-center justify-between mb-1">
                        <span class="text-sm font-medium text-text">{{ $appt->full_name }}</span>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-50 text-blue-700">{{ $appt->status }}</span>
                    </div>
                    <p class="text-xs text-text-muted">{{ $appt->preferred_date?->format('M d, Y') }}</p>
                </a>
            @empty
                <div class="px-6 py-4 text-sm text-text-muted text-center">No pending appointments</div>
            @endforelse
        </div>
    </div>
    
    <div class="bg-surface rounded-xl border border-border">
        <div class="flex items-center justify-between px-6 py-4 border-b border-border">
            <span class="font-semibold text-sm text-text flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><path d="M6 22V4a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v18Z"/><path d="M6 12H4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h2"/><path d="M18 9h2a2 2 0 0 1 2 2v9a2 2 0 0 1-2 2h-2"/><path d="M10 6h4"/><path d="M10 10h4"/><path d="M10 14h4"/><path d="M10 18h4"/></svg>
                New Inquiries
            </span>
            <a href="{{ route('admin.business-inquiries.index') }}" class="text-primary hover:text-primary-hover text-sm font-medium transition-colors">View All</a>
        </div>
        <div class="flex flex-col">
            @forelse($recentInquiries as $inquiry)
                <a href="{{ route('admin.business-inquiries.show', $inquiry) }}" class="block px-6 py-3 border-b border-border last:border-0 hover:bg-surface-secondary transition-colors">
                    <div class="flex items-center justify-between mb-1">
                        <span class="text-sm font-medium text-text">{{ $inquiry->organization_name }}</span>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-slate-100 text-slate-600">{{ $inquiry->status }}</span>
                    </div>
                    <p class="text-xs text-text-muted">{{ $inquiry->created_at->diffForHumans() }}</p>
                </a>
            @empty
                <div class="px-6 py-4 text-sm text-text-muted text-center">No new inquiries</div>
            @endforelse
        </div>
    </div>
</div>
@endsection
