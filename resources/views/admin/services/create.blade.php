@extends('layouts.admin')

@section('title', 'Add Service')

@section('content')
<div class="flex items-center justify-between mb-8">
    <h2 class="text-2xl font-bold text-text">{{ __('messages.add_service') }}</h2>
    <a href="{{ route('admin.services.index') }}" class="inline-flex items-center gap-2 px-4 py-2 border border-border text-text-muted rounded-lg hover:bg-surface-secondary transition-colors text-sm"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><path d="m12 19-7-7 7-7"/><path d="M19 12H5"/></svg> Back</a>
</div>
<div class="bg-surface rounded-xl border border-border">
    <div class="p-6">
        <form action="{{ route('admin.services.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div><label class="block text-sm font-medium text-text mb-1.5">Name (EN) *</label><input type="text" name="name_en" class="w-full rounded-lg border border-border px-3 py-2 text-sm text-text bg-surface focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary" required></div>
                <div><label class="block text-sm font-medium text-text mb-1.5">Name (AR)</label><input type="text" name="name_ar" class="w-full rounded-lg border border-border px-3 py-2 text-sm text-text bg-surface focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary"></div>
                <div><label class="block text-sm font-medium text-text mb-1.5">{{ __('messages.slug') }}</label><input type="text" name="slug" class="w-full rounded-lg border border-border px-3 py-2 text-sm text-text bg-surface focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary"></div>
                <div><label class="block text-sm font-medium text-text mb-1.5">Icon (CSS class)</label><input type="text" name="icon" class="w-full rounded-lg border border-border px-3 py-2 text-sm text-text bg-surface focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary" placeholder="lucide lucide-heart"></div>
                <div class="md:col-span-2"><label class="block text-sm font-medium text-text mb-1.5">Description (EN)</label><textarea name="description_en" class="w-full rounded-lg border border-border px-3 py-2 text-sm text-text bg-surface focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary" rows="3"></textarea></div>
                <div class="md:col-span-2"><label class="block text-sm font-medium text-text mb-1.5">Description (AR)</label><textarea name="description_ar" class="w-full rounded-lg border border-border px-3 py-2 text-sm text-text bg-surface focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary" rows="3"></textarea></div>
                <div><label class="block text-sm font-medium text-text mb-1.5">{{ __('messages.image') }}</label><input type="file" name="image" class="w-full rounded-lg border border-border px-3 py-2 text-sm text-text bg-surface focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary" accept="image/*"></div>
                <div><label class="block text-sm font-medium text-text mb-1.5">{{ __('messages.display_order') }}</label><input type="number" name="display_order" class="w-full rounded-lg border border-border px-3 py-2 text-sm text-text bg-surface focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary" value="0"></div>
                <div class="md:col-span-2 flex items-center gap-2"><input type="checkbox" name="is_active" value="1" checked class="w-4 h-4 text-primary border-border rounded focus:ring-primary"><label class="text-sm font-medium text-text">{{ __('messages.active') }}</label></div>
                <div><label class="block text-sm font-medium text-text mb-1.5">Meta Title (EN)</label><input type="text" name="meta_title_en" class="w-full rounded-lg border border-border px-3 py-2 text-sm text-text bg-surface focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary"></div>
                <div><label class="block text-sm font-medium text-text mb-1.5">Meta Title (AR)</label><input type="text" name="meta_title_ar" class="w-full rounded-lg border border-border px-3 py-2 text-sm text-text bg-surface focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary"></div>
                <div><label class="block text-sm font-medium text-text mb-1.5">Meta Description (EN)</label><textarea name="meta_description_en" class="w-full rounded-lg border border-border px-3 py-2 text-sm text-text bg-surface focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary" rows="2"></textarea></div>
                <div><label class="block text-sm font-medium text-text mb-1.5">Meta Description (AR)</label><textarea name="meta_description_ar" class="w-full rounded-lg border border-border px-3 py-2 text-sm text-text bg-surface focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary" rows="2"></textarea></div>
            </div>
            <button type="submit" class="px-4 py-2.5 bg-primary text-white rounded-lg hover:bg-primary-hover transition-colors text-sm font-medium">{{ __('messages.save_service') }}</button>
        </form>
    </div>
</div>
@endsection
