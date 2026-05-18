@extends('layouts.admin')

@section('title', 'Add Service')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Add Service</h2>
    <a href="{{ route('admin.services.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left"></i> Back</a>
</div>
<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.services.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-3"><label class="form-label">Name (EN) *</label><input type="text" name="name_en" class="form-control" required></div>
                <div class="col-md-6 mb-3"><label class="form-label">Name (AR)</label><input type="text" name="name_ar" class="form-control"></div>
                <div class="col-md-6 mb-3"><label class="form-label">Slug</label><input type="text" name="slug" class="form-control"></div>
                <div class="col-md-6 mb-3"><label class="form-label">Icon (CSS class)</label><input type="text" name="icon" class="form-control" placeholder="bi bi-heart"></div>
                <div class="col-md-12 mb-3"><label class="form-label">Description (EN)</label><textarea name="description_en" class="form-control" rows="3"></textarea></div>
                <div class="col-md-12 mb-3"><label class="form-label">Description (AR)</label><textarea name="description_ar" class="form-control" rows="3"></textarea></div>
                <div class="col-md-6 mb-3"><label class="form-label">Image</label><input type="file" name="image" class="form-control" accept="image/*"></div>
                <div class="col-md-3 mb-3"><label class="form-label">Display Order</label><input type="number" name="display_order" class="form-control" value="0"></div>
                <div class="col-md-3 mb-3"><label class="form-label d-block">Active</label><div class="form-check form-check-inline"><input class="form-check-input" type="checkbox" name="is_active" value="1" checked><label class="form-check-label">Yes</label></div></div>
                <div class="col-md-6 mb-3"><label class="form-label">Meta Title (EN)</label><input type="text" name="meta_title_en" class="form-control"></div>
                <div class="col-md-6 mb-3"><label class="form-label">Meta Title (AR)</label><input type="text" name="meta_title_ar" class="form-control"></div>
                <div class="col-md-6 mb-3"><label class="form-label">Meta Description (EN)</label><textarea name="meta_description_en" class="form-control" rows="2"></textarea></div>
                <div class="col-md-6 mb-3"><label class="form-label">Meta Description (AR)</label><textarea name="meta_description_ar" class="form-control" rows="2"></textarea></div>
            </div>
            <button type="submit" class="btn btn-primary">Save Service</button>
        </form>
    </div>
</div>
@endsection
