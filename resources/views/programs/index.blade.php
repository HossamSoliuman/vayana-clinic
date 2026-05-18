@extends('layouts.app')

@section('title', __('messages.programs'))

@section('content')
<div class="container py-5">
    <h1 class="mb-4">{{ __('messages.our_programs') }}</h1>
    <div class="row g-4">
        @forelse($programs as $program)
            <div class="col-md-4">
                <div class="card h-100">
                    @if($program->image)<img src="{{ asset('storage/'.$program->image) }}" class="card-img-top" style="height:180px;object-fit:cover">@endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $program->localized_name }}</h5>
                        <p class="text-muted">{{ $program->duration }} | {{ $program->program_type }} | {{ $program->level ?? 'All Levels' }}</p>
                        <p>{{ Str::limit($program->description_en, 100) }}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="fw-bold">{{ $program->full_program_price ?? $program->price_per_session ?? 'Contact us' }} {{ $program->currency }}</span>
                            <a href="{{ route('programs.show', $program) }}" class="btn btn-outline-primary btn-sm">{{ __('messages.view_details') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center text-muted">No programs available.</div>
        @endforelse
    </div>
    <div class="mt-4">{{ $programs->links() }}</div>
</div>
@endsection
