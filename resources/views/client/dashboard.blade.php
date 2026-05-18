@extends('layouts.app')

@section('title', __('messages.dashboard'))

@section('content')
<div class="container py-5">
    <h1 class="mb-4">{{ __('messages.dashboard') }}</h1>

    <div class="row g-3 mb-4">
        <div class="col-md-3"><div class="card text-center"><div class="card-body"><h3>{{ $stats['total_entries'] }}</h3><p class="text-muted mb-0">Journal Entries</p></div></div></div>
        <div class="col-md-3"><div class="card text-center"><div class="card-body"><h3>{{ $stats['total_moods'] }}</h3><p class="text-muted mb-0">Mood Logs</p></div></div></div>
        <div class="col-md-3"><div class="card text-center"><div class="card-body"><h3>{{ $stats['streak_days'] }}</h3><p class="text-muted mb-0">Day Streak</p></div></div></div>
    </div>

    <div class="row g-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header d-flex justify-content-between"><span>Recent Journal Entries</span><a href="{{ route('my-journal.index') }}" class="btn btn-sm btn-outline-primary">View All</a></div>
                <div class="list-group list-group-flush">
                    @forelse($recentEntries as $entry)
                        <a href="{{ route('my-journal.show', $entry->id) }}" class="list-group-item list-group-item-action">
                            <div class="d-flex justify-content-between"><span>{{ $entry->title ?? 'Untitled' }}</span><small class="text-muted">{{ $entry->entry_date->format('M d, Y') }}</small></div>
                        </a>
                    @empty
                        <div class="list-group-item text-muted">No entries yet. <a href="{{ route('my-journal.index') }}">Write your first entry</a>.</div>
                    @endforelse
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header d-flex justify-content-between"><span>Recent Moods</span><a href="{{ route('mood-tracker.index') }}" class="btn btn-sm btn-outline-primary">View All</a></div>
                <div class="list-group list-group-flush">
                    @forelse($recentMoods as $mood)
                        <div class="list-group-item d-flex justify-content-between align-items-center">
                            <span>
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="bi bi-circle{{ $i <= $mood->mood_score ? '-fill' : '' }} text-{{ $i <= 2 ? 'danger' : ($i == 3 ? 'warning' : 'success') }}"></i>
                                @endfor
                                {{ $mood->mood_label ? ' - ' . $mood->mood_label : '' }}
                            </span>
                            <small class="text-muted">{{ $mood->entry_date->format('M d, Y') }}</small>
                        </div>
                    @empty
                        <div class="list-group-item text-muted">No mood logs yet. <a href="{{ route('mood-tracker.index') }}">Log your first mood</a>.</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <div class="mt-4 d-flex gap-3">
        <a href="{{ route('my-journal.index') }}" class="btn btn-primary"><i class="bi bi-journal-text"></i> My Journal</a>
        <a href="{{ route('mood-tracker.index') }}" class="btn btn-info text-white"><i class="bi bi-emoji-smile"></i> Mood Tracker</a>
        <a href="{{ route('thought-log.index') }}" class="btn btn-secondary"><i class="bi bi-brain"></i> Thought Log</a>
    </div>
</div>
@endsection
