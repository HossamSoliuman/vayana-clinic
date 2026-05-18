@extends('layouts.app')

@section('title', 'Edit Entry')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1>Edit Entry</h1>
                <a href="{{ route('my-journal.index') }}" class="btn btn-outline-secondary">{{ __('messages.cancel') }}</a>
            </div>
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('my-journal.update', $entry->id) }}" method="POST">
                        @csrf
                        <div class="mb-3"><label class="form-label">Title</label><input type="text" name="title" class="form-control" value="{{ $entry->title }}"></div>
                        <div class="mb-3"><label class="form-label">Content *</label><textarea name="content" class="form-control" rows="8" required>{{ $entry->getDecryptedContentAttribute() }}</textarea></div>
                        <div class="mb-3"><label class="form-label">Prompt</label><select name="prompt_id" class="form-select"><option value="">None</option>@foreach($prompts as $p)<option value="{{ $p->id }}" {{ $entry->prompt_id==$p->id?'selected':'' }}>{{ Str::limit($p->localized_text, 50) }}</option>@endforeach</select></div>
                        <div class="mb-3"><label class="form-label">Mood (1-5)</label><select name="mood_score" class="form-select"><option value="">Select</option><option value="1" {{ $entry->mood_score==1?'selected':'' }}>1 - Very Low</option><option value="2" {{ $entry->mood_score==2?'selected':'' }}>2 - Low</option><option value="3" {{ $entry->mood_score==3?'selected':'' }}>3 - Neutral</option><option value="4" {{ $entry->mood_score==4?'selected':'' }}>4 - Good</option><option value="5" {{ $entry->mood_score==5?'selected':'' }}>5 - Very Good</option></select></div>
                        <div class="mb-3"><label class="form-label">Date</label><input type="date" name="entry_date" class="form-control" value="{{ $entry->entry_date->format('Y-m-d') }}"></div>
                        <button type="submit" class="btn btn-primary">{{ __('messages.update') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
