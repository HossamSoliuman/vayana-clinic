@extends('layouts.app')

@section('title', __('messages.in_person'))

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <h1>{{ __('messages.in_person') }}</h1>
            <p class="lead">Book an in-person therapy session at our clinic.</p>

            @if($providers->count())
                <p>Preferred providers:</p>
                <ul>
                    @foreach($providers as $provider)
                        <li>{{ $provider->title }} {{ $provider->user?->full_name }} - {{ $provider->specialties->pluck('name_en')->implode(', ') }}</li>
                    @endforeach
                </ul>
            @endif

            <div class="card mt-4">
                <div class="card-header">Request Appointment</div>
                <div class="card-body">
                    <form action="{{ route('appointments.store') }}" method="POST">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6"><label class="form-label">Full Name *</label><input type="text" name="full_name" class="form-control" required></div>
                            <div class="col-md-6"><label class="form-label">Email *</label><input type="email" name="email" class="form-control" required></div>
                            <div class="col-md-6"><label class="form-label">Phone *</label><input type="text" name="phone" class="form-control" required></div>
                            <div class="col-md-6"><label class="form-label">Preferred Provider</label><select name="preferred_provider_id" class="form-select"><option value="">No preference</option>@foreach($providers as $p)<option value="{{ $p->id }}">{{ $p->user?->full_name }}</option>@endforeach</select></div>
                            <div class="col-md-6"><label class="form-label">Preferred Date</label><input type="date" name="preferred_date" class="form-control" min="{{ date('Y-m-d') }}"></div>
                            <div class="col-md-6"><label class="form-label">Preferred Time</label><input type="time" name="preferred_time" class="form-control"></div>
                            <div class="col-12"><label class="form-label">Reason for Visit</label><textarea name="reason_for_visit" class="form-control" rows="3"></textarea></div>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">{{ __('messages.book_appointment') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
