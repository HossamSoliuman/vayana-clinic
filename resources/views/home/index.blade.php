@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <div class="container py-5">
        <div class="text-center mb-5">
            <h1>{{ __('messages.welcome') }}</h1>
            <p class="lead">Mental Health & Wellness Platform</p>
            <a href="{{ route('services.index') }}" class="btn btn-primary">{{ __('messages.explore_services') }}</a>
        </div>
        @if ($partners->count())
            <section class="mb-5">
                <h2 class="mb-4">{{ __('messages.our_partners') }}</h2>
                <div class="row g-4 align-items-center">
                    @foreach ($partners as $partner)
                        <div class="col-6 col-md-3 text-center">
                            @if ($partner->logo_path)
                                <a target="_blank" href="{{ $partner->website_url }}">
                                    <img src="{{ asset('storage/' . $partner->logo_path) }}" alt="{{ $partner->name }}"
                                        class="img-fluid" style="max-height:60px">
                                </a>
                            @else
                                <span class="fw-bold">{{ $partner->name }}</span>
                            @endif
                        </div>
                    @endforeach
                </div>
            </section>
        @endif
        @if ($featuredServices->count())
            <section class="mb-5">
                <h2 class="mb-4">{{ __('messages.our_services') }}</h2>
                <div class="row g-4">
                    @foreach ($featuredServices as $service)
                        <div class="col-md-3">
                            <div class="card h-100">
                                @if ($service->image)
                                    <img src="{{ asset('storage/' . $service->image) }}" class="card-img-top"
                                        style="height:150px;object-fit:cover">
                                @endif
                                <div class="card-body">
                                    <h5 class="card-title">{{ $service->localized_name }}</h5>
                                    <p class="card-text">{{ Str::limit($service->localized_description, 80) }}</p>
                                    <a href="{{ route('services.show', $service) }}"
                                        class="btn btn-outline-primary btn-sm">{{ __('messages.learn_more') }}</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="text-center mt-3">
                    <a href="{{ route('services.index') }}"
                        class="btn btn-outline-primary">{{ __('messages.view_all_services') }}</a>
                </div>
            </section>
        @endif

        @if ($featuredProviders->count())
            <section class="mb-5">
                <h2 class="mb-4">{{ __('messages.our_providers') }}</h2>
                <div class="row g-4">
                    @foreach ($featuredProviders as $provider)
                        <div class="col-md-4">
                            <div class="card h-100">
                                @if($provider->photo_path)
                                    <img src="{{ asset('storage/'.$provider->photo_path) }}" class="card-img-top" style="height:200px;object-fit:cover">
                                @else
                                    <div class="card-img-top bg-secondary d-flex align-items-center justify-content-center" style="height:200px">
                                        <i class="bi bi-person-circle text-white" style="font-size: 3rem;"></i>
                                    </div>
                                @endif
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title">{{ $provider->user?->full_name }}</h5>
                                    <p class="text-muted">{{ $provider->title }} |
                                        {{ $provider->specialties->pluck('name_en')->implode(', ') }}</p>
                                    <p class="flex-grow-1">{{ Str::limit($provider->biography_en, 100) }}</p>
                                    <div class="d-flex justify-content-between align-items-center mt-auto">
                                        <span class="badge bg-success">{{ $provider->rating_average }} <i
                                                class="bi bi-star-fill"></i></span>
                                        <a href="{{ route('providers.show', $provider->id) }}"
                                            class="btn btn-sm btn-outline-primary">{{ __('messages.view_profile') }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="text-center mt-3">
                    <a href="{{ route('providers.index') }}"
                        class="btn btn-outline-primary">{{ __('messages.view_all_providers') }}</a>
                </div>
            </section>
        @endif

        @if ($latestResources->count())
            <section class="mb-5">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="mb-0">{{ __('messages.resources') }}</h2>
                    <a href="{{ route('resources.index') }}" class="btn btn-outline-secondary btn-sm">{{ __('messages.view_all') }}</a>
                </div>
                <p class="text-muted mb-4">{{ __('messages.resources_description', ['default' => 'At Vayana, we empower you with tools to understand yourself, manage emotions, and improve your mental well-being. Explore guided meditations, simplified articles, psychometric tests, and self-help books—all curated to support your journey, every day.']) }}</p>

                <!-- Category Filter -->
                <div class="mb-4 d-flex gap-2 flex-wrap" id="categoryFilter">
                    <button class="btn btn-primary btn-sm active category-filter-btn" data-category="all">
                        {{ __('messages.all') }}
                    </button>
                    @foreach ($resourceCategories as $category)
                        <button class="btn btn-outline-primary btn-sm category-filter-btn" data-category="{{ $category->slug }}">
                            {{ $category->localized_name }}
                        </button>
                    @endforeach
                </div>

                <!-- Resources Grid -->
                <div class="row g-4" id="resourcesContainer">
                    @foreach ($latestResources as $resource)
                        <div class="col-md-6 col-lg-4 resource-card">
                            <div class="card h-100 border-0 shadow-sm">
                                @if ($resource->thumbnail_image)
                                    <img src="{{ asset('storage/' . $resource->thumbnail_image) }}" class="card-img-top"
                                        style="height:180px;object-fit:cover">
                                @else
                                    <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height:180px">
                                        <i class="bi bi-book text-muted" style="font-size: 2rem;"></i>
                                    </div>
                                @endif
                                <div class="card-body d-flex flex-column">
                                    <div class="mb-2">
                                        <span class="badge bg-light text-dark">{{ $resource->category?->localized_name ?? ucfirst(str_replace('_', ' ', $resource->type)) }}</span>
                                        @if ($resource->media_duration)
                                            <span class="badge bg-light text-dark ms-1"><i class="bi bi-clock"></i> {{ $resource->media_duration }}</span>
                                        @endif
                                    </div>
                                    <h5 class="card-title">{{ $resource->localized_title }}</h5>
                                    <p class="card-text text-muted small flex-grow-1">
                                        {{ Str::limit($resource->localized_description, 100) }}</p>
                                    <a href="{{ route('resources.show', $resource) }}"
                                        class="btn btn-primary btn-sm mt-auto">{{ __('messages.access_resource', ['default' => 'Access Resource']) }} →</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Loading Indicator -->
                <div id="loadingSpinner" class="text-center mt-4" style="display: none;">
                    <div class="spinner-border" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>

                <div class="text-center mt-4">
                    <a href="{{ route('resources.index') }}" class="btn btn-outline-primary">{{ __('messages.view_all') }}</a>
                </div>
            </section>
        @endif

        @if ($upcomingWorkshops->count())
            <section class="mb-5">
                <h2 class="mb-4">{{ __('messages.upcoming_workshops') }}</h2>
                <div class="row g-4">
                    @foreach ($upcomingWorkshops as $workshop)
                        <div class="col-md-4">
                            <div class="card">
                                @if ($workshop->image)
                                    <img src="{{ asset('storage/' . $workshop->image) }}" class="card-img-top"
                                        style="height:150px;object-fit:cover">
                                @endif
                                <div class="card-body">
                                    <h5 class="card-title">{{ $workshop->localized_title }}</h5>
                                    <p class="text-muted"><i class="bi bi-calendar"></i>
                                        {{ $workshop->date_time?->format('M d, Y') ?? 'TBA' }}</p>
                                    <p class="text-muted"><i class="bi bi-geo-alt"></i> {{ $workshop->location }}</p>
                                    <a href="{{ route('workshops.show', $workshop) }}"
                                        class="btn btn-outline-primary btn-sm">{{ __('messages.register_interest') }}</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif

        @if ($featuredReviews->count())
            <section class="mb-5">
                <h2 class="mb-4">{{ __('messages.client_reviews') }}</h2>
                <div class="row g-4">
                    @foreach ($featuredReviews as $review)
                        <div class="col-md-4">
                            <div class="card bg-light">
                                <div class="card-body">
                                    <div class="mb-2">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <i
                                                class="bi bi-star{{ $i <= $review->rating ? '-fill' : '' }} text-warning"></i>
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

        @if ($journalPrompts->count())
            <section class="mb-5">
                <h2 class="mb-4">{{ __('messages.journal') }}</h2>
                <div class="row g-4">
                    @foreach ($journalPrompts as $prompt)
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <span class="badge bg-secondary mb-2">{{ ucfirst($prompt->category) }}</span>
                                    <h5 class="card-title">{{ $prompt->localized_text }}</h5>
                                    <p class="text-muted text-sm">{{ __('messages.journal') }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="text-center mt-3">
                    @auth
                        <a href="{{ route('journal.index') }}"
                            class="btn btn-outline-primary">{{ __('messages.my_journal') }}</a>
                    @else
                        <a href="{{ route('register') }}" class="btn btn-outline-primary">{{ __('messages.register') }}</a>
                    @endauth
                </div>
            </section>
        @endif

        @if ($moodInsights->count())
            <section class="mb-5">
                <h2 class="mb-4">{{ __('messages.mood_tracker') }}</h2>
                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title mb-3">Recent Mood Entries</h5>
                                <div class="list-group list-group-flush">
                                    @foreach ($moodInsights->take(4) as $mood)
                                        <div class="list-group-item d-flex justify-content-between align-items-center">
                                            <div>
                                                <p class="mb-1">{{ $mood->mood_label ?? 'Mood Entry' }}</p>
                                                <small
                                                    class="text-muted">{{ $mood->entry_date?->format('M d, Y') }}</small>
                                            </div>
                                            <div>
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <i class="bi bi-heart{{ $i <= $mood->mood_score ? '-fill' : '' }} text-danger"
                                                        style="font-size: 0.8rem;"></i>
                                                @endfor
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                @auth
                                    <a href="{{ route('mood-tracker.index') }}"
                                        class="btn btn-outline-primary btn-sm mt-3">{{ __('messages.view_details') }}</a>
                                @endauth
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title mb-3">Mood Insights</h5>
                                @auth
                                    @php
                                        $thisWeekMoods = $moodInsights->whereBetween('entry_date', [
                                            now()->startOfWeek(),
                                            now()->endOfWeek(),
                                        ]);
                                        $thisMonthMoods = $moodInsights
                                            ->whereMonth('entry_date', now()->month)
                                            ->whereYear('entry_date', now()->year);
                                        $avgWeek = $thisWeekMoods->avg('mood_score');
                                        $avgMonth = $thisMonthMoods->avg('mood_score');
                                    @endphp
                                    <div class="mb-3">
                                        <p class="mb-1"><strong>This Week Average</strong></p>
                                        <div class="progress" style="height: 20px;">
                                            <div class="progress-bar bg-info" role="progressbar"
                                                style="width: {{ ($avgWeek / 5) * 100 }}%;"
                                                aria-valuenow="{{ $avgWeek }}" aria-valuemin="0" aria-valuemax="5">
                                                {{ round($avgWeek, 1) ?? 'N/A' }}</div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <p class="mb-1"><strong>This Month Average</strong></p>
                                        <div class="progress" style="height: 20px;">
                                            <div class="progress-bar bg-warning" role="progressbar"
                                                style="width: {{ ($avgMonth / 5) * 100 }}%;"
                                                aria-valuenow="{{ $avgMonth }}" aria-valuemin="0" aria-valuemax="5">
                                                {{ round($avgMonth, 1) ?? 'N/A' }}</div>
                                        </div>
                                    </div>
                                    <a href="{{ route('mood-tracker.index') }}"
                                        class="btn btn-outline-primary btn-sm">{{ __('messages.track_mood') }}</a>
                                @else
                                    <p class="text-muted">{{ __('messages.login') }} to track your mood and get insights.</p>
                                    <a href="{{ route('login') }}"
                                        class="btn btn-outline-primary btn-sm">{{ __('messages.login') }}</a>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endif
    </div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const categoryButtons = document.querySelectorAll('.category-filter-btn');
        const resourcesContainer = document.getElementById('resourcesContainer');
        const loadingSpinner = document.getElementById('loadingSpinner');

        categoryButtons.forEach(button => {
            button.addEventListener('click', function () {
                const category = this.getAttribute('data-category');

                // Update active button state
                categoryButtons.forEach(btn => btn.classList.remove('active'));
                this.classList.add('active');
                if (category !== 'all') {
                    this.classList.remove('btn-outline-primary');
                    this.classList.add('btn-primary');
                } else {
                    this.classList.remove('btn-outline-primary');
                    this.classList.add('btn-primary');
                }

                // Show loading spinner
                loadingSpinner.style.display = 'block';
                resourcesContainer.style.opacity = '0.5';

                // Fetch resources
                fetch(`{{ route('api.resources.by-category') }}?category=${category}&limit=6`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            renderResources(data.resources);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    })
                    .finally(() => {
                        loadingSpinner.style.display = 'none';
                        resourcesContainer.style.opacity = '1';
                    });
            });
        });

        function renderResources(resources) {
            resourcesContainer.innerHTML = '';

            if (resources.length === 0) {
                resourcesContainer.innerHTML = '<div class="col-12 text-center text-muted">No resources found.</div>';
                return;
            }

            resources.forEach(resource => {
                const resourceCard = document.createElement('div');
                resourceCard.className = 'col-md-6 col-lg-4 resource-card';

                const thumbnailHtml = resource.thumbnail
                    ? `<img src="${resource.thumbnail}" class="card-img-top" style="height:180px;object-fit:cover">`
                    : `<div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height:180px">
                        <i class="bi bi-book text-muted" style="font-size: 2rem;"></i>
                    </div>`;

                resourceCard.innerHTML = `
                    <div class="card h-100 border-0 shadow-sm">
                        ${thumbnailHtml}
                        <div class="card-body d-flex flex-column">
                            <div class="mb-2">
                                <span class="badge bg-light text-dark">${resource.category}</span>
                                ${resource.duration ? `<span class="badge bg-light text-dark ms-1"><i class="bi bi-clock"></i> ${resource.duration}</span>` : ''}
                            </div>
                            <h5 class="card-title">${resource.title}</h5>
                            <p class="card-text text-muted small flex-grow-1">${resource.description}</p>
                            <a href="/resources/${resource.slug}" class="btn btn-primary btn-sm mt-auto">{{ __('messages.access_resource', ['default' => 'Access Resource']) }} →</a>
                        </div>
                    </div>
                `;

                resourcesContainer.appendChild(resourceCard);
            });
        }
    });
</script>
@endpush
