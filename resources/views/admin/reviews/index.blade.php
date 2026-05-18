@extends('layouts.admin')

@section('title', 'Reviews')

@section('content')
<div class="flex items-center justify-between mb-8">
    <h2 class="text-2xl font-bold text-text">Client Reviews</h2>
</div>
<div class="bg-surface rounded-xl border border-border">
    <div class="p-6">
        <form method="GET" class="flex flex-wrap items-center gap-4 mb-6">
            <div class="w-full sm:w-auto">
                <select name="status" class="rounded-lg border border-border bg-surface px-3 py-2 text-sm text-text focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary w-full" onchange="this.form.submit()">
                    <option value="">All</option>
                    <option value="approved" {{ request('status')=='approved'?'selected':'' }}>Approved</option>
                    <option value="pending" {{ request('status')=='pending'?'selected':'' }}>Pending</option>
                </select>
            </div>
        </form>
        <div class="overflow-x-auto mb-4">
            <table class="w-full text-sm ltr:text-left rtl:text-right">
                <thead><tr>
                    <th class="px-6 py-3 text-xs font-semibold uppercase tracking-wider text-text-muted bg-surface-secondary border-b border-border">Client</th>
                    <th class="px-6 py-3 text-xs font-semibold uppercase tracking-wider text-text-muted bg-surface-secondary border-b border-border">Rating</th>
                    <th class="px-6 py-3 text-xs font-semibold uppercase tracking-wider text-text-muted bg-surface-secondary border-b border-border">Review</th>
                    <th class="px-6 py-3 text-xs font-semibold uppercase tracking-wider text-text-muted bg-surface-secondary border-b border-border">Provider</th>
                    <th class="px-6 py-3 text-xs font-semibold uppercase tracking-wider text-text-muted bg-surface-secondary border-b border-border">Approved</th>
                    <th class="px-6 py-3 text-xs font-semibold uppercase tracking-wider text-text-muted bg-surface-secondary border-b border-border">Featured</th>
                    <th class="px-6 py-3 text-xs font-semibold uppercase tracking-wider text-text-muted bg-surface-secondary border-b border-border">Actions</th>
                </tr></thead>
                <tbody>
                    @forelse($reviews as $review)
                        <tr class="border-b border-border hover:bg-surface-secondary/50 transition-colors">
                            <td class="px-6 py-4 text-sm text-text">{{ $review->client_name }}</td>
                            <td class="px-6 py-4 text-sm text-text">{{ $review->rating }}/5</td>
                            <td class="px-6 py-4 text-sm text-text">{{ Str::limit($review->review_text_en, 50) }}</td>
                            <td class="px-6 py-4 text-sm text-text">{{ $review->provider?->user?->full_name ?? 'N/A' }}</td>
                            <td class="px-6 py-4 text-sm text-text"><span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $review->is_approved ? 'bg-emerald-50 text-emerald-700' : 'bg-amber-50 text-amber-700' }}">{{ $review->is_approved ? 'Yes' : 'No' }}</span></td>
                            <td class="px-6 py-4 text-sm text-text"><span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $review->is_featured ? 'bg-emerald-50 text-emerald-700' : 'bg-slate-100 text-slate-600' }}">{{ $review->is_featured ? 'Yes' : 'No' }}</span></td>
                            <td class="px-6 py-4 text-sm text-text">
                                <div class="flex items-center gap-1.5">
                                    <form action="{{ route('admin.reviews.approve', $review) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="inline-flex items-center justify-center w-8 h-8 rounded-lg {{ $review->is_approved ? 'bg-amber-50 text-amber-600 hover:bg-amber-100' : 'bg-emerald-50 text-emerald-600 hover:bg-emerald-100' }} transition-colors">
                                            @if($review->is_approved)
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
                                            @else
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><path d="M20 6 9 17l-5-5"/></svg>
                                            @endif
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.reviews.feature', $review) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="inline-flex items-center justify-center w-8 h-8 rounded-lg {{ $review->is_featured ? 'bg-slate-100 text-slate-600 hover:bg-slate-200' : 'bg-blue-50 text-blue-600 hover:bg-blue-100' }} transition-colors">
                                            @if($review->is_featured)
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                                            @else
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="currentColor" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                                            @endif
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.reviews.destroy', $review) }}" method="POST" class="inline" onsubmit="return confirm('Delete?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-red-50 text-red-600 hover:bg-red-100 transition-colors"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty<tr><td colspan="7" class="text-center text-text-muted py-8">No reviews</td></tr>@endforelse
                </tbody>
            </table>
        </div>
        {{ $reviews->links() }}
    </div>
</div>
@endsection
