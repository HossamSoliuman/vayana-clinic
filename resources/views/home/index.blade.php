@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div class="container py-5">
    <div class="text-center mb-5">
        <h1>{{ __('messages.welcome') }}</h1>
        <p class="lead">Mental Health & Wellness Platform</p>
        <a href="{{ route('services.index') }}" class="btn btn-primary">{{ __('messages.explore_services') }}</a>
    </div>

    @if($featuredServices->count())
    <section class="mb-5">
        <h2 class="mb-4">{{ __('messages.our_services') }}</h2>
        <div class="row g-4">
            @foreach($featuredServices as $service)
                <div class="col-md-3">
                    <div class="card h-100">
                        @if($service->image)<img src="{{ asset('storage/'.$service->image) }}" class="card-img-top" style="height:150px;object-fit:cover">@endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $service->localized_name }}</h5>
                            <p class="card-text">{{ Str::limit($service->localized_description, 80) }}</p>
                            <a href="{{ route('services.show', $service) }}" class="btn btn-outline-primary btn-sm">{{ __('messages.learn_more') }}</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="text-center mt-3">
            <a href="{{ route('services.index') }}" class="btn btn-outline-primary">{{ __('messages.view_all_services') }}</a>
        </div>
    </section>
    @endif

    @if($featuredProviders->count())
    <section class="mb-5">
        <h2 class="mb-4">{{ __('messages.our_providers') }}</h2>
        <div class="row g-4">
            @foreach($featuredProviders as $provider)
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $provider->user?->full_name }}</h5>
                            <p class="text-muted">{{ $provider->title }} | {{ $provider->specialties->pluck('name_en')->implode(', ') }}</p>
                            <p>{{ Str::limit($provider->biography_en, 100) }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="badge bg-success">{{ $provider->rating_average }} <i class="bi bi-star-fill"></i></span>
                                <a href="{{ route('providers.show', $provider->id) }}" class="btn btn-sm btn-outline-primary">{{ __('messages.view_profile') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="text-center mt-3">
            <a href="{{ route('providers.index') }}" class="btn btn-outline-primary">{{ __('messages.view_all_providers') }}</a>
        </div>
    </section>
    @endif

    @if($upcomingWorkshops->count())
    <section class="mb-5">
        <h2 class="mb-4">{{ __('messages.upcoming_workshops') }}</h2>
        <div class="row g-4">
            @foreach($upcomingWorkshops as $workshop)
                <div class="col-md-4">
                    <div class="card">
                        @if($workshop->image)<img src="{{ asset('storage/'.$workshop->image) }}" class="card-img-top" style="height:150px;object-fit:cover">@endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $workshop->localized_title }}</h5>
                            <p class="text-muted"><i class="bi bi-calendar"></i> {{ $workshop->date_time?->format('M d, Y') ?? 'TBA' }}</p>
                            <p class="text-muted"><i class="bi bi-geo-alt"></i> {{ $workshop->location }}</p>
                            <a href="{{ route('workshops.show', $workshop) }}" class="btn btn-outline-primary btn-sm">{{ __('messages.register_interest') }}</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
    @endif

    @if($featuredReviews->count())
    <section class="mb-5">
        <h2 class="mb-4">{{ __('messages.client_reviews') }}</h2>
        <div class="row g-4">
            @foreach($featuredReviews as $review)
                <div class="col-md-4">
                    <div class="card bg-light">
                        <div class="card-body">
                            <div class="mb-2">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="bi bi-star{{ $i <= $review->rating ? '-fill' : '' }} text-warning"></i>
                                @endfor
                            </div>
                            <p class="card-text">"{{ $review->review_text_en }}"</p>
                            <p class="text-muted mb-0">- {{ $review->client_name }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
    @endif

    @if($partners->count())
    <section class="mb-5">
        <h2 class="mb-4">{{ __('messages.our_partners') }}</h2>
        <div class="row g-4 align-items-center">
            @foreach($partners as $partner)
                <div class="col-6 col-md-3 text-center">
                    @if($partner->logo_path)
                        <img src="{{ asset('storage/'.$partner->logo_path) }}" alt="{{ $partner->name }}" class="img-fluid" style="max-height:60px">
                    @else
                        <span class="fw-bold">{{ $partner->name }}</span>
                    @endif
                </div>
            @endforeach
        </div>
    </section>
    @endif
</div>
@endsection
