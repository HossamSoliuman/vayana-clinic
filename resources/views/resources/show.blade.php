@extends('layouts.app')

@section('title', $resource->localized_title)

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            @if($resource->thumbnail_image)<img src="{{ asset('storage/'.$resource->thumbnail_image) }}" class="img-fluid rounded mb-4">@endif
            <span class="badge bg-primary">{{ $resource->type }}</span>
            @if($resource->category)<span class="badge bg-secondary">{{ $resource->category->localized_name }}</span>@endif
            <h1 class="mt-3">{{ $resource->localized_title }}</h1>
            <p class="text-muted">{{ $resource->localized_description }}</p>
            @if($resource->media_url)
                <div class="mb-4">
                    @if($resource->type == 'video')
                        <div class="ratio ratio-16x9"><iframe src="{{ $resource->media_url }}" allowfullscreen></iframe></div>
                    @else
                        <audio controls class="w-100"><source src="{{ $resource->media_url }}"></audio>
                    @endif
                </div>
            @endif
            @if($resource->localized_content)
                <div class="content">{!! nl2br(e($resource->localized_content)) !!}</div>
            @endif
            @if($resource->file_path)
                <a href="{{ asset('storage/'.$resource->file_path) }}" class="btn btn-primary" download><i class="bi bi-download"></i> Download</a>
            @endif
            @if($resource->external_link)
                <a href="{{ $resource->external_link }}" target="_blank" class="btn btn-outline-primary"><i class="bi bi-box-arrow-up-right"></i> External Link</a>
            @endif

            @if($relatedResources->count())
                <hr class="my-5">
                <h3>Related Resources</h3>
                <div class="row g-4 mt-2">
                    @foreach($relatedResources as $rr)
                        <div class="col-md-6">
                            <div class="card">
                                @if($rr->thumbnail_image)<img src="{{ asset('storage/'.$rr->thumbnail_image) }}" class="card-img-top" style="height:120px;object-fit:cover">@endif
                                <div class="card-body">
                                    <h6>{{ $rr->localized_title }}</h6>
                                    <a href="{{ route('resources.show', $rr) }}" class="btn btn-sm btn-outline-primary">View</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
