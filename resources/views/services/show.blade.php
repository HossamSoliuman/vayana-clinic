@extends('layouts.app')

@section('title', $service->localized_name)

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-lg-8">
            @if($service->image)<img src="{{ asset('storage/'.$service->image) }}" class="img-fluid rounded mb-4" alt="{{ $service->localized_name }}">@endif
            <h1>{{ $service->localized_name }}</h1>
            <p class="lead">{{ $service->localized_description }}</p>

            @if($service->therapyPrograms->count())
                <hr class="my-4">
                <h3>{{ __('messages.our_programs') }}</h3>
                <div class="row g-4 mt-2">
                    @foreach($service->therapyPrograms as $program)
                        <div class="col-md-6">
                            <div class="card">
                                @if($program->image)<img src="{{ asset('storage/'.$program->image) }}" class="card-img-top" style="height:150px;object-fit:cover">@endif
                                <div class="card-body">
                                    <h5 class="card-title">{{ $program->localized_name }}</h5>
                                    <p class="text-muted">{{ $program->duration }} | {{ $program->program_type }}</p>
                                    <a href="{{ route('programs.show', $program) }}" class="btn btn-sm btn-outline-primary">{{ __('messages.view_details') }}</a>
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
