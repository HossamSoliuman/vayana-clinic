@extends('layouts.admin')

@section('title', 'Journal Prompts')

@section('content')
<div class="flex items-center justify-between mb-8">
    <h2 class="text-2xl font-bold text-text">Journal Prompts</h2>
</div>
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="lg:col-span-1">
        <div class="bg-surface rounded-xl border border-border">
            <div class="px-6 py-4 border-b border-border font-semibold text-sm text-text">Add New Prompt</div>
            <div class="p-6">
                <form action="{{ route('admin.journal-prompts.store') }}" method="POST">
                    @csrf
                    <div class="mb-4"><label class="block text-sm font-medium text-text mb-1.5">Prompt (EN) *</label><textarea name="prompt_text_en" class="w-full rounded-lg border border-border px-3 py-2 text-sm text-text bg-surface focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary" rows="3" required></textarea></div>
                    <div class="mb-4"><label class="block text-sm font-medium text-text mb-1.5">Prompt (AR)</label><textarea name="prompt_text_ar" class="w-full rounded-lg border border-border px-3 py-2 text-sm text-text bg-surface focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary" rows="3"></textarea></div>
                    <div class="mb-4"><label class="block text-sm font-medium text-text mb-1.5">Category</label><select name="category" class="w-full rounded-lg border border-border px-3 py-2 text-sm text-text bg-surface focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary"><option value="gratitude">Gratitude</option><option value="reflection" selected>Reflection</option><option value="emotion">Emotion</option><option value="goal_setting">Goal Setting</option><option value="mindfulness">Mindfulness</option></select></div>
                    <div class="mb-4"><label class="block text-sm font-medium text-text mb-1.5">Order</label><input type="number" name="display_order" class="w-full rounded-lg border border-border px-3 py-2 text-sm text-text bg-surface focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary" value="0"></div>
                    <div class="mb-4 flex items-center gap-2"><input type="checkbox" name="is_active" value="1" checked class="w-4 h-4 text-primary border-border rounded focus:ring-primary"><label class="text-sm font-medium text-text">Active</label></div>
                    <button type="submit" class="w-full px-4 py-2.5 bg-primary text-white rounded-lg hover:bg-primary-hover transition-colors text-sm font-medium">Add Prompt</button>
                </form>
            </div>
        </div>
    </div>
    <div class="lg:col-span-2">
        <div class="bg-surface rounded-xl border border-border">
            <div class="p-6">
                <div class="overflow-x-auto mb-4">
                    <table class="w-full text-sm ltr:text-left rtl:text-right">
                        <thead><tr>
                            <th class="px-6 py-3 text-xs font-semibold uppercase tracking-wider text-text-muted bg-surface-secondary border-b border-border">Prompt (EN)</th>
                            <th class="px-6 py-3 text-xs font-semibold uppercase tracking-wider text-text-muted bg-surface-secondary border-b border-border">Category</th>
                            <th class="px-6 py-3 text-xs font-semibold uppercase tracking-wider text-text-muted bg-surface-secondary border-b border-border">Order</th>
                            <th class="px-6 py-3 text-xs font-semibold uppercase tracking-wider text-text-muted bg-surface-secondary border-b border-border">Active</th>
                            <th class="px-6 py-3 text-xs font-semibold uppercase tracking-wider text-text-muted bg-surface-secondary border-b border-border">Actions</th>
                        </tr></thead>
                        <tbody>
                            @forelse($prompts as $prompt)
                                <tr class="border-b border-border hover:bg-surface-secondary/50 transition-colors">
                                    <td class="px-6 py-4 text-sm text-text">{{ Str::limit($prompt->prompt_text_en, 60) }}</td>
                                    <td class="px-6 py-4 text-sm text-text">{{ $prompt->category }}</td>
                                    <td class="px-6 py-4 text-sm text-text">{{ $prompt->display_order }}</td>
                                    <td class="px-6 py-4 text-sm text-text"><span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $prompt->is_active ? 'bg-emerald-50 text-emerald-700' : 'bg-slate-100 text-slate-600' }}">{{ $prompt->is_active ? 'Yes' : 'No' }}</span></td>
                                    <td class="px-6 py-4 text-sm text-text">
                                        <div class="flex items-center gap-1.5">
                                            <button type="button" class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-amber-50 text-amber-600 hover:bg-amber-100 transition-colors" onclick="typeof openModal === 'function' ? openModal('editPrompt{{ $prompt->id }}') : document.getElementById('editPrompt{{ $prompt->id }}').classList.remove('hidden')"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/><path d="m15 5 4 4"/></svg></button>
                                            <form action="{{ route('admin.journal-prompts.destroy', $prompt) }}" method="POST" class="inline" onsubmit="return confirm('Delete?')">@csrf @method('DELETE')<button type="submit" class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-red-50 text-red-600 hover:bg-red-100 transition-colors"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg></button></form>
                                        </div>
                                    </td>
                                </tr>
                                <div id="editPrompt{{ $prompt->id }}" class="fixed inset-0 z-[100] hidden bg-slate-900/50 backdrop-blur-sm flex items-center justify-center p-4">
                                    <div class="bg-surface rounded-xl shadow-xl w-full max-w-lg border border-border overflow-hidden">
                                        <form action="{{ route('admin.journal-prompts.update', $prompt) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="px-6 py-4 border-b border-border flex items-center justify-between">
                                                <h5 class="font-semibold text-text">Edit Prompt</h5>
                                                <button type="button" class="text-text-muted hover:text-text transition-colors" onclick="typeof closeModal === 'function' ? closeModal('editPrompt{{ $prompt->id }}') : document.getElementById('editPrompt{{ $prompt->id }}').classList.add('hidden')"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg></button>
                                            </div>
                                            <div class="p-6">
                                                <div class="mb-4"><label class="block text-sm font-medium text-text mb-1.5">Prompt (EN) *</label><textarea name="prompt_text_en" class="w-full rounded-lg border border-border px-3 py-2 text-sm text-text bg-surface focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary" rows="3" required>{{ $prompt->prompt_text_en }}</textarea></div>
                                                <div class="mb-4"><label class="block text-sm font-medium text-text mb-1.5">Prompt (AR)</label><textarea name="prompt_text_ar" class="w-full rounded-lg border border-border px-3 py-2 text-sm text-text bg-surface focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary" rows="3">{{ $prompt->prompt_text_ar }}</textarea></div>
                                                <div class="mb-4"><label class="block text-sm font-medium text-text mb-1.5">Category</label><select name="category" class="w-full rounded-lg border border-border px-3 py-2 text-sm text-text bg-surface focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary"><option value="gratitude" {{ $prompt->category=='gratitude'?'selected':'' }}>Gratitude</option><option value="reflection" {{ $prompt->category=='reflection'?'selected':'' }}>Reflection</option><option value="emotion" {{ $prompt->category=='emotion'?'selected':'' }}>Emotion</option><option value="goal_setting" {{ $prompt->category=='goal_setting'?'selected':'' }}>Goal Setting</option><option value="mindfulness" {{ $prompt->category=='mindfulness'?'selected':'' }}>Mindfulness</option></select></div>
                                                <div class="mb-4"><label class="block text-sm font-medium text-text mb-1.5">Order</label><input type="number" name="display_order" class="w-full rounded-lg border border-border px-3 py-2 text-sm text-text bg-surface focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary" value="{{ $prompt->display_order }}"></div>
                                                <div class="mb-4 flex items-center gap-2"><input type="checkbox" name="is_active" value="1" {{ $prompt->is_active?'checked':'' }} class="w-4 h-4 text-primary border-border rounded focus:ring-primary"><label class="text-sm font-medium text-text">Active</label></div>
                                            </div>
                                            <div class="px-6 py-4 border-t border-border bg-surface-secondary flex justify-end gap-3">
                                                <button type="button" class="px-4 py-2 border border-border rounded-lg text-text hover:bg-surface transition-colors text-sm font-medium" onclick="typeof closeModal === 'function' ? closeModal('editPrompt{{ $prompt->id }}') : document.getElementById('editPrompt{{ $prompt->id }}').classList.add('hidden')">Cancel</button>
                                                <button type="submit" class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary-hover transition-colors text-sm font-medium">Update</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            @empty<tr><td colspan="5" class="text-center text-text-muted py-8">No prompts</td></tr>@endforelse
                        </tbody>
                    </table>
                </div>
                {{ $prompts->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
