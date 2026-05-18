@extends('layouts.app')

@section('title', __('messages.login'))

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header text-center"><h4>{{ __('messages.login') }}</h4></div>
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="mb-3"><label class="form-label">{{ __('messages.email') }}</label><input type="email" name="email" class="form-control" required autofocus></div>
                        <div class="mb-3"><label class="form-label">{{ __('messages.password') }}</label><input type="password" name="password" class="form-control" required></div>
                        <div class="mb-3 form-check"><input type="checkbox" name="remember" class="form-check-input" id="remember"><label class="form-check-label" for="remember">{{ __('messages.remember_me') }}</label></div>
                        <button type="submit" class="btn btn-primary w-100">{{ __('messages.login') }}</button>
                    </form>
                    <hr>
                    <div class="text-center">
                        <a href="{{ route('password.request') }}" class="text-decoration-none">{{ __('messages.forgot_password') }}</a><br>
                        <a href="{{ route('register') }}" class="text-decoration-none">{{ __('messages.register') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
