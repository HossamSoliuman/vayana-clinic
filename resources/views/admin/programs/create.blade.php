@extends('layouts.admin')

@section('title', 'Add Program')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Add Program</h2>
    <a href="{{ route('admin.programs.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left"></i> Back</a>
</div>
<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.programs.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-3"><label class="form-label">Name (EN) *</label><input type="text" name="name_en" class="form-control" required></div>
                <div class="col-md-6 mb-3"><label class="form-label">Name (AR)</label><input type="text" name="name_ar" class="form-control"></div>
                <div class="col-md-6 mb-3"><label class="form-label">Slug</label><input type="text" name="slug" class="form-control"></div>
                <div class="col-md-6 mb-3"><label class="form-label">Service</label><select name="service_id" class="form-select"><option value="">None</option>@foreach($services as $s)<option value="{{ $s->id }}">{{ $s->name_en }}</option>@endforeach</select></div>
                <div class="col-md-6 mb-3"><label class="form-label">Program Type *</label><select name="program_type" class="form-select" required><option value="group">Group</option><option value="individual">Individual</option><option value="workshop">Workshop</option></select></div>
                <div class="col-md-6 mb-3"><label class="form-label">Level</label><select name="level" class="form-select"><option value="">None</option><option value="beginner">Beginner</option><option value="intermediate">Intermediate</option><option value="advanced">Advanced</option></select></div>
                <div class="col-md-6 mb-3"><label class="form-label">Duration</label><input type="text" name="duration" class="form-control" placeholder="e.g. 8 weeks"></div>
                <div class="col-md-3 mb-3"><label class="form-label">Sessions</label><input type="number" name="session_count" class="form-control"></div>
                <div class="col-md-3 mb-3"><label class="form-label">Max Participants</label><input type="number" name="max_participants" class="form-control"></div>
                <div class="col-md-4 mb-3"><label class="form-label">Price/Session</label><input type="number" step="0.01" name="price_per_session" class="form-control"></div>
                <div class="col-md-4 mb-3"><label class="form-label">Full Price</label><input type="number" step="0.01" name="full_program_price" class="form-control"></div>
                <div class="col-md-4 mb-3"><label class="form-label">Currency</label><select name="currency" class="form-select"><option value="SAR">SAR</option><option value="USD">USD</option></select></div>
                <div class="col-md-6 mb-3"><label class="form-label">Start Date</label><input type="date" name="start_date" class="form-control"></div>
                <div class="col-md-6 mb-3"><label class="form-label">End Date</label><input type="date" name="end_date" class="form-control"></div>
                <div class="col-md-6 mb-3"><label class="form-label">Facilitator</label><select name="facilitator_provider_id" class="form-select"><option value="">None</option>@foreach($providers as $p)<option value="{{ $p->id }}">{{ $p->user?->full_name }}</option>@endforeach</select></div>
                <div class="col-md-6 mb-3"><label class="form-label">Image</label><input type="file" name="image" class="form-control" accept="image/*"></div>
                <div class="col-md-12 mb-3"><label class="form-label">Description (EN) *</label><textarea name="description_en" class="form-control" rows="3" required></textarea></div>
                <div class="col-md-12 mb-3"><label class="form-label">Description (AR)</label><textarea name="description_ar" class="form-control" rows="3"></textarea></div>
                <div class="col-md-12 mb-3"><label class="form-label">What You Will Learn (EN) - one per line</label><textarea name="what_you_will_learn_en" class="form-control" rows="3"></textarea></div>
                <div class="col-md-12 mb-3"><label class="form-label">What You Will Learn (AR) - one per line</label><textarea name="what_you_will_learn_ar" class="form-control" rows="3"></textarea></div>
                <div class="col-md-6 mb-3"><label class="form-label d-block">Featured</label><div class="form-check form-check-inline"><input class="form-check-input" type="checkbox" name="is_featured" value="1"><label class="form-check-label">Yes</label></div></div>
                <div class="col-md-6 mb-3"><label class="form-label d-block">Active</label><div class="form-check form-check-inline"><input class="form-check-input" type="checkbox" name="is_active" value="1" checked><label class="form-check-label">Yes</label></div></div>
            </div>
            <button type="submit" class="btn btn-primary">Save Program</button>
        </form>
    </div>
</div>
@endsection
