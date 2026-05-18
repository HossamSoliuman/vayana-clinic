@extends('layouts.app')

@section('title', __('messages.forgot_password'))

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header text-center"><h4>{{ __('messages.forgot_password') }}</h4></div>
                <div class="card-body">
                    <p class="text-muted">Enter your email and we will send you a reset link.</p>
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <div class="mb-3"><label class="form-label">{{ __('messages.email') }}</label><input type="email" name="email" class="form-control" required></div>
                        <button type="submit" class="btn btn-primary w-100">{{ __('messages.send_reset_link') }}</button>
                    </form>
                    <hr>
                    <div class="text-center"><a href="{{ route('login') }}" class="text-decoration-none">Back to Login</a></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
