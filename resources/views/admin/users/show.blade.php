@extends('layouts.admin')

@section('title', 'User Details')

@section('content')
<div class="flex items-center justify-between mb-8">
    <h2 class="text-2xl font-bold text-text">{{ __('messages.user_details') }}</h2>
    <a href="{{ route('admin.users.index') }}" class="inline-flex items-center gap-2 px-4 py-2 border border-border text-text-muted rounded-lg hover:bg-surface-secondary transition-colors text-sm"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><path d="m12 19-7-7 7-7"/><path d="M19 12H5"/></svg> Back</a>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="lg:col-span-1">
        <div class="bg-surface rounded-xl border border-border">
            <div class="p-6 text-center flex flex-col items-center">
                @if($user->avatar)
                    <img src="{{ asset('storage/' . $user->avatar) }}" class="rounded-full w-24 h-24 object-cover mb-4 border border-border" alt="">
                @else
                    <div class="rounded-full bg-slate-200 text-slate-600 flex items-center justify-center mb-4 w-24 h-24 text-3xl font-bold">
                        {{ strtoupper(substr($user->first_name_en, 0, 1)) }}
                    </div>
                @endif
                <h5 class="text-lg font-semibold text-text">{{ $user->full_name }}</h5>
                <p class="text-sm text-text-muted mb-3">{{ $user->email }}</p>
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-primary text-white">{{ $user->role }}</span>
            </div>
        </div>
    </div>
    <div class="lg:col-span-2 space-y-6">
        <div class="bg-surface rounded-xl border border-border">
            <div class="px-6 py-4 border-b border-border font-semibold text-sm text-text">Information</div>
            <div class="p-6">
                <table class="w-full text-sm">
                    <tbody>
                        <tr><td class="px-0 py-2 text-text-muted font-medium w-40">Name (EN):</td><td class="px-0 py-2 text-text">{{ $user->first_name_en }} {{ $user->last_name_en }}</td></tr>
                        <tr><td class="px-0 py-2 text-text-muted font-medium">Name (AR):</td><td class="px-0 py-2 text-text">{{ $user->first_name_ar ?? 'N/A' }} {{ $user->last_name_ar ?? '' }}</td></tr>
                        <tr><td class="px-0 py-2 text-text-muted font-medium">Phone:</td><td class="px-0 py-2 text-text">{{ $user->phone ?? 'N/A' }}</td></tr>
                        <tr><td class="px-0 py-2 text-text-muted font-medium">Locale:</td><td class="px-0 py-2 text-text">{{ $user->locale }}</td></tr>
                        <tr><td class="px-0 py-2 text-text-muted font-medium">Status:</td><td class="px-0 py-2 text-text"><span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $user->is_active ? 'bg-emerald-50 text-emerald-700' : 'bg-red-50 text-red-700' }}">{{ $user->is_active ? 'Active' : 'Inactive' }}</span></td></tr>
                        <tr><td class="px-0 py-2 text-text-muted font-medium">Email Verified:</td><td class="px-0 py-2 text-text">{{ $user->email_verified_at ? $user->email_verified_at->format('M d, Y') : 'Not Verified' }}</td></tr>
                        <tr><td class="px-0 py-2 text-text-muted font-medium">Joined:</td><td class="px-0 py-2 text-text">{{ $user->created_at->format('M d, Y H:i') }}</td></tr>
                    </tbody>
                </table>
            </div>
        </div>
        @if($user->clientProfile)
            <div class="bg-surface rounded-xl border border-border">
                <div class="px-6 py-4 border-b border-border font-semibold text-sm text-text">Client Profile</div>
                <div class="p-6">
                    <table class="w-full text-sm">
                        <tbody>
                            <tr><td class="px-0 py-2 text-text-muted font-medium w-40">Date of Birth:</td><td class="px-0 py-2 text-text">{{ $user->clientProfile->date_of_birth?->format('M d, Y') ?? 'N/A' }}</td></tr>
                            <tr><td class="px-0 py-2 text-text-muted font-medium">Gender:</td><td class="px-0 py-2 text-text">{{ $user->clientProfile->gender ?? 'N/A' }}</td></tr>
                            <tr><td class="px-0 py-2 text-text-muted font-medium">Nationality:</td><td class="px-0 py-2 text-text">{{ $user->clientProfile->nationality ?? 'N/A' }}</td></tr>
                            <tr><td class="px-0 py-2 text-text-muted font-medium">Location:</td><td class="px-0 py-2 text-text">{{ $user->clientProfile->city ?? '' }} {{ $user->clientProfile->country ?? '' }}</td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
        @if($user->providerProfile)
            <div class="bg-surface rounded-xl border border-border">
                <div class="px-6 py-4 border-b border-border font-semibold text-sm text-text">Provider Profile</div>
                <div class="p-6">
                    <table class="w-full text-sm">
                        <tbody>
                            <tr><td class="px-0 py-2 text-text-muted font-medium w-40">Title:</td><td class="px-0 py-2 text-text">{{ $user->providerProfile->title ?? 'N/A' }}</td></tr>
                            <tr><td class="px-0 py-2 text-text-muted font-medium">License Number:</td><td class="px-0 py-2 text-text">{{ $user->providerProfile->license_number }}</td></tr>
                            <tr><td class="px-0 py-2 text-text-muted font-medium">Experience:</td><td class="px-0 py-2 text-text">{{ $user->providerProfile->years_of_experience ?? 'N/A' }} years</td></tr>
                            <tr><td class="px-0 py-2 text-text-muted font-medium">Work Type:</td><td class="px-0 py-2 text-text">{{ $user->providerProfile->work_type }}</td></tr>
                            <tr><td class="px-0 py-2 text-text-muted font-medium">Verified:</td><td class="px-0 py-2 text-text"><span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $user->providerProfile->is_verified ? 'bg-emerald-50 text-emerald-700' : 'bg-amber-50 text-amber-700' }}">{{ $user->providerProfile->is_verified ? 'Yes' : 'No' }}</span></td></tr>
                            <tr><td class="px-0 py-2 text-text-muted font-medium">Rating:</td><td class="px-0 py-2 text-text">{{ $user->providerProfile->rating_average }} ({{ $user->providerProfile->rating_count }} reviews)</td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
