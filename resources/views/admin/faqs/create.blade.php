@extends('layouts.admin')

@section('title', 'Add FAQ')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Add FAQ</h2>
    <a href="{{ route('admin.faqs.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left"></i> Back</a>
</div>
<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.faqs.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-3"><label class="form-label">Question (EN) *</label><input type="text" name="question_en" class="form-control" required></div>
                <div class="col-md-6 mb-3"><label class="form-label">Question (AR)</label><input type="text" name="question_ar" class="form-control"></div>
                <div class="col-md-6 mb-3"><label class="form-label">Answer (EN) *</label><textarea name="answer_en" class="form-control" rows="4" required></textarea></div>
                <div class="col-md-6 mb-3"><label class="form-label">Answer (AR)</label><textarea name="answer_ar" class="form-control" rows="4"></textarea></div>
                <div class="col-md-6 mb-3"><label class="form-label">Category</label><select name="category" class="form-select"><option value="general">General</option><option value="services">Services</option><option value="appointments">Appointments</option><option value="billing">Billing</option><option value="business">Business</option><option value="providers">Providers</option></select></div>
                <div class="col-md-3 mb-3"><label class="form-label">Display Order</label><input type="number" name="display_order" class="form-control" value="0"></div>
                <div class="col-md-3 mb-3"><label class="form-label d-block">Active</label><div class="form-check form-check-inline"><input class="form-check-input" type="checkbox" name="is_active" value="1" checked><label class="form-check-label">Yes</label></div></div>
            </div>
            <button type="submit" class="btn btn-primary">Save FAQ</button>
        </form>
    </div>
</div>
@endsection
