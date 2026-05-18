@extends('layouts.app')

@section('title', __('messages.about'))

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <h1>{{ __('messages.about') }}</h1>
            <p class="lead">Vayana is a licensed bilingual mental health and wellness platform, officially recognized by the Saudi Ministry of Health.</p>
            <p>We connect clients with certified mental health professionals and provide self-guided wellness tools including therapy services, curated resource libraries, therapy programs, workshops, and corporate wellness solutions.</p>
            <p>Our platform is fully bilingual (Arabic/English) and designed to serve the unique needs of the Saudi community.</p>
            <div class="mt-4">
                <a href="{{ route('services.index') }}" class="btn btn-primary me-2">{{ __('messages.our_services') }}</a>
                <a href="{{ route('providers.index') }}" class="btn btn-outline-primary">{{ __('messages.our_providers') }}</a>
            </div>
        </div>
    </div>
</div>
@endsection
