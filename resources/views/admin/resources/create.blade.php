@extends('layouts.admin')

@section('title', 'Add Resource')

@section('content')
<div class="flex items-center justify-between mb-8">
    <h2 class="text-2xl font-bold text-text">Add Resource</h2>
    <a href="{{ route('admin.resources.index') }}" class="inline-flex items-center gap-2 px-4 py-2 border border-border text-text-muted rounded-lg hover:bg-surface-secondary transition-colors text-sm"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><path d="m12 19-7-7 7-7"/><path d="M19 12H5"/></svg> Back</a>
</div>
<div class="bg-surface rounded-xl border border-border">
    <div class="p-6">
        <form action="{{ route('admin.resources.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                <div class="lg:col-span-2"><label class="block text-sm font-medium text-text mb-1.5">Title (EN) *</label><input type="text" name="title_en" class="w-full rounded-lg border border-border px-3 py-2 text-sm text-text bg-surface focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary" required></div>
                <div class="lg:col-span-2"><label class="block text-sm font-medium text-text mb-1.5">Title (AR)</label><input type="text" name="title_ar" class="w-full rounded-lg border border-border px-3 py-2 text-sm text-text bg-surface focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary"></div>
                <div class="lg:col-span-2"><label class="block text-sm font-medium text-text mb-1.5">Slug</label><input type="text" name="slug" class="w-full rounded-lg border border-border px-3 py-2 text-sm text-text bg-surface focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary"></div>
                <div class="lg:col-span-2"><label class="block text-sm font-medium text-text mb-1.5">Type *</label><select name="type" class="w-full rounded-lg border border-border px-3 py-2 text-sm text-text bg-surface focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary" required><option value="blog_article">Blog Article</option><option value="audio">Audio</option><option value="self_help_ebook">Self-Help eBook</option><option value="video">Video</option><option value="guided_meditation">Guided Meditation</option><option value="mental_health_conversation">Mental Health Conversation</option><option value="assessment">Assessment</option></select></div>
                <div class="lg:col-span-2"><label class="block text-sm font-medium text-text mb-1.5">Category</label><select name="category_id" class="w-full rounded-lg border border-border px-3 py-2 text-sm text-text bg-surface focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary"><option value="">None</option>@foreach($categories as $c)<option value="{{ $c->id }}">{{ $c->name_en }}</option>@endforeach</select></div>
                <div class="lg:col-span-2"><label class="block text-sm font-medium text-text mb-1.5">Thumbnail</label><input type="file" name="thumbnail_image" class="w-full rounded-lg border border-border px-3 py-2 text-sm text-text bg-surface focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary" accept="image/*"></div>
                
                <div class="lg:col-span-2"><label class="block text-sm font-medium text-text mb-1.5">Media URL</label><input type="url" name="media_url" class="w-full rounded-lg border border-border px-3 py-2 text-sm text-text bg-surface focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary"></div>
                <div class="lg:col-span-1"><label class="block text-sm font-medium text-text mb-1.5">Duration</label><input type="text" name="media_duration" class="w-full rounded-lg border border-border px-3 py-2 text-sm text-text bg-surface focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary" placeholder="15:30"></div>
                <div class="lg:col-span-1"><label class="block text-sm font-medium text-text mb-1.5">File (PDF)</label><input type="file" name="file" class="w-full rounded-lg border border-border px-3 py-2 text-sm text-text bg-surface focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary" accept=".pdf"></div>
                
                <div class="lg:col-span-2"><label class="block text-sm font-medium text-text mb-1.5">External Link</label><input type="url" name="external_link" class="w-full rounded-lg border border-border px-3 py-2 text-sm text-text bg-surface focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary"></div>
                <div class="lg:col-span-2"><label class="block text-sm font-medium text-text mb-1.5">Display Order</label><input type="number" name="display_order" class="w-full rounded-lg border border-border px-3 py-2 text-sm text-text bg-surface focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary" value="0"></div>
                
                <div class="lg:col-span-4"><label class="block text-sm font-medium text-text mb-1.5">Description (EN)</label><textarea name="description_en" class="w-full rounded-lg border border-border px-3 py-2 text-sm text-text bg-surface focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary" rows="2"></textarea></div>
                <div class="lg:col-span-4"><label class="block text-sm font-medium text-text mb-1.5">Description (AR)</label><textarea name="description_ar" class="w-full rounded-lg border border-border px-3 py-2 text-sm text-text bg-surface focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary" rows="2"></textarea></div>
                <div class="lg:col-span-4"><label class="block text-sm font-medium text-text mb-1.5">Content (EN)</label><textarea name="content_en" class="w-full rounded-lg border border-border px-3 py-2 text-sm text-text bg-surface focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary" rows="5"></textarea></div>
                <div class="lg:col-span-4"><label class="block text-sm font-medium text-text mb-1.5">Content (AR)</label><textarea name="content_ar" class="w-full rounded-lg border border-border px-3 py-2 text-sm text-text bg-surface focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary" rows="5"></textarea></div>
                
                <div class="lg:col-span-1 flex items-center gap-2"><input type="checkbox" name="is_featured" value="1" class="w-4 h-4 text-primary border-border rounded focus:ring-primary"><label class="text-sm font-medium text-text">Featured</label></div>
                <div class="lg:col-span-1 flex items-center gap-2"><input type="checkbox" name="is_new" value="1" class="w-4 h-4 text-primary border-border rounded focus:ring-primary"><label class="text-sm font-medium text-text">New</label></div>
                <div class="lg:col-span-1 flex items-center gap-2"><input type="checkbox" name="is_active" value="1" checked class="w-4 h-4 text-primary border-border rounded focus:ring-primary"><label class="text-sm font-medium text-text">Active</label></div>
                <div class="lg:col-span-1 flex items-center gap-2"><input type="checkbox" name="publish_now" value="1" class="w-4 h-4 text-primary border-border rounded focus:ring-primary"><label class="text-sm font-medium text-text">Publish Now</label></div>
                
                <div class="lg:col-span-2"><label class="block text-sm font-medium text-text mb-1.5">Meta Title (EN)</label><input type="text" name="meta_title_en" class="w-full rounded-lg border border-border px-3 py-2 text-sm text-text bg-surface focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary"></div>
                <div class="lg:col-span-2"><label class="block text-sm font-medium text-text mb-1.5">Meta Title (AR)</label><input type="text" name="meta_title_ar" class="w-full rounded-lg border border-border px-3 py-2 text-sm text-text bg-surface focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary"></div>
                <div class="lg:col-span-2"><label class="block text-sm font-medium text-text mb-1.5">Meta Description (EN)</label><textarea name="meta_description_en" class="w-full rounded-lg border border-border px-3 py-2 text-sm text-text bg-surface focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary" rows="2"></textarea></div>
                <div class="lg:col-span-2"><label class="block text-sm font-medium text-text mb-1.5">Meta Description (AR)</label><textarea name="meta_description_ar" class="w-full rounded-lg border border-border px-3 py-2 text-sm text-text bg-surface focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary" rows="2"></textarea></div>
            </div>
            <button type="submit" class="px-4 py-2.5 bg-primary text-white rounded-lg hover:bg-primary-hover transition-colors text-sm font-medium">Save Resource</button>
        </form>
    </div>
</div>
@endsection
