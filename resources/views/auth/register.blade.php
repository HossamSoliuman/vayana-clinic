@extends('layouts.app')

@section('title', __('messages.register'))

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center"><h4>{{ __('messages.register') }}</h4></div>
                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6"><label class="form-label">First Name (EN) *</label><input type="text" name="first_name_en" class="form-control" required></div>
                            <div class="col-md-6"><label class="form-label">Last Name (EN) *</label><input type="text" name="last_name_en" class="form-control" required></div>
                        </div>
                        <div class="mb-3 mt-3"><label class="form-label">{{ __('messages.email') }} *</label><input type="email" name="email" class="form-control" required></div>
                        <div class="mb-3"><label class="form-label">{{ __('messages.phone') }}</label><input type="text" name="phone" class="form-control"></div>
                        <div class="mb-3"><label class="form-label">{{ __('messages.password') }} *</label><input type="password" name="password" class="form-control" required minlength="8"></div>
                        <div class="mb-3"><label class="form-label">{{ __('messages.confirm_password') }} *</label><input type="password" name="password_confirmation" class="form-control" required></div>
                        <div class="mb-3">
                            <label class="form-label">{{ __('messages.language') }}</label>
                            <select name="locale" class="form-select">
                                <option value="ar" selected>{{ __('messages.arabic') }}</option>
                                <option value="en">{{ __('messages.english') }}</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">{{ __('messages.register') }}</button>
                    </form>
                    <hr>
                    <div class="text-center"><a href="{{ route('login') }}" class="text-decoration-none">Already have an account? Login</a></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
