@extends('layouts.app')

@section('title', __('messages.my_journal'))

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>{{ __('messages.my_journal') }}</h1>
        <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">{{ __('messages.back') }}</a>
    </div>

    <div class="row g-4">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">New Entry</div>
                <div class="card-body">
                    <form action="{{ route('my-journal.store') }}" method="POST">
                        @csrf
                        <div class="mb-3"><label class="form-label">Title</label><input type="text" name="title" class="form-control" placeholder="Optional"></div>
                        <div class="mb-3"><label class="form-label">Content *</label><textarea name="content" class="form-control" rows="6" required></textarea></div>
                        <div class="mb-3"><label class="form-label">Prompt</label><select name="prompt_id" class="form-select"><option value="">None</option>@foreach($prompts as $p)<option value="{{ $p->id }}">{{ Str::limit($p->localized_text, 50) }}</option>@endforeach</select></div>
                        <div class="mb-3"><label class="form-label">Mood (1-5)</label><select name="mood_score" class="form-select"><option value="">Select</option><option value="1">1 - Very Low</option><option value="2">2 - Low</option><option value="3">3 - Neutral</option><option value="4">4 - Good</option><option value="5">5 - Very Good</option></select></div>
                        <div class="mb-3"><label class="form-label">Date</label><input type="date" name="entry_date" class="form-control" value="{{ date('Y-m-d') }}"></div>
                        <button type="submit" class="btn btn-primary w-100">Save Entry</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">My Entries</div>
                <div class="list-group list-group-flush">
                    @forelse($entries as $entry)
                        <div class="list-group-item">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <h6 class="mb-1">{{ $entry->title ?? 'Untitled' }} <small class="text-muted">{{ $entry->entry_date->format('M d, Y') }}</small></h6>
                                    <p class="mb-1 text-muted">{{ Str::limit($entry->getDecryptedContentAttribute(), 120) }}</p>
                                    @if($entry->mood_score)<span class="badge bg-{{ $entry->mood_score <= 2 ? 'danger' : ($entry->mood_score == 3 ? 'warning text-dark' : 'success') }}">Mood: {{ $entry->mood_score }}/5</span>@endif
                                    @if($entry->prompt)<span class="badge bg-info ms-1">Prompt</span>@endif
                                </div>
                                <div class="btn-group">
                                    <a href="{{ route('my-journal.show', $entry->id) }}" class="btn btn-sm btn-info"><i class="bi bi-eye"></i></a>
                                    <a href="{{ route('my-journal.edit', $entry->id) }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
                                    <form action="{{ route('my-journal.destroy', $entry->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete?')">@csrf @method('DELETE')<button type="submit" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button></form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="list-group-item text-muted">No entries yet. Write your first entry!</div>
                    @endforelse
                </div>
            </div>
            <div class="mt-3">{{ $entries->links() }}</div>
        </div>
    </div>
</div>
@endsection
