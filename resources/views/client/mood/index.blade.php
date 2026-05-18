@extends('layouts.app')

@section('title', __('messages.mood_tracker'))

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>{{ __('messages.mood_tracker') }}</h1>
        <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">{{ __('messages.back') }}</a>
    </div>
    <div class="row g-4">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Log Mood</div>
                <div class="card-body">
                    <form action="{{ route('mood-tracker.store') }}" method="POST">
                        @csrf
                        <div class="mb-3"><label class="form-label">Mood Score *</label><select name="mood_score" class="form-select" required>
                            <option value="">Select</option>
                            @foreach($moodLabels as $score => $info)
                                <option value="{{ $score }}">{{ $score }} - {{ $info['label'] }}</option>
                            @endforeach
                        </select></div>
                        <div class="mb-3"><label class="form-label">Mood Label</label><input type="text" name="mood_label" class="form-control" placeholder="e.g. happy, anxious"></div>
                        <div class="mb-3"><label class="form-label">Notes</label><textarea name="notes" class="form-control" rows="3"></textarea></div>
                        <div class="mb-3"><label class="form-label">Date *</label><input type="date" name="entry_date" class="form-control" value="{{ date('Y-m-d') }}" required></div>
                        <button type="submit" class="btn btn-primary w-100">Log Mood</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Mood History</div>
                <div class="list-group list-group-flush">
                    @forelse($moods as $mood)
                        <div class="list-group-item d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center gap-3">
                                <div class="text-center" style="width:40px">
                                    <div class="badge bg-{{ $moodLabels[$mood->mood_score]['color'] }} fs-6">{{ $mood->mood_score }}</div>
                                </div>
                                <div>
                                    <div>{{ $mood->mood_label ?? $moodLabels[$mood->mood_score]['label'] }}</div>
                                    @if($mood->notes)<small class="text-muted">{{ Str::limit($mood->notes, 60) }}</small>@endif
                                </div>
                            </div>
                            <small class="text-muted">{{ $mood->entry_date->format('M d, Y') }}</small>
                        </div>
                    @empty
                        <div class="list-group-item text-muted">No mood logs yet.</div>
                    @endforelse
                </div>
            </div>
            <div class="mt-3">{{ $moods->links() }}</div>
        </div>
    </div>
</div>
@endsection
