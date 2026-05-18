@extends('layouts.app')

@section('title', __('messages.journal'))

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 text-center">
            <h1>{{ __('messages.journal') }}</h1>
            <p class="lead">Your private wellness journal for reflection and growth.</p>
            @auth
                <div class="d-flex justify-content-center gap-3 mt-4">
                    <a href="{{ route('my-journal.index') }}" class="btn btn-primary btn-lg"><i class="bi bi-journal-text"></i> My Journal</a>
                    <a href="{{ route('mood-tracker.index') }}" class="btn btn-info btn-lg text-white"><i class="bi bi-emoji-smile"></i> Mood Tracker</a>
                    <a href="{{ route('thought-log.index') }}" class="btn btn-secondary btn-lg"><i class="bi bi-brain"></i> Thought Log</a>
                </div>
            @else
                <a href="{{ route('login') }}" class="btn btn-primary btn-lg mt-4">Login to Access Your Journal</a>
            @endauth
        </div>
    </div>
</div>
@endsection
