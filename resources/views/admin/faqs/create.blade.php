@extends('layouts.admin')

@section('title', 'Add FAQ')

@section('content')
<div class="flex items-center justify-between mb-8">
    <h2 class="text-2xl font-bold text-text">Add FAQ</h2>
    <a href="{{ route('admin.faqs.index') }}" class="inline-flex items-center gap-2 px-4 py-2 border border-border text-text-muted rounded-lg hover:bg-surface-secondary transition-colors text-sm"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><path d="m12 19-7-7 7-7"/><path d="M19 12H5"/></svg> Back</a>
</div>
<div class="bg-surface rounded-xl border border-border">
    <div class="p-6">
        <form action="{{ route('admin.faqs.store') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div><label class="block text-sm font-medium text-text mb-1.5">Question (EN) *</label><input type="text" name="question_en" class="w-full rounded-lg border border-border px-3 py-2 text-sm text-text bg-surface focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary" required></div>
                <div><label class="block text-sm font-medium text-text mb-1.5">Question (AR)</label><input type="text" name="question_ar" class="w-full rounded-lg border border-border px-3 py-2 text-sm text-text bg-surface focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary"></div>
                <div class="md:col-span-2"><label class="block text-sm font-medium text-text mb-1.5">Answer (EN) *</label><textarea name="answer_en" class="w-full rounded-lg border border-border px-3 py-2 text-sm text-text bg-surface focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary" rows="4" required></textarea></div>
                <div class="md:col-span-2"><label class="block text-sm font-medium text-text mb-1.5">Answer (AR)</label><textarea name="answer_ar" class="w-full rounded-lg border border-border px-3 py-2 text-sm text-text bg-surface focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary" rows="4"></textarea></div>
                <div><label class="block text-sm font-medium text-text mb-1.5">Category</label><select name="category" class="w-full rounded-lg border border-border px-3 py-2 text-sm text-text bg-surface focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary"><option value="general">General</option><option value="services">Services</option><option value="appointments">Appointments</option><option value="billing">Billing</option><option value="business">Business</option><option value="providers">Providers</option></select></div>
                <div><label class="block text-sm font-medium text-text mb-1.5">Display Order</label><input type="number" name="display_order" class="w-full rounded-lg border border-border px-3 py-2 text-sm text-text bg-surface focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary" value="0"></div>
                <div class="flex items-center gap-2"><input type="checkbox" name="is_active" value="1" checked class="w-4 h-4 text-primary border-border rounded focus:ring-primary"><label class="text-sm font-medium text-text">Active</label></div>
            </div>
            <button type="submit" class="px-4 py-2.5 bg-primary text-white rounded-lg hover:bg-primary-hover transition-colors text-sm font-medium">Save FAQ</button>
        </form>
    </div>
</div>
@endsection
