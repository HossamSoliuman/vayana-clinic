@extends('layouts.app')

@section('title', __('messages.resources'))

@section('content')
<div class="container py-5">
    <h1 class="mb-4">{{ __('messages.resources') }}</h1>
    <form method="GET" class="row g-3 mb-4">
        <div class="col-md-4">
            <select name="type" class="form-select" onchange="this.form.submit()">
                <option value="">All Types</option>
                <option value="blog_article" {{ request('type')=='blog_article'?'selected':'' }}>Articles</option>
                <option value="audio" {{ request('type')=='audio'?'selected':'' }}>Audio</option>
                <option value="self_help_ebook" {{ request('type')=='self_help_ebook'?'selected':'' }}>eBooks</option>
                <option value="video" {{ request('type')=='video'?'selected':'' }}>Videos</option>
                <option value="guided_meditation" {{ request('type')=='guided_meditation'?'selected':'' }}>Meditations</option>
                <option value="mental_health_conversation" {{ request('type')=='mental_health_conversation'?'selected':'' }}>Conversations</option>
                <option value="assessment" {{ request('type')=='assessment'?'selected':'' }}>Assessments</option>
            </select>
        </div>
        <div class="col-md-4">
            <select name="category" class="form-select" onchange="this.form.submit()">
                <option value="">All Categories</option>
                @foreach($categories as $c)
                    <option value="{{ $c->slug }}" {{ request('category')==$c->slug?'selected':'' }}>{{ $c->localized_name }}</option>
                @endforeach
            </select>
        </div>
    </form>
    <div class="row g-4">
        @forelse($resources as $resource)
            <div class="col-md-4">
                <div class="card h-100">
                    @if($resource->thumbnail_image)<img src="{{ asset('storage/'.$resource->thumbnail_image) }}" class="card-img-top" style="height:160px;object-fit:cover">@endif
                    <div class="card-body">
                        <span class="badge bg-{{ $resource->type == 'blog_article' ? 'primary' : ($resource->type == 'video' ? 'danger' : ($resource->type == 'audio' ? 'info' : 'secondary')) }} mb-2">{{ $resource->type }}</span>
                        @if($resource->is_featured)<span class="badge bg-warning text-dark">Featured</span>@endif
                        @if($resource->is_new)<span class="badge bg-success">New</span>@endif
                        <h5 class="card-title">{{ $resource->localized_title }}</h5>
                        <p>{{ Str::limit($resource->localized_description, 80) }}</p>
                        <div class="d-flex justify-content-between">
                            <small class="text-muted"><i class="bi bi-eye"></i> {{ $resource->view_count }}</small>
                            <a href="{{ route('resources.show', $resource) }}" class="btn btn-sm btn-outline-primary">{{ __('messages.read_more') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center text-muted">No resources found.</div>
        @endforelse
    </div>
    <div class="mt-4">{{ $resources->links() }}</div>
</div>
@endsection
