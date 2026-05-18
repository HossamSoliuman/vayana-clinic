@extends('layouts.app')

@section('title', __('messages.services'))

@section('content')
<div class="container py-5">
    <h1 class="mb-4">{{ __('messages.our_services') }}</h1>
    <div class="row g-4">
        @forelse($services as $service)
            <div class="col-md-6">
                <div class="card h-100">
                    @if($service->image)<img src="{{ asset('storage/'.$service->image) }}" class="card-img-top" style="height:200px;object-fit:cover">@endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $service->localized_name }}</h5>
                        <p class="card-text">{{ $service->localized_description }}</p>
                        <a href="{{ route('services.show', $service) }}" class="btn btn-outline-primary">{{ __('messages.learn_more') }}</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center text-muted">No services available.</div>
        @endforelse
    </div>
</div>
@endsection
