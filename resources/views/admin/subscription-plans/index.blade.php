@extends('layouts.admin')

@section('title', 'Subscription Plans')

@section('content')
<div class="flex items-center justify-between mb-8">
    <h2 class="text-2xl font-bold text-text">Subscription Plans</h2>
</div>
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="lg:col-span-1">
        <div class="bg-surface rounded-xl border border-border">
            <div class="px-6 py-4 border-b border-border font-semibold text-sm text-text">Add Plan</div>
            <div class="p-6">
                <form action="{{ route('admin.subscription-plans.store') }}" method="POST">
                    @csrf
                    <div class="mb-4"><label class="block text-sm font-medium text-text mb-1.5">Name (EN) *</label><input type="text" name="name_en" class="w-full rounded-lg border border-border px-3 py-2 text-sm text-text bg-surface focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary" required></div>
                    <div class="mb-4"><label class="block text-sm font-medium text-text mb-1.5">Name (AR)</label><input type="text" name="name_ar" class="w-full rounded-lg border border-border px-3 py-2 text-sm text-text bg-surface focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary"></div>
                    <div class="mb-4"><label class="block text-sm font-medium text-text mb-1.5">Slug</label><input type="text" name="slug" class="w-full rounded-lg border border-border px-3 py-2 text-sm text-text bg-surface focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary"></div>
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div><label class="block text-sm font-medium text-text mb-1.5">Price *</label><input type="number" step="0.01" name="price" class="w-full rounded-lg border border-border px-3 py-2 text-sm text-text bg-surface focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary" required></div>
                        <div><label class="block text-sm font-medium text-text mb-1.5">Currency</label><select name="currency" class="w-full rounded-lg border border-border px-3 py-2 text-sm text-text bg-surface focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary"><option value="SAR">SAR</option><option value="USD">USD</option></select></div>
                    </div>
                    <div class="mb-4"><label class="block text-sm font-medium text-text mb-1.5">Billing Cycle</label><select name="billing_cycle" class="w-full rounded-lg border border-border px-3 py-2 text-sm text-text bg-surface focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary"><option value="monthly">Monthly</option><option value="yearly">Yearly</option></select></div>
                    <div class="mb-4"><label class="block text-sm font-medium text-text mb-1.5">Features (EN) - one per line</label><textarea name="features_en" class="w-full rounded-lg border border-border px-3 py-2 text-sm text-text bg-surface focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary" rows="3"></textarea></div>
                    <div class="mb-4"><label class="block text-sm font-medium text-text mb-1.5">Features (AR) - one per line</label><textarea name="features_ar" class="w-full rounded-lg border border-border px-3 py-2 text-sm text-text bg-surface focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary" rows="3"></textarea></div>
                    <div class="mb-4"><label class="block text-sm font-medium text-text mb-1.5">Session Credits</label><input type="number" name="session_credits" class="w-full rounded-lg border border-border px-3 py-2 text-sm text-text bg-surface focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary"></div>
                    <div class="mb-4 flex items-center gap-2"><input type="checkbox" name="is_active" value="1" checked class="w-4 h-4 text-primary border-border rounded focus:ring-primary"><label class="text-sm font-medium text-text">Active</label></div>
                    <button type="submit" class="w-full px-4 py-2.5 bg-primary text-white rounded-lg hover:bg-primary-hover transition-colors text-sm font-medium">Add Plan</button>
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
                            <th class="px-6 py-3 text-xs font-semibold uppercase tracking-wider text-text-muted bg-surface-secondary border-b border-border">Name</th>
                            <th class="px-6 py-3 text-xs font-semibold uppercase tracking-wider text-text-muted bg-surface-secondary border-b border-border">Price</th>
                            <th class="px-6 py-3 text-xs font-semibold uppercase tracking-wider text-text-muted bg-surface-secondary border-b border-border">Cycle</th>
                            <th class="px-6 py-3 text-xs font-semibold uppercase tracking-wider text-text-muted bg-surface-secondary border-b border-border">Credits</th>
                            <th class="px-6 py-3 text-xs font-semibold uppercase tracking-wider text-text-muted bg-surface-secondary border-b border-border">Active</th>
                            <th class="px-6 py-3 text-xs font-semibold uppercase tracking-wider text-text-muted bg-surface-secondary border-b border-border">Actions</th>
                        </tr></thead>
                        <tbody>
                            @forelse($plans as $plan)
                                <tr class="border-b border-border hover:bg-surface-secondary/50 transition-colors">
                                    <td class="px-6 py-4 text-sm text-text">{{ $plan->name_en }}</td>
                                    <td class="px-6 py-4 text-sm text-text">{{ $plan->price }} {{ $plan->currency }}</td>
                                    <td class="px-6 py-4 text-sm text-text">{{ $plan->billing_cycle }}</td>
                                    <td class="px-6 py-4 text-sm text-text">{{ $plan->session_credits ?? 'N/A' }}</td>
                                    <td class="px-6 py-4 text-sm text-text"><span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $plan->is_active ? 'bg-emerald-50 text-emerald-700' : 'bg-slate-100 text-slate-600' }}">{{ $plan->is_active ? 'Yes' : 'No' }}</span></td>
                                    <td class="px-6 py-4 text-sm text-text">
                                        <button type="button" class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-amber-50 text-amber-600 hover:bg-amber-100 transition-colors" onclick="typeof openModal === 'function' ? openModal('editPlan{{ $plan->id }}') : document.getElementById('editPlan{{ $plan->id }}').classList.remove('hidden')"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/><path d="m15 5 4 4"/></svg></button>
                                    </td>
                                </tr>
                                <div id="editPlan{{ $plan->id }}" class="fixed inset-0 z-[100] hidden bg-slate-900/50 backdrop-blur-sm flex items-center justify-center p-4">
                                    <div class="bg-surface rounded-xl shadow-xl w-full max-w-2xl border border-border overflow-hidden max-h-[90vh] flex flex-col">
                                        <form action="{{ route('admin.subscription-plans.update', $plan) }}" method="POST" class="flex flex-col h-full">
                                            @csrf
                                            @method('PUT')
                                            <div class="px-6 py-4 border-b border-border flex items-center justify-between shrink-0">
                                                <h5 class="font-semibold text-text">Edit Plan</h5>
                                                <button type="button" class="text-text-muted hover:text-text transition-colors" onclick="typeof closeModal === 'function' ? closeModal('editPlan{{ $plan->id }}') : document.getElementById('editPlan{{ $plan->id }}').classList.add('hidden')"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg></button>
                                            </div>
                                            <div class="p-6 overflow-y-auto">
                                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                                    <div><label class="block text-sm font-medium text-text mb-1.5">Name (EN) *</label><input type="text" name="name_en" class="w-full rounded-lg border border-border px-3 py-2 text-sm text-text bg-surface focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary" value="{{ $plan->name_en }}" required></div>
                                                    <div><label class="block text-sm font-medium text-text mb-1.5">Name (AR)</label><input type="text" name="name_ar" class="w-full rounded-lg border border-border px-3 py-2 text-sm text-text bg-surface focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary" value="{{ $plan->name_ar }}"></div>
                                                    <div><label class="block text-sm font-medium text-text mb-1.5">Slug</label><input type="text" name="slug" class="w-full rounded-lg border border-border px-3 py-2 text-sm text-text bg-surface focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary" value="{{ $plan->slug }}"></div>
                                                    
                                                    <div class="grid grid-cols-2 gap-4">
                                                        <div><label class="block text-sm font-medium text-text mb-1.5">Price *</label><input type="number" step="0.01" name="price" class="w-full rounded-lg border border-border px-3 py-2 text-sm text-text bg-surface focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary" value="{{ $plan->price }}" required></div>
                                                        <div><label class="block text-sm font-medium text-text mb-1.5">Currency</label><select name="currency" class="w-full rounded-lg border border-border px-3 py-2 text-sm text-text bg-surface focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary"><option value="SAR" {{ $plan->currency=='SAR'?'selected':'' }}>SAR</option><option value="USD" {{ $plan->currency=='USD'?'selected':'' }}>USD</option></select></div>
                                                    </div>
                                                    
                                                    <div><label class="block text-sm font-medium text-text mb-1.5">Billing Cycle</label><select name="billing_cycle" class="w-full rounded-lg border border-border px-3 py-2 text-sm text-text bg-surface focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary"><option value="monthly" {{ $plan->billing_cycle=='monthly'?'selected':'' }}>Monthly</option><option value="yearly" {{ $plan->billing_cycle=='yearly'?'selected':'' }}>Yearly</option></select></div>
                                                    <div><label class="block text-sm font-medium text-text mb-1.5">Session Credits</label><input type="number" name="session_credits" class="w-full rounded-lg border border-border px-3 py-2 text-sm text-text bg-surface focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary" value="{{ $plan->session_credits }}"></div>
                                                    
                                                    <div class="md:col-span-2"><label class="block text-sm font-medium text-text mb-1.5">Features (EN)</label><textarea name="features_en" class="w-full rounded-lg border border-border px-3 py-2 text-sm text-text bg-surface focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary" rows="3">{{ $plan->features_en ? implode("\n", json_decode($plan->features_en, true) ?: []) : '' }}</textarea></div>
                                                    <div class="md:col-span-2"><label class="block text-sm font-medium text-text mb-1.5">Features (AR)</label><textarea name="features_ar" class="w-full rounded-lg border border-border px-3 py-2 text-sm text-text bg-surface focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary" rows="3">{{ $plan->features_ar ? implode("\n", json_decode($plan->features_ar, true) ?: []) : '' }}</textarea></div>
                                                    
                                                    <div class="md:col-span-2 flex items-center gap-2"><input type="checkbox" name="is_active" value="1" {{ $plan->is_active?'checked':'' }} class="w-4 h-4 text-primary border-border rounded focus:ring-primary"><label class="text-sm font-medium text-text">Active</label></div>
                                                </div>
                                            </div>
                                            <div class="px-6 py-4 border-t border-border bg-surface-secondary flex justify-end gap-3 shrink-0">
                                                <button type="button" class="px-4 py-2 border border-border rounded-lg text-text hover:bg-surface transition-colors text-sm font-medium" onclick="typeof closeModal === 'function' ? closeModal('editPlan{{ $plan->id }}') : document.getElementById('editPlan{{ $plan->id }}').classList.add('hidden')">Cancel</button>
                                                <button type="submit" class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary-hover transition-colors text-sm font-medium">Update</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            @empty<tr><td colspan="6" class="text-center text-text-muted py-8">No plans</td></tr>@endforelse
                        </tbody>
                    </table>
                </div>
                {{ $plans->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
