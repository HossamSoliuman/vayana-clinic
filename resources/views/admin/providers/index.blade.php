@extends('layouts.admin')

@section('title', 'Providers')

@section('content')
<div class="flex items-center justify-between mb-8">
    <h2 class="text-2xl font-bold text-text">Providers</h2>
</div>

<div class="bg-surface rounded-xl border border-border">
    <div class="p-6">
        <form method="GET" class="flex flex-wrap items-center gap-4 mb-6">
            <div class="w-full sm:w-auto">
                <select name="status" class="rounded-lg border border-border bg-surface px-3 py-2 text-sm text-text focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary w-full" onchange="this.form.submit()">
                    <option value="">All Status</option>
                    <option value="verified" {{ request('status') === 'verified' ? 'selected' : '' }}>Verified</option>
                    <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                </select>
            </div>
            <div class="w-full sm:w-64">
                <input type="text" name="search" class="rounded-lg border border-border bg-surface px-3 py-2 text-sm text-text focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary w-full" placeholder="Search providers..." value="{{ request('search') }}">
            </div>
            <div>
                <button type="submit" class="inline-flex items-center justify-center w-10 h-10 bg-primary text-white rounded-lg hover:bg-primary-hover transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                </button>
            </div>
        </form>

        <div class="overflow-x-auto mb-4">
            <table class="w-full text-sm ltr:text-left rtl:text-right">
                <thead>
                    <tr>
                        <th class="px-6 py-3 text-xs font-semibold uppercase tracking-wider text-text-muted bg-surface-secondary border-b border-border">Name</th>
                        <th class="px-6 py-3 text-xs font-semibold uppercase tracking-wider text-text-muted bg-surface-secondary border-b border-border">License</th>
                        <th class="px-6 py-3 text-xs font-semibold uppercase tracking-wider text-text-muted bg-surface-secondary border-b border-border">Work Type</th>
                        <th class="px-6 py-3 text-xs font-semibold uppercase tracking-wider text-text-muted bg-surface-secondary border-b border-border">Verified</th>
                        <th class="px-6 py-3 text-xs font-semibold uppercase tracking-wider text-text-muted bg-surface-secondary border-b border-border">Featured</th>
                        <th class="px-6 py-3 text-xs font-semibold uppercase tracking-wider text-text-muted bg-surface-secondary border-b border-border">Rating</th>
                        <th class="px-6 py-3 text-xs font-semibold uppercase tracking-wider text-text-muted bg-surface-secondary border-b border-border">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($providers as $provider)
                        <tr class="border-b border-border hover:bg-surface-secondary/50 transition-colors">
                            <td class="px-6 py-4 text-sm text-text">{{ $provider->user?->full_name ?? 'N/A' }}</td>
                            <td class="px-6 py-4 text-sm text-text">{{ $provider->license_number }}</td>
                            <td class="px-6 py-4 text-sm text-text">{{ $provider->work_type }}</td>
                            <td class="px-6 py-4 text-sm text-text"><span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $provider->is_verified ? 'bg-emerald-50 text-emerald-700' : 'bg-amber-50 text-amber-700' }}">{{ $provider->is_verified ? 'Yes' : 'No' }}</span></td>
                            <td class="px-6 py-4 text-sm text-text"><span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $provider->is_featured ? 'bg-emerald-50 text-emerald-700' : 'bg-slate-100 text-slate-600' }}">{{ $provider->is_featured ? 'Yes' : 'No' }}</span></td>
                            <td class="px-6 py-4 text-sm text-text">{{ $provider->rating_average }} ({{ $provider->rating_count }})</td>
                            <td class="px-6 py-4 text-sm text-text">
                                <div class="flex items-center gap-1.5">
                                    <a href="{{ route('admin.providers.show', $provider) }}" class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-100 transition-colors"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/></svg></a>
                                    @if(!$provider->is_verified)
                                        <form action="{{ route('admin.providers.verify', $provider) }}" method="POST" class="inline" onsubmit="return confirm('Verify this provider?')">
                                            @csrf
                                            <button type="submit" class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-emerald-50 text-emerald-600 hover:bg-emerald-100 transition-colors"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><path d="M20 6 9 17l-5-5"/></svg></button>
                                        </form>
                                    @endif
                                    <form action="{{ route('admin.providers.feature', $provider) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="inline-flex items-center justify-center w-8 h-8 rounded-lg {{ $provider->is_featured ? 'bg-slate-100 text-slate-600 hover:bg-slate-200' : 'bg-amber-50 text-amber-600 hover:bg-amber-100' }} transition-colors">
                                            @if($provider->is_featured)
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                                            @else
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="currentColor" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                                            @endif
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="7" class="text-center text-text-muted py-8">No providers found</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{ $providers->links() }}
    </div>
</div>
@endsection
