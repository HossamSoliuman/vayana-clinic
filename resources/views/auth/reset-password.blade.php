@extends('layouts.app')

@section('title', __('messages.reset_password'))

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header text-center"><h4>{{ __('messages.reset_password') }}</h4></div>
                <div class="card-body">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">
                        <input type="hidden" name="email" value="{{ $email }}">
                        <div class="mb-3"><label class="form-label">New Password</label><input type="password" name="password" class="form-control" required minlength="8"></div>
                        <div class="mb-3"><label class="form-label">Confirm Password</label><input type="password" name="password_confirmation" class="form-control" required></div>
                        <button type="submit" class="btn btn-primary w-100">{{ __('messages.reset_password') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
