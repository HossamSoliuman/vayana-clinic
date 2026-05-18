@extends('layouts.app')

@section('title', $provider->user?->full_name ?? 'Provider')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body text-center">
                    @if($provider->user?->avatar)
                        <img src="{{ asset('storage/'.$provider->user->avatar) }}" class="rounded-circle mb-3" width="120" height="120" alt="">
                    @else
                        <div class="rounded-circle bg-secondary text-white d-inline-flex align-items-center justify-content-center mb-3" style="width:120px;height:120px;font-size:3rem">
                            {{ strtoupper(substr($provider->user?->first_name_en ?? 'P', 0, 1)) }}
                        </div>
                    @endif
                    <h4>{{ $provider->title }} {{ $provider->user?->full_name }}</h4>
                    <p class="text-muted">{{ $provider->specialties->pluck('name_en')->implode(', ') }}</p>
                    <div class="mb-2">
                        @for($i = 1; $i <= 5; $i++)
                            <i class="bi bi-star{{ $i <= round($provider->rating_average) ? '-fill' : '' }} text-warning"></i>
                        @endfor
                        <span class="ms-1">({{ $provider->rating_count }})</span>
                    </div>
                    <div class="mt-3">
                        <a href="{{ route('in-person.index') }}" class="btn btn-primary">{{ __('messages.book_appointment') }}</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="card mb-4">
                <div class="card-header">About</div>
                <div class="card-body">
                    <p>{{ $provider->biography_en ?? 'No biography available.' }}</p>
                    <table class="table table-borderless">
                        <tr><td><strong>Experience:</strong></td><td>{{ $provider->years_of_experience ?? 'N/A' }} years</td></tr>
                        <tr><td><strong>Work Type:</strong></td><td>{{ $provider->work_type }}</td></tr>
                        <tr><td><strong>Languages:</strong></td><td>{{ $provider->languages->pluck('language')->implode(', ') }}</td></tr>
                        <tr><td><strong>Online Session:</strong></td><td>{{ $provider->session_price_online ? $provider->session_price_online . ' ' . $provider->currency : 'N/A' }}</td></tr>
                        <tr><td><strong>In-Person Session:</strong></td><td>{{ $provider->session_price_inperson ? $provider->session_price_inperson . ' ' . $provider->currency : 'N/A' }}</td></tr>
                    </table>
                </div>
            </div>

            @if($provider->availabilities->count())
            <div class="card mb-4">
                <div class="card-header">Availability</div>
                <div class="card-body">
                    <table class="table table-sm">
                        <thead><tr><th>Day</th><th>Time</th><th>Type</th></tr></thead>
                        <tbody>
                            @foreach($provider->availabilities as $avail)
                                <tr>
                                    <td>{{ ucfirst($avail->day_of_week) }}</td>
                                    <td>{{ $avail->start_time?->format('H:i') }} - {{ $avail->end_time?->format('H:i') }}</td>
                                    <td><span class="badge bg-{{ $avail->session_type == 'online' ? 'info' : 'primary' }}">{{ $avail->session_type }}</span></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endif

            @if($provider->reviews->count())
            <div class="card">
                <div class="card-header">Reviews</div>
                <div class="card-body">
                    @foreach($provider->reviews as $review)
                        <div class="mb-3 pb-3 {{ !$loop->last ? 'border-bottom' : '' }}">
                            <div class="mb-1">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="bi bi-star{{ $i <= $review->rating ? '-fill' : '' }} text-warning"></i>
                                @endfor
                            </div>
                            <p class="mb-1">"{{ $review->review_text_en }}"</p>
                            <small class="text-muted">- {{ $review->client_name }}</small>
                        </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
