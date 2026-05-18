@extends('layouts.app')

@section('title', __('messages.workshops'))

@section('content')
<div class="container py-5">
    <h1 class="mb-4">{{ __('messages.workshops') }}</h1>
    <div class="row g-4">
        @forelse($workshops as $workshop)
            <div class="col-md-4">
                <div class="card h-100">
                    @if($workshop->image)<img src="{{ asset('storage/'.$workshop->image) }}" class="card-img-top" style="height:180px;object-fit:cover">@endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $workshop->localized_title }}</h5>
                        <p class="text-muted">
                            <i class="bi bi-calendar"></i> {{ $workshop->date_time?->format('M d, Y h:i A') ?? 'TBA' }}<br>
                            <i class="bi bi-geo-alt"></i> {{ $workshop->location }}<br>
                            <i class="bi bi-clock"></i> {{ $workshop->duration ?? 'N/A' }}
                        </p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="fw-bold">{{ $workshop->price ? $workshop->price . ' ' . $workshop->currency : __('messages.free') }}</span>
                            @if($workshop->is_registration_open)
                                <a href="{{ route('workshops.show', $workshop) }}" class="btn btn-primary btn-sm">{{ __('messages.register_interest') }}</a>
                            @else
                                <span class="badge bg-secondary">Closed</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center text-muted">No workshops available.</div>
        @endforelse
    </div>
    <div class="mt-4">{{ $workshops->links() }}</div>
</div>
@endsection
