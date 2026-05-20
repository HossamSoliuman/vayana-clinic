@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <div class="home" data-page="home">
        <section class="home-hero" aria-label="Hero">
            <div class="home-container home-hero__grid">
                <div class="home-hero__content" data-reveal>
                    <p class="home-hero__kicker">Start your wellness journey</p>
                    <h1 class="home-hero__title">
                        For every stable mind... a sanctuary. Your journey toward <span class="home-hero__title-highlight">tranquility starts here.</span>
                    </h1>
                    <p class="home-hero__subtitle">
                        Access professional psychological care from trusted, certified therapists—anytime, anywhere.
                    </p>

                    <div class="home-hero__cta">
                        <a class="home-btn home-btn--primary" href="{{ route('services.index') }}">
                            Book Instant Session
                            <span aria-hidden="true" class="home-btn__icon">→</span>
                        </a>

                        <a class="store-badge" href="#" aria-label="Get it on Google Play">
                            <span class="store-badge__icon" aria-hidden="true">
                            <img src="{{ asset('images/home/google_play.png') }}" alt="google paly" loading="lazy" decoding="async">
                            </span>
                            <span class="store-badge__text">
                                <span class="store-badge__small">GET IT ON</span>
                                <span class="store-badge__big">Google Play</span>
                            </span>
                        </a>

                        <a class="store-badge" href="#" aria-label="Download on the App Store">
                            <span class="store-badge__icon" aria-hidden="true">
                                <img src="{{ asset('images/home/apple.png') }}" alt="Apple" loading="lazy" decoding="async">
                            </span>
                            <span class="store-badge__text">
                                <span class="store-badge__small">Download on the</span>
                                <span class="store-badge__big">App Store</span>
                            </span>
                        </a>
                    </div>
                </div>

                <div class="home-hero__visual" aria-hidden="true" data-reveal>
                     <img src="{{ asset('images/home/Phone.png') }}" alt="Phone" loading="lazy" decoding="async">
                </div>

            </div>
        </section>

        @if ($partners->count())
            <section class="home-strip" aria-label="Partners">
                <div class="home-container">
                    <div class="home-strip__row">
                        @foreach ($partners as $partner)
                            <div class="home-strip__item">
                                @if ($partner->logo_path)
                                    <a target="_blank" rel="noreferrer" href="{{ $partner->website_url }}">
                                        <img src="{{ asset('storage/' . $partner->logo_path) }}" alt="{{ $partner->name }}" loading="lazy" decoding="async">
                                    </a>
                                @else
                                    <span class="home-strip__text">{{ $partner->name }}</span>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

        @if ($featuredServices->count())
            <section style="background-image: url('{{ asset('images/services-BG.png') }}'); background-size: cover; background-position: center;background-repeat: no-repeat;" class="home-section" id="services" aria-label="Services">
                <div class="home-container">
                    <header class="home-section__head">

                            <div class="section-header">
                            <h2 class="home-h2">Services</h2>
                            <div class="header-line"></div>
                            </div>
                            <p class="home-p">
                                At Vayana we offer a comprehensive selection of psychological services tailored to your unique needs—from therapy sessions to personal growth programs. Wherever you are, whenever you need it, we’re here to walk with you toward inner peace.
                            </p>

                    </header>

                    <div class="home-carousel" data-carousel="services">
                    <div class="w-full flex justify-end">
                    <a class="home-link" href="{{ route('services.index') }}">View All <span aria-hidden="true">→</span></a>
                    </div>

                        <div class="home-carousel__track" role="list">
                            @foreach ($featuredServices as $service)
                                <article class="svc-card" href="{{ route('services.show', $service) }}" role="listitem" data-reveal>
                                    <div class="svc-card__icon" aria-hidden="true"><i class="bi bi-brain"></i></div>
                                    <h3 class="svc-card__title">{{ $service->localized_name }}</h3>
                                    <p class="svc-card__text">{{ Str::limit($service->localized_description, 120) }}</p>
                                </article>
                            @endforeach
                        </div>
                    </div>
                </div>
            </section>
        @endif

        @if ($featuredProviders->count())
            <section class="home-feature" aria-label="Featured Therapist">
                <div class="home-container">
                <header class="home-section__head">
                    <div class="section-header">
                            <h2 class="home-h2">Featured Therapist</h2>
                            <div class="header-line"></div>
                            </div>
                        <p class="home-p">At Vayana we believe your journey to balance begins  with the right choice. Explore a carefully selected team  of certified psychologists and psychiatrists, and start  your healing journey with confidence. Browse expert profiles and book  the session that fits your needs.</p>
                </header>
                <div class="w-full flex justify-end">
                    <a class="home-link" href="{{ route('services.index') }}">View All <span aria-hidden="true">→</span></a>
                    </div>
                    <div class="home-feature__cards">

                        @foreach ($featuredProviders->take(1) as $provider)
                            <article class="pro-card" data-reveal>
                                <div class="pro-card__media">
                                    @if ($provider->photo_path)
                                        <img src="{{ asset('storage/' . $provider->photo_path) }}" alt="{{ $provider->user?->full_name }}" loading="lazy" decoding="async">
                                    @else
                                        <div class="pro-card__placeholder" aria-hidden="true"><i class="bi bi-person-circle"></i></div>
                                    @endif
                                </div>
                                <div class="pro-card__body">
                                    <div class="pro-card__top">
                                        <div>
                                            <h3 class="pro-card__name">{{ $provider->user?->full_name }}</h3>
                                            <p class="pro-card__meta">{{ $provider->title }}</p>
                                        </div>
                                        <div class="pro-card__rating"><i class="bi bi-star-fill"></i> <span>{{ $provider->rating_average }}</span></div>
                                    </div>
                                    <p class="pro-card__bio">{{ Str::limit($provider->biography_en, 140) }}</p>
                                    <a class="home-btn home-btn--primary home-btn--sm" href="{{ route('providers.show', $provider->id) }}">View Profile <span aria-hidden="true">→</span></a>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

        @if ($latestResources->count())
            <section style="background-image: url('{{ asset('images/resources-bg.png') }}'); background-size: cover; background-position: center;background-repeat: no-repeat;" class="home-section home-section--dark" id="resources" aria-label="Resources">
                <div class="home-container">
                    <header class="home-section__head home-section__head--light">

                        <div class="section-header">
                            <h2 class="home-h2 home-h2--light">Resources</h2>
                            <div class="header-line header-line-light"></div>
                            </div>
                            <p class="home-p home-p--light">
                                At Vayana, we empower you with tools to understand yourself, manage emotions, and improve your mental well-being. Explore guided meditations, simplified articles, psychometric tests, and self-help books—all curated to support your journey, every day.
                            </p>

                    </header>


                    <div class="home-tabs" id="categoryFilter" role="tablist" aria-label="Resource categories">
                        <button class="home-tab is-active category-filter-btn" type="button" data-category="all" role="tab" aria-selected="true">All</button>
                        @foreach ($resourceCategories as $category)
                            <button class="home-tab category-filter-btn" type="button" data-category="{{ $category->slug }}" role="tab" aria-selected="false">{{ $category->localized_name }}</button>
                        @endforeach
                    </div>
                    <div class="w-full flex justify-end">
                    <a class="home-link home-link--light" href="{{ route('resources.index') }}">View All <span aria-hidden="true">→</span></a>
                    </div>
                    <div class="home-grid" id="resourcesContainer" data-endpoint="{{ route('api.resources.by-category') }}">

                        @foreach ($latestResources as $resource)
                            <article class="res-card resource-card" data-reveal>
                                <div class="res-card__media">
                                    @if ($resource->thumbnail_image)
                                        <img src="{{ asset('storage/' . $resource->thumbnail_image) }}" alt="{{ $resource->localized_title }}" loading="lazy" decoding="async">
                                    @else
                                        <div class="res-card__placeholder" aria-hidden="true"><i class="bi bi-book"></i></div>
                                    @endif
                                    <div class="res-card__chips">
                                        <span class="chip">{{ $resource->category?->localized_name ?? ucfirst(str_replace('_', ' ', $resource->type)) }}</span>
                                        @if ($resource->media_duration)
                                            <span class="chip"><i class="bi bi-clock"></i> {{ $resource->media_duration }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="res-card__body">
                                    <h3 class="res-card__title">{{ $resource->localized_title }}</h3>
                                    <p class="res-card__text">{{ Str::limit($resource->localized_description, 120) }}</p>
                                    <a class="res-card-btn" href="{{ route('resources.show', $resource) }}">Access resource <span aria-hidden="true">→</span></a>
                                </div>
                            </article>
                        @endforeach
                    </div>

                    <div id="loadingSpinner" class="home-loading" style="display:none" aria-live="polite">
                        <span class="home-loading__dot"></span><span class="home-loading__dot"></span><span class="home-loading__dot"></span>
                    </div>
                </div>
            </section>
        @endif

        <section class="home-section" id="journal" aria-label="Journal and insights">
            <div class="home-container">
                <header class="home-section__head">
                <div class="section-header">
                            <h2 class="home-h2">Journal &amp; Insights</h2>
                            <div class="header-line"></div>
                            </div>
                    <div>

                        <p class="home-p">Track your progress, reflect daily, and unlock insights.</p>
                    </div>

                </header>
                 @auth
                 <div class="w-full flex justify-end">
                        <a class="home-link" href="{{ route('journal.index') }}">View All <span aria-hidden="true">→</span></a>
                 </div>
                    @else
                        <a class="home-link" href="{{ route('login') }}">Login <span aria-hidden="true">→</span></a>
                    @endauth
                <div class="home-grid home-grid--2">

                    @if ($journalPrompts->count())
                        @foreach ($journalPrompts->take(2) as $prompt)
                            <article class="ins-card" data-reveal>
                                <div class="ins-card__icon" aria-hidden="true"><i class="bi bi-journal-text"></i></div>
                                <div class="ins-card__body">
                                    <h3 class="ins-card__title">{{ $prompt->localized_text }}</h3>
                                    <p class="ins-card__text">Daily prompts &amp; exercises</p>
                                    @auth
                                        <a class="home-btn home-btn--primary home-btn--sm" href="{{ route('journal.index') }}">Start Tracking</a>
                                    @else
                                        <a class="home-btn home-btn--primary home-btn--sm" href="{{ route('register') }}">Register</a>
                                    @endauth
                                </div>
                            </article>
                        @endforeach
                    @else
                        <article class="ins-card" data-reveal>
                            <div class="ins-card__icon" aria-hidden="true"><i class="bi bi-journal-text"></i></div>
                            <div class="ins-card__body">
                                <h3 class="ins-card__title">Your private journal</h3>
                                <p class="ins-card__text">Daily prompts &amp; exercises</p>
                                <a class="home-btn home-btn--primary home-btn--sm" href="{{ route('register') }}">Start Tracking</a>
                            </div>
                        </article>
                    @endif

                    <article class="ins-card" data-reveal>
                        <div class="ins-card__icon" aria-hidden="true"><i class="bi bi-activity"></i></div>
                        <div class="ins-card__body">
                            <h3 class="ins-card__title">Mood Tracker</h3>
                            <p class="ins-card__text">See patterns, trends, and progress insights.</p>
                            @auth
                                <a class="home-btn home-btn--primary home-btn--sm" href="{{ route('mood-tracker.index') }}">Start Tracking</a>
                            @else
                                <a class="home-btn home-btn--primary home-btn--sm" href="{{ route('login') }}">Login</a>
                            @endauth
                        </div>
                    </article>
                </div>
            </div>
        </section>

        @if ($featuredReviews->count())
            <section class="home-section" aria-label="Client reviews">
                <div class="home-container">
                    <header class="home-section__head">
                        <div>
                            <h2 class="home-h2">Client Reviews</h2>
                            <p class="home-p">Loved by people who prioritize their wellbeing.</p>
                        </div>
                    </header>

                    <div class="home-grid home-grid--3">
                        @foreach ($featuredReviews->take(3) as $review)
                            <article class="rev-card" data-reveal>
                                <div class="rev-card__stars" aria-label="{{ $review->rating }} out of 5 stars">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <i class="bi bi-star{{ $i <= $review->rating ? '-fill' : '' }}"></i>
                                    @endfor
                                </div>
                                <p class="rev-card__text">“{{ $review->review_text_en }}”</p>
                                <p class="rev-card__name">— {{ $review->client_name }}</p>
                            </article>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

    </div>
@endsection
