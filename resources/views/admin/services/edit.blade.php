@extends('layouts.admin')

@section('title', 'Edit Service')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Edit Service</h2>
    <a href="{{ route('admin.services.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left"></i> Back</a>
</div>
<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.services.update', $service) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6 mb-3"><label class="form-label">Name (EN) *</label><input type="text" name="name_en" class="form-control" value="{{ $service->name_en }}" required></div>
                <div class="col-md-6 mb-3"><label class="form-label">Name (AR)</label><input type="text" name="name_ar" class="form-control" value="{{ $service->name_ar }}"></div>
                <div class="col-md-6 mb-3"><label class="form-label">Slug</label><input type="text" name="slug" class="form-control" value="{{ $service->slug }}"></div>
                <div class="col-md-6 mb-3"><label class="form-label">Icon</label><input type="text" name="icon" class="form-control" value="{{ $service->icon }}"></div>
                <div class="col-md-12 mb-3"><label class="form-label">Description (EN)</label><textarea name="description_en" class="form-control" rows="3">{{ $service->description_en }}</textarea></div>
                <div class="col-md-12 mb-3"><label class="form-label">Description (AR)</label><textarea name="description_ar" class="form-control" rows="3">{{ $service->description_ar }}</textarea></div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Image</label>
                    <input type="file" name="image" class="form-control" accept="image/*">
                    @if($service->image)<div class="mt-2"><img src="{{ asset('storage/'.$service->image) }}" height="60" class="img-thumbnail"></div>@endif
                </div>
                <div class="col-md-2 mb-3"><label class="form-label">Order</label><input type="number" name="display_order" class="form-control" value="{{ $service->display_order }}"></div>
                <div class="col-md-2 mb-3"><label class="form-label d-block">Active</label><div class="form-check form-check-inline"><input class="form-check-input" type="checkbox" name="is_active" value="1" {{ $service->is_active ? 'checked' : '' }}><label class="form-check-label">Yes</label></div></div>
                <div class="col-md-6 mb-3"><label class="form-label">Meta Title (EN)</label><input type="text" name="meta_title_en" class="form-control" value="{{ $service->meta_title_en }}"></div>
                <div class="col-md-6 mb-3"><label class="form-label">Meta Title (AR)</label><input type="text" name="meta_title_ar" class="form-control" value="{{ $service->meta_title_ar }}"></div>
                <div class="col-md-6 mb-3"><label class="form-label">Meta Description (EN)</label><textarea name="meta_description_en" class="form-control" rows="2">{{ $service->meta_description_en }}</textarea></div>
                <div class="col-md-6 mb-3"><label class="form-label">Meta Description (AR)</label><textarea name="meta_description_ar" class="form-control" rows="2">{{ $service->meta_description_ar }}</textarea></div>
            </div>
            <button type="submit" class="btn btn-primary">Update Service</button>
        </form>
    </div>
</div>
@endsection
