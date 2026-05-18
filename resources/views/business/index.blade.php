@extends('layouts.app')

@section('title', __('messages.for_business'))

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <h1>{{ __('messages.for_business') }}</h1>
            <p class="lead">Corporate wellness solutions for your organization.</p>
            <p>We offer Employee Assistance Programs (EAPs), mental health training, workshops, and awareness campaigns tailored to your organization's needs.</p>

            <div class="card mt-4">
                <div class="card-header">Send an Inquiry</div>
                <div class="card-body">
                    <form action="{{ route('business.inquiry') }}" method="POST">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6"><label class="form-label">Organization Name *</label><input type="text" name="organization_name" class="form-control" required></div>
                            <div class="col-md-6"><label class="form-label">Contact Person *</label><input type="text" name="contact_person_name" class="form-control" required></div>
                            <div class="col-md-6"><label class="form-label">Email *</label><input type="email" name="email" class="form-control" required></div>
                            <div class="col-md-6"><label class="form-label">Phone *</label><input type="text" name="phone" class="form-control" required></div>
                            <div class="col-md-6"><label class="form-label">Type of Service</label><input type="text" name="type_of_service" class="form-control" placeholder="EAP, Training, Workshop..."></div>
                            <div class="col-md-6"><label class="form-label">Organization Size</label><input type="text" name="organization_size" class="form-control" placeholder="e.g. 50-100 employees"></div>
                            <div class="col-12"><label class="form-label">Message</label><textarea name="message" class="form-control" rows="4"></textarea></div>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">{{ __('messages.send_inquiry') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
