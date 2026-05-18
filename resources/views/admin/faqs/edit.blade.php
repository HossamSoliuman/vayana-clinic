@extends('layouts.admin')

@section('title', 'Edit FAQ')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Edit FAQ</h2>
    <a href="{{ route('admin.faqs.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left"></i> Back</a>
</div>
<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.faqs.update', $faq) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6 mb-3"><label class="form-label">Question (EN) *</label><input type="text" name="question_en" class="form-control" value="{{ $faq->question_en }}" required></div>
                <div class="col-md-6 mb-3"><label class="form-label">Question (AR)</label><input type="text" name="question_ar" class="form-control" value="{{ $faq->question_ar }}"></div>
                <div class="col-md-6 mb-3"><label class="form-label">Answer (EN) *</label><textarea name="answer_en" class="form-control" rows="4" required>{{ $faq->answer_en }}</textarea></div>
                <div class="col-md-6 mb-3"><label class="form-label">Answer (AR)</label><textarea name="answer_ar" class="form-control" rows="4">{{ $faq->answer_ar }}</textarea></div>
                <div class="col-md-6 mb-3"><label class="form-label">Category</label><select name="category" class="form-select"><option value="general" {{ $faq->category=='general'?'selected':'' }}>General</option><option value="services" {{ $faq->category=='services'?'selected':'' }}>Services</option><option value="appointments" {{ $faq->category=='appointments'?'selected':'' }}>Appointments</option><option value="billing" {{ $faq->category=='billing'?'selected':'' }}>Billing</option><option value="business" {{ $faq->category=='business'?'selected':'' }}>Business</option><option value="providers" {{ $faq->category=='providers'?'selected':'' }}>Providers</option></select></div>
                <div class="col-md-3 mb-3"><label class="form-label">Display Order</label><input type="number" name="display_order" class="form-control" value="{{ $faq->display_order }}"></div>
                <div class="col-md-3 mb-3"><label class="form-label d-block">Active</label><div class="form-check form-check-inline"><input class="form-check-input" type="checkbox" name="is_active" value="1" {{ $faq->is_active?'checked':'' }}><label class="form-check-label">Yes</label></div></div>
            </div>
            <button type="submit" class="btn btn-primary">Update FAQ</button>
        </form>
    </div>
</div>
@endsection
