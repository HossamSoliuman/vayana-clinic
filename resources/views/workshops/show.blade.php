@extends('layouts.app')

@section('title', $workshop->localized_title)

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            @if($workshop->image)<img src="{{ asset('storage/'.$workshop->image) }}" class="img-fluid rounded mb-4">@endif
            <h1>{{ $workshop->localized_title }}</h1>
            <div class="mb-3">
                <span class="badge bg-primary">{{ $workshop->category }}</span>
                <span class="badge bg-info">{{ $workshop->location }}</span>
            </div>
            <p class="lead">{{ $workshop->short_description_en }}</p>
            <p>{{ $workshop->description_en }}</p>
            <table class="table table-borderless">
                <tr><td><strong>Date & Time:</strong></td><td>{{ $workshop->date_time?->format('F d, Y h:i A') ?? 'TBA' }}</td></tr>
                <tr><td><strong>Duration:</strong></td><td>{{ $workshop->duration ?? 'N/A' }}</td></tr>
                <tr><td><strong>Location:</strong></td><td>{{ $workshop->location }}</td></tr>
                <tr><td><strong>Price:</strong></td><td>{{ $workshop->price ? $workshop->price . ' ' . $workshop->currency : __('messages.free') }}</td></tr>
                <tr><td><strong>Max Participants:</strong></td><td>{{ $workshop->max_participants ?? 'Unlimited' }}</td></tr>
                @if($workshop->instructor_name)<tr><td><strong>Instructor:</strong></td><td>{{ $workshop->instructor_name }}</td></tr>@endif
            </table>
            @if($workshop->is_registration_open)
                <div class="card">
                    <div class="card-header">Register Interest</div>
                    <div class="card-body">
                        <form action="{{ route('workshops.register', $workshop) }}" method="POST">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-4"><input type="text" name="name" class="form-control" placeholder="Your Name" required></div>
                                <div class="col-md-4"><input type="email" name="email" class="form-control" placeholder="Email" required></div>
                                <div class="col-md-4"><input type="text" name="phone" class="form-control" placeholder="Phone"></div>
                            </div>
                            <button type="submit" class="btn btn-primary mt-3">Submit Interest</button>
                        </form>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
