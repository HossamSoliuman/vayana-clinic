@extends('layouts.admin')

@section('title', 'Add Resource')

@section('content')
<div class="flex items-center justify-between mb-8">
    <h2 class="text-2xl font-bold text-text">{{ __('messages.add_resource') }}</h2>
    <a href="{{ route('admin.resources.index') }}" class="inline-flex items-center gap-2 px-4 py-2 border border-border text-text-muted rounded-lg hover:bg-surface-secondary transition-colors text-sm"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><path d="m12 19-7-7 7-7"/><path d="M19 12H5"/></svg> Back</a>
</div>
<div class="bg-surface rounded-xl border border-border">
    <div class="p-6">
        <form action="{{ route('admin.resources.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                <div class="lg:col-span-2"><label class="block text-sm font-medium text-text mb-1.5">Title (EN) *</label><input type="text" name="title_en" class="w-full rounded-lg border border-border px-3 py-2 text-sm text-text bg-surface focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary" required></div>
                <div class="lg:col-span-2"><label class="block text-sm font-medium text-text mb-1.5">Title (AR)</label><input type="text" name="title_ar" class="w-full rounded-lg border border-border px-3 py-2 text-sm text-text bg-surface focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary"></div>
                <div class="lg:col-span-2"><label class="block text-sm font-medium text-text mb-1.5">{{ __('messages.slug') }}</label><input type="text" name="slug" class="w-full rounded-lg border border-border px-3 py-2 text-sm text-text bg-surface focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary"></div>
                <div class="lg:col-span-2"><label class="block text-sm font-medium text-text mb-1.5">Type *</label><select name="type" class="w-full rounded-lg border border-border px-3 py-2 text-sm text-text bg-surface focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary" required><option value="blog_article">{{ __('messages.blog_article') }}</option><option value="audio">{{ __('messages.audio') }}</option><option value="self_help_ebook">Self-Help eBook</option><option value="video">{{ __('messages.video') }}</option><option value="guided_meditation">{{ __('messages.guided_meditation') }}</option><option value="mental_health_conversation">{{ __('messages.mental_health_conversation') }}</option><option value="assessment">{{ __('messages.assessment') }}</option></select></div>
                <div class="lg:col-span-2"><label class="block text-sm font-medium text-text mb-1.5">{{ __('messages.category') }}</label><select name="category_id" class="w-full rounded-lg border border-border px-3 py-2 text-sm text-text bg-surface focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary"><option value="">{{ __('messages.none') }}</option>@foreach($categories as $c)<option value="{{ $c->id }}">{{ $c->name_en }}</option>@endforeach</select></div>
                <div class="lg:col-span-2"><label class="block text-sm font-medium text-text mb-1.5">{{ __('messages.thumbnail') }}</label><input type="file" name="thumbnail_image" class="w-full rounded-lg border border-border px-3 py-2 text-sm text-text bg-surface focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary" accept="image/*"></div>
                
                <div class="lg:col-span-2"><label class="block text-sm font-medium text-text mb-1.5">{{ __('messages.media_u_r_l') }}</label><input type="url" name="media_url" class="w-full rounded-lg border border-border px-3 py-2 text-sm text-text bg-surface focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary"></div>
                <div class="lg:col-span-1"><label class="block text-sm font-medium text-text mb-1.5">{{ __('messages.duration') }}</label><input type="text" name="media_duration" class="w-full rounded-lg border border-border px-3 py-2 text-sm text-text bg-surface focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary" placeholder="15:30"></div>
                <div class="lg:col-span-1"><label class="block text-sm font-medium text-text mb-1.5">File (PDF)</label><input type="file" name="file" class="w-full rounded-lg border border-border px-3 py-2 text-sm text-text bg-surface focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary" accept=".pdf"></div>
                
                <div class="lg:col-span-2"><label class="block text-sm font-medium text-text mb-1.5">{{ __('messages.external_link') }}</label><input type="url" name="external_link" class="w-full rounded-lg border border-border px-3 py-2 text-sm text-text bg-surface focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary"></div>
                <div class="lg:col-span-2"><label class="block text-sm font-medium text-text mb-1.5">{{ __('messages.display_order') }}</label><input type="number" name="display_order" class="w-full rounded-lg border border-border px-3 py-2 text-sm text-text bg-surface focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary" value="0"></div>
                
                <div class="lg:col-span-4"><label class="block text-sm font-medium text-text mb-1.5">Description (EN)</label><textarea name="description_en" class="w-full rounded-lg border border-border px-3 py-2 text-sm text-text bg-surface focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary" rows="2"></textarea></div>
                <div class="lg:col-span-4"><label class="block text-sm font-medium text-text mb-1.5">Description (AR)</label><textarea name="description_ar" class="w-full rounded-lg border border-border px-3 py-2 text-sm text-text bg-surface focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary" rows="2"></textarea></div>
                <div class="lg:col-span-4"><label class="block text-sm font-medium text-text mb-1.5">Content (EN)</label><textarea name="content_en" class="w-full rounded-lg border border-border px-3 py-2 text-sm text-text bg-surface focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary" rows="5"></textarea></div>
                <div class="lg:col-span-4"><label class="block text-sm font-medium text-text mb-1.5">Content (AR)</label><textarea name="content_ar" class="w-full rounded-lg border border-border px-3 py-2 text-sm text-text bg-surface focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary" rows="5"></textarea></div>
                
                <div class="lg:col-span-1 flex items-center gap-2"><input type="checkbox" name="is_featured" value="1" class="w-4 h-4 text-primary border-border rounded focus:ring-primary"><label class="text-sm font-medium text-text">{{ __('messages.featured') }}</label></div>
                <div class="lg:col-span-1 flex items-center gap-2"><input type="checkbox" name="is_new" value="1" class="w-4 h-4 text-primary border-border rounded focus:ring-primary"><label class="text-sm font-medium text-text">{{ __('messages.new') }}</label></div>
                <div class="lg:col-span-1 flex items-center gap-2"><input type="checkbox" name="is_active" value="1" checked class="w-4 h-4 text-primary border-border rounded focus:ring-primary"><label class="text-sm font-medium text-text">{{ __('messages.active') }}</label></div>
                <div class="lg:col-span-1 flex items-center gap-2"><input type="checkbox" name="publish_now" value="1" class="w-4 h-4 text-primary border-border rounded focus:ring-primary"><label class="text-sm font-medium text-text">{{ __('messages.publish_now') }}</label></div>
                
                <div class="lg:col-span-2"><label class="block text-sm font-medium text-text mb-1.5">Meta Title (EN)</label><input type="text" name="meta_title_en" class="w-full rounded-lg border border-border px-3 py-2 text-sm text-text bg-surface focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary"></div>
                <div class="lg:col-span-2"><label class="block text-sm font-medium text-text mb-1.5">Meta Title (AR)</label><input type="text" name="meta_title_ar" class="w-full rounded-lg border border-border px-3 py-2 text-sm text-text bg-surface focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary"></div>
                <div class="lg:col-span-2"><label class="block text-sm font-medium text-text mb-1.5">Meta Description (EN)</label><textarea name="meta_description_en" class="w-full rounded-lg border border-border px-3 py-2 text-sm text-text bg-surface focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary" rows="2"></textarea></div>
                <div class="lg:col-span-2"><label class="block text-sm font-medium text-text mb-1.5">Meta Description (AR)</label><textarea name="meta_description_ar" class="w-full rounded-lg border border-border px-3 py-2 text-sm text-text bg-surface focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary" rows="2"></textarea></div>
            </div>
            <button type="submit" class="px-4 py-2.5 bg-primary text-white rounded-lg hover:bg-primary-hover transition-colors text-sm font-medium">{{ __('messages.save_resource') }}</button>
        </form>
    </div>
</div>
@endsection
