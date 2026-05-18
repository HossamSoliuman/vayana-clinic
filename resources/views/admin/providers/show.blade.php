@extends('layouts.admin')

@section('title', 'Provider Details')

@section('content')
<div class="flex items-center justify-between mb-8">
    <h2 class="text-2xl font-bold text-text">Provider Details</h2>
    <a href="{{ route('admin.providers.index') }}" class="inline-flex items-center gap-2 px-4 py-2 border border-border text-text-muted rounded-lg hover:bg-surface-secondary transition-colors text-sm"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><path d="m12 19-7-7 7-7"/><path d="M19 12H5"/></svg> Back</a>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="lg:col-span-1">
        <div class="bg-surface rounded-xl border border-border">
            <div class="p-6 text-center flex flex-col items-center">
                <h5 class="text-lg font-semibold text-text">{{ $provider->user?->full_name ?? 'N/A' }}</h5>
                <p class="text-sm text-text-muted mb-3">{{ $provider->user?->email }}</p>
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-primary text-white mb-6">{{ $provider->title ?? 'Provider' }}</span>
                <div class="flex items-center justify-center gap-2">
                    <form action="{{ route('admin.providers.verify', $provider) }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="px-4 py-2 rounded-lg text-sm font-medium transition-colors {{ $provider->is_verified ? 'bg-slate-100 text-slate-600 hover:bg-slate-200' : 'bg-emerald-50 text-emerald-600 hover:bg-emerald-100' }}">
                            {{ $provider->is_verified ? 'Unverify' : 'Verify' }}
                        </button>
                    </form>
                    <form action="{{ route('admin.providers.feature', $provider) }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="px-4 py-2 rounded-lg text-sm font-medium transition-colors {{ $provider->is_featured ? 'bg-slate-100 text-slate-600 hover:bg-slate-200' : 'bg-amber-50 text-amber-600 hover:bg-amber-100' }}">
                            {{ $provider->is_featured ? 'Unfeature' : 'Feature' }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="lg:col-span-2">
        <div class="bg-surface rounded-xl border border-border">
            <div class="px-6 py-4 border-b border-border font-semibold text-sm text-text">Profile Information</div>
            <div class="p-6">
                <table class="w-full text-sm">
                    <tbody>
                        <tr><td class="px-0 py-2 text-text-muted font-medium w-40">License Number:</td><td class="px-0 py-2 text-text">{{ $provider->license_number }}</td></tr>
                        <tr><td class="px-0 py-2 text-text-muted font-medium">Biography:</td><td class="px-0 py-2 text-text">{{ $provider->biography_en ?? 'N/A' }}</td></tr>
                        <tr><td class="px-0 py-2 text-text-muted font-medium">Experience:</td><td class="px-0 py-2 text-text">{{ $provider->years_of_experience ?? 'N/A' }} years</td></tr>
                        <tr><td class="px-0 py-2 text-text-muted font-medium">Work Type:</td><td class="px-0 py-2 text-text">{{ $provider->work_type }}</td></tr>
                        <tr><td class="px-0 py-2 text-text-muted font-medium">Online Price:</td><td class="px-0 py-2 text-text">{{ $provider->session_price_online ?? 'N/A' }} {{ $provider->currency }}</td></tr>
                        <tr><td class="px-0 py-2 text-text-muted font-medium">In-Person Price:</td><td class="px-0 py-2 text-text">{{ $provider->session_price_inperson ?? 'N/A' }} {{ $provider->currency }}</td></tr>
                        <tr><td class="px-0 py-2 text-text-muted font-medium">Specialties:</td><td class="px-0 py-2 text-text">{{ $provider->specialties->pluck('name_en')->implode(', ') ?: 'N/A' }}</td></tr>
                        <tr><td class="px-0 py-2 text-text-muted font-medium">Languages:</td><td class="px-0 py-2 text-text">{{ $provider->languages->pluck('language')->implode(', ') ?: 'N/A' }}</td></tr>
                        <tr><td class="px-0 py-2 text-text-muted font-medium">Rating:</td><td class="px-0 py-2 text-text">{{ $provider->rating_average }} ({{ $provider->rating_count }} reviews)</td></tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
