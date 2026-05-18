@extends('layouts.app')

@section('title', $program->localized_name)

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-lg-8">
            @if($program->image)<img src="{{ asset('storage/'.$program->image) }}" class="img-fluid rounded mb-4">@endif
            <h1>{{ $program->localized_name }}</h1>
            <div class="mb-3">
                <span class="badge bg-primary">{{ $program->program_type }}</span>
                @if($program->level)<span class="badge bg-info">{{ $program->level }}</span>@endif
                @if($program->is_featured)<span class="badge bg-warning text-dark">Featured</span>@endif
            </div>
            <p class="lead">{{ $program->description_en }}</p>
            <table class="table table-borderless">
                <tr><td><strong>Duration:</strong></td><td>{{ $program->duration ?? 'N/A' }}</td></tr>
                <tr><td><strong>Sessions:</strong></td><td>{{ $program->session_count ?? 'N/A' }}</td></tr>
                <tr><td><strong>Max Participants:</strong></td><td>{{ $program->max_participants ?? 'N/A' }}</td></tr>
                <tr><td><strong>Price per Session:</strong></td><td>{{ $program->price_per_session ? $program->price_per_session . ' ' . $program->currency : 'N/A' }}</td></tr>
                <tr><td><strong>Full Program Price:</strong></td><td>{{ $program->full_program_price ? $program->full_program_price . ' ' . $program->currency : 'N/A' }}</td></tr>
                <tr><td><strong>Dates:</strong></td><td>{{ $program->start_date?->format('M d, Y') ?? 'TBA' }} @if($program->end_date) to {{ $program->end_date->format('M d, Y') }} @endif</td></tr>
                @if($program->facilitator)
                    <tr><td><strong>Facilitator:</strong></td><td>{{ $program->facilitator->title }} {{ $program->facilitator->user?->full_name }}</td></tr>
                @endif
            </table>
            @if($program->what_you_will_learn_en)
                <h4>What You Will Learn</h4>
                <ul>
                    @foreach(json_decode($program->what_you_will_learn_en, true) ?? [] as $item)
                        <li>{{ $item }}</li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
</div>
@endsection
