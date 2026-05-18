@extends('layouts.app')

@section('title', __('messages.thought_log'))

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>{{ __('messages.thought_log') }}</h1>
        <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">{{ __('messages.back') }}</a>
    </div>
    <div class="row g-4">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">New Thought Log</div>
                <div class="card-body">
                    <form action="{{ route('thought-log.store') }}" method="POST">
                        @csrf
                        <div class="mb-3"><label class="form-label">Situation *</label><textarea name="situation" class="form-control" rows="3" required placeholder="What happened?"></textarea></div>
                        <div class="mb-3"><label class="form-label">Thought *</label><textarea name="thought" class="form-control" rows="3" required placeholder="What went through your mind?"></textarea></div>
                        <div class="mb-3"><label class="form-label">Emotion</label><input type="text" name="emotion" class="form-control" placeholder="e.g. anxiety, sadness"></div>
                        <div class="mb-3"><label class="form-label">Intensity (1-10)</label><input type="number" name="emotion_intensity" class="form-control" min="1" max="10"></div>
                        <div class="mb-3"><label class="form-label">Adaptive Response</label><textarea name="response" class="form-control" rows="3" placeholder="How did you respond?"></textarea></div>
                        <div class="mb-3"><label class="form-label">Alternative Thought</label><textarea name="alternative_thought" class="form-control" rows="3" placeholder="A more balanced thought..."></textarea></div>
                        <button type="submit" class="btn btn-primary w-100">Save Log</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Thought History</div>
                <div class="list-group list-group-flush">
                    @forelse($logs as $log)
                        <div class="list-group-item">
                            <div class="d-flex justify-content-between">
                                <h6 class="mb-1">{{ $log->emotion }} @if($log->emotion_intensity)<span class="badge bg-danger">{{ $log->emotion_intensity }}/10</span>@endif</h6>
                                <small class="text-muted">{{ $log->log_date?->format('M d, Y H:i') }}</small>
                            </div>
                            <p class="mb-1"><strong>Situation:</strong> {{ Str::limit($log->situation, 80) }}</p>
                            <p class="mb-1 text-muted"><strong>Thought:</strong> {{ Str::limit($log->thought, 80) }}</p>
                            @if($log->alternative_thought)<p class="mb-0 text-success"><strong>Alternative:</strong> {{ Str::limit($log->alternative_thought, 60) }}</p>@endif
                        </div>
                    @empty
                        <div class="list-group-item text-muted">No thought logs yet.</div>
                    @endforelse
                </div>
            </div>
            <div class="mt-3">{{ $logs->links() }}</div>
        </div>
    </div>
</div>
@endsection
