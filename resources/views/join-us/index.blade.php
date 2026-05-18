@extends('layouts.app')

@section('title', __('messages.join_us'))

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <h1>{{ __('messages.join_us') }}</h1>
            <p class="lead">Join our network of certified mental health professionals.</p>
            <p>We are looking for licensed therapists, psychologists, psychiatrists, and counselors to join our platform and help us serve the community better.</p>

            <div class="card mt-4">
                <div class="card-header">Apply Now</div>
                <div class="card-body">
                    <form action="{{ route('join-us.apply') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6"><label class="form-label">Full Name *</label><input type="text" name="full_name" class="form-control" required></div>
                            <div class="col-md-6"><label class="form-label">Email *</label><input type="email" name="email" class="form-control" required></div>
                            <div class="col-md-6"><label class="form-label">Phone *</label><input type="text" name="phone" class="form-control" required></div>
                            <div class="col-md-6"><label class="form-label">License Number *</label><input type="text" name="license_number" class="form-control" required></div>
                            <div class="col-md-6"><label class="form-label">Specialty</label><input type="text" name="specialty" class="form-control"></div>
                            <div class="col-md-6"><label class="form-label">Work Type *</label><select name="preferred_work_type" class="form-select" required><option value="online">Online</option><option value="in_person">In-Person</option><option value="hybrid">Hybrid</option></select></div>
                            <div class="col-12"><label class="form-label">Availability Description</label><textarea name="availability_description" class="form-control" rows="2"></textarea></div>
                            <div class="col-12"><label class="form-label">Biography *</label><textarea name="biography" class="form-control" rows="4" required></textarea></div>
                            <div class="col-md-4"><label class="form-label">License PDF *</label><input type="file" name="license_document" class="form-control" accept=".pdf" required></div>
                            <div class="col-md-4"><label class="form-label">CV PDF *</label><input type="file" name="cv_document" class="form-control" accept=".pdf" required></div>
                            <div class="col-md-4"><label class="form-label">Certificates PDF</label><input type="file" name="certificates" class="form-control" accept=".pdf"></div>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">{{ __('messages.apply_now') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
