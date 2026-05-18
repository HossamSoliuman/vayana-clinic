@extends('layouts.app')

@section('title', $entry->title ?? 'Journal Entry')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1>{{ $entry->title ?? 'Untitled Entry' }}</h1>
                <a href="{{ route('my-journal.index') }}" class="btn btn-outline-secondary">{{ __('messages.back') }}</a>
            </div>
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <span>{{ $entry->entry_date->format('F d, Y') }}</span>
                    @if($entry->mood_score)<span class="badge bg-{{ $entry->mood_score <= 2 ? 'danger' : ($entry->mood_score == 3 ? 'warning text-dark' : 'success') }}">Mood: {{ $entry->mood_score }}/5</span>@endif
                </div>
                <div class="card-body">
                    @if($entry->prompt)
                        <div class="alert alert-info"><strong>Prompt:</strong> {{ $entry->prompt->localized_text }}</div>
                    @endif
                    <div style="white-space: pre-wrap;">{{ $entry->getDecryptedContentAttribute() }}</div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('my-journal.edit', $entry->id) }}" class="btn btn-warning btn-sm"><i class="bi bi-pencil"></i> Edit</a>
                    <form action="{{ route('my-journal.destroy', $entry->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete?')">@csrf @method('DELETE')<button type="submit" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i> Delete</button></form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
