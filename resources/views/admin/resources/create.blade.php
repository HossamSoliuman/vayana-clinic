@extends('layouts.admin')

@section('title', 'Add Resource')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Add Resource</h2>
    <a href="{{ route('admin.resources.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left"></i> Back</a>
</div>
<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.resources.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-3"><label class="form-label">Title (EN) *</label><input type="text" name="title_en" class="form-control" required></div>
                <div class="col-md-6 mb-3"><label class="form-label">Title (AR)</label><input type="text" name="title_ar" class="form-control"></div>
                <div class="col-md-6 mb-3"><label class="form-label">Slug</label><input type="text" name="slug" class="form-control"></div>
                <div class="col-md-6 mb-3"><label class="form-label">Type *</label><select name="type" class="form-select" required><option value="blog_article">Blog Article</option><option value="audio">Audio</option><option value="self_help_ebook">Self-Help eBook</option><option value="video">Video</option><option value="guided_meditation">Guided Meditation</option><option value="mental_health_conversation">Mental Health Conversation</option><option value="assessment">Assessment</option></select></div>
                <div class="col-md-6 mb-3"><label class="form-label">Category</label><select name="category_id" class="form-select"><option value="">None</option>@foreach($categories as $c)<option value="{{ $c->id }}">{{ $c->name_en }}</option>@endforeach</select></div>
                <div class="col-md-6 mb-3"><label class="form-label">Thumbnail</label><input type="file" name="thumbnail_image" class="form-control" accept="image/*"></div>
                <div class="col-md-6 mb-3"><label class="form-label">Media URL</label><input type="url" name="media_url" class="form-control"></div>
                <div class="col-md-3 mb-3"><label class="form-label">Duration</label><input type="text" name="media_duration" class="form-control" placeholder="15:30"></div>
                <div class="col-md-3 mb-3"><label class="form-label">File (PDF)</label><input type="file" name="file" class="form-control" accept=".pdf"></div>
                <div class="col-md-6 mb-3"><label class="form-label">External Link</label><input type="url" name="external_link" class="form-control"></div>
                <div class="col-md-6 mb-3"><label class="form-label">Display Order</label><input type="number" name="display_order" class="form-control" value="0"></div>
                <div class="col-md-12 mb-3"><label class="form-label">Description (EN)</label><textarea name="description_en" class="form-control" rows="2"></textarea></div>
                <div class="col-md-12 mb-3"><label class="form-label">Description (AR)</label><textarea name="description_ar" class="form-control" rows="2"></textarea></div>
                <div class="col-md-12 mb-3"><label class="form-label">Content (EN)</label><textarea name="content_en" class="form-control" rows="5"></textarea></div>
                <div class="col-md-12 mb-3"><label class="form-label">Content (AR)</label><textarea name="content_ar" class="form-control" rows="5"></textarea></div>
                <div class="col-md-3 mb-3"><label class="form-label d-block">Featured</label><div class="form-check form-check-inline"><input class="form-check-input" type="checkbox" name="is_featured" value="1"><label class="form-check-label">Yes</label></div></div>
                <div class="col-md-3 mb-3"><label class="form-label d-block">New</label><div class="form-check form-check-inline"><input class="form-check-input" type="checkbox" name="is_new" value="1"><label class="form-check-label">Yes</label></div></div>
                <div class="col-md-3 mb-3"><label class="form-label d-block">Active</label><div class="form-check form-check-inline"><input class="form-check-input" type="checkbox" name="is_active" value="1" checked><label class="form-check-label">Yes</label></div></div>
                <div class="col-md-3 mb-3"><label class="form-label d-block">Publish Now</label><div class="form-check form-check-inline"><input class="form-check-input" type="checkbox" name="publish_now" value="1"><label class="form-check-label">Yes</label></div></div>
                <div class="col-md-6 mb-3"><label class="form-label">Meta Title (EN)</label><input type="text" name="meta_title_en" class="form-control"></div>
                <div class="col-md-6 mb-3"><label class="form-label">Meta Title (AR)</label><input type="text" name="meta_title_ar" class="form-control"></div>
                <div class="col-md-6 mb-3"><label class="form-label">Meta Description (EN)</label><textarea name="meta_description_en" class="form-control" rows="2"></textarea></div>
                <div class="col-md-6 mb-3"><label class="form-label">Meta Description (AR)</label><textarea name="meta_description_ar" class="form-control" rows="2"></textarea></div>
            </div>
            <button type="submit" class="btn btn-primary">Save Resource</button>
        </form>
    </div>
</div>
@endsection
