@extends('layouts.admin')

@section('title', 'Programs')

@section('content')
<div class="flex items-center justify-between mb-8">
    <h2 class="text-2xl font-bold text-text">{{ __('messages.therapy_programs') }}</h2>
    <a href="{{ route('admin.programs.create') }}" class="inline-flex items-center gap-2 px-4 py-2.5 bg-primary text-white rounded-lg hover:bg-primary-hover transition-colors text-sm font-medium"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><path d="M5 12h14"/><path d="M12 5v14"/></svg> Add Program</a>
</div>
<div class="bg-surface rounded-xl border border-border">
    <div class="p-6">
        <div class="overflow-x-auto mb-4">
            <table class="w-full text-sm ltr:text-left rtl:text-right">
                <thead><tr>
                    <th class="px-6 py-3 text-xs font-semibold uppercase tracking-wider text-text-muted bg-surface-secondary border-b border-border">{{ __('messages.name') }}</th>
                    <th class="px-6 py-3 text-xs font-semibold uppercase tracking-wider text-text-muted bg-surface-secondary border-b border-border">{{ __('messages.type') }}</th>
                    <th class="px-6 py-3 text-xs font-semibold uppercase tracking-wider text-text-muted bg-surface-secondary border-b border-border">{{ __('messages.duration') }}</th>
                    <th class="px-6 py-3 text-xs font-semibold uppercase tracking-wider text-text-muted bg-surface-secondary border-b border-border">{{ __('messages.price') }}</th>
                    <th class="px-6 py-3 text-xs font-semibold uppercase tracking-wider text-text-muted bg-surface-secondary border-b border-border">{{ __('messages.featured') }}</th>
                    <th class="px-6 py-3 text-xs font-semibold uppercase tracking-wider text-text-muted bg-surface-secondary border-b border-border">{{ __('messages.active') }}</th>
                    <th class="px-6 py-3 text-xs font-semibold uppercase tracking-wider text-text-muted bg-surface-secondary border-b border-border">{{ __('messages.actions') }}</th>
                </tr></thead>
                <tbody>
                    @forelse($programs as $program)
                        <tr class="border-b border-border hover:bg-surface-secondary/50 transition-colors">
                            <td class="px-6 py-4 text-sm text-text">{{ $program->name_en }}</td>
                            <td class="px-6 py-4 text-sm text-text">{{ $program->program_type }}</td>
                            <td class="px-6 py-4 text-sm text-text">{{ $program->duration ?? 'N/A' }}</td>
                            <td class="px-6 py-4 text-sm text-text">{{ $program->full_program_price ?? $program->price_per_session ?? 'N/A' }} {{ $program->currency }}</td>
                            <td class="px-6 py-4 text-sm text-text"><span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $program->is_featured ? 'bg-emerald-50 text-emerald-700' : 'bg-slate-100 text-slate-600' }}">{{ $program->is_featured ? 'Yes' : 'No' }}</span></td>
                            <td class="px-6 py-4 text-sm text-text"><span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $program->is_active ? 'bg-emerald-50 text-emerald-700' : 'bg-slate-100 text-slate-600' }}">{{ $program->is_active ? 'Yes' : 'No' }}</span></td>
                            <td class="px-6 py-4 text-sm text-text">
                                <div class="flex items-center gap-1.5">
                                    <a href="{{ route('admin.programs.edit', $program) }}" class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-amber-50 text-amber-600 hover:bg-amber-100 transition-colors"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/><path d="m15 5 4 4"/></svg></a>
                                    <form action="{{ route('admin.programs.destroy', $program) }}" method="POST" class="inline" onsubmit="return confirm('Delete?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-red-50 text-red-600 hover:bg-red-100 transition-colors"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty<tr><td colspan="7" class="text-center text-text-muted py-8">No programs</td></tr>@endforelse
                </tbody>
            </table>
        </div>
        {{ $programs->links() }}
    </div>
</div>
@endsection
