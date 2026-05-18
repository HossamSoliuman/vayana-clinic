@extends('layouts.app')

@section('title', __('messages.providers'))

@section('content')
<div class="container py-5">
    <h1 class="mb-4">{{ __('messages.our_providers') }}</h1>

    <div class="card mb-4">
        <div class="card-body">
            <form method="GET" class="row g-3">
                <div class="col-md-3"><input type="text" name="search" class="form-control" placeholder="Search..." value="{{ $filters['search'] ?? '' }}"></div>
                <div class="col-md-2">
                    <select name="specialty" class="form-select">
                        <option value="">All Specialties</option>
                        @foreach($specialties as $s)<option value="{{ $s->slug }}" {{ ($filters['specialty'] ?? '') == $s->slug ? 'selected' : '' }}>{{ $s->name_en }}</option>@endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="language" class="form-select">
                        <option value="">All Languages</option>
                        <option value="arabic" {{ ($filters['language'] ?? '') == 'arabic' ? 'selected' : '' }}>Arabic</option>
                        <option value="english" {{ ($filters['language'] ?? '') == 'english' ? 'selected' : '' }}>English</option>
                        <option value="french" {{ ($filters['language'] ?? '') == 'french' ? 'selected' : '' }}>French</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="work_type" class="form-select">
                        <option value="">All Types</option>
                        <option value="online" {{ ($filters['work_type'] ?? '') == 'online' ? 'selected' : '' }}>Online</option>
                        <option value="in_person" {{ ($filters['work_type'] ?? '') == 'in_person' ? 'selected' : '' }}>In-Person</option>
                        <option value="hybrid" {{ ($filters['work_type'] ?? '') == 'hybrid' ? 'selected' : '' }}>Hybrid</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="sort" class="form-select">
                        <option value="">Sort By</option>
                        <option value="rating" {{ ($filters['sort'] ?? '') == 'rating' ? 'selected' : '' }}>Rating</option>
                        <option value="price_asc" {{ ($filters['sort'] ?? '') == 'price_asc' ? 'selected' : '' }}>Price: Low to High</option>
                        <option value="price_desc" {{ ($filters['sort'] ?? '') == 'price_desc' ? 'selected' : '' }}>Price: High to Low</option>
                        <option value="experience" {{ ($filters['sort'] ?? '') == 'experience' ? 'selected' : '' }}>Experience</option>
                    </select>
                </div>
                <div class="col-md-1"><button type="submit" class="btn btn-primary w-100"><i class="bi bi-search"></i></button></div>
            </form>
        </div>
    </div>

    <div class="row g-4">
        @forelse($providers as $provider)
            <div class="col-md-4">
                <div class="card h-100">
                    <div class="card-body">
                        @if($provider->is_featured)<span class="badge bg-warning text-dark position-absolute top-0 end-0 m-2">Featured</span>@endif
                        <h5 class="card-title">{{ $provider->title }} {{ $provider->user?->full_name }}</h5>
                        <p class="text-muted small">{{ $provider->specialties->pluck('name_en')->implode(', ') }}</p>
                        <p>{{ Str::limit($provider->biography_en, 100) }}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span><i class="bi bi-star-fill text-warning"></i> {{ $provider->rating_average }} ({{ $provider->rating_count }})</span>
                            <span class="text-muted">{{ $provider->years_of_experience }} yrs exp</span>
                        </div>
                        <div class="mt-2">
                            <span class="badge bg-info">{{ $provider->work_type }}</span>
                            @foreach($provider->languages as $lang)<span class="badge bg-secondary">{{ $lang->language }}</span>@endforeach
                        </div>
                        <a href="{{ route('providers.show', $provider->id) }}" class="btn btn-outline-primary btn-sm mt-3">{{ __('messages.view_profile') }}</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center text-muted">No providers found.</div>
        @endforelse
    </div>
    <div class="mt-4">{{ $providers->links() }}</div>
</div>
@endsection
