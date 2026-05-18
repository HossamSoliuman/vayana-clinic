@extends('layouts.app')

@section('title', __('messages.profile'))

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <h1 class="mb-4">{{ __('messages.profile') }}</h1>
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6"><label class="form-label">First Name (EN) *</label><input type="text" name="first_name_en" class="form-control" value="{{ $user->first_name_en }}" required></div>
                            <div class="col-md-6"><label class="form-label">First Name (AR)</label><input type="text" name="first_name_ar" class="form-control" value="{{ $user->first_name_ar }}"></div>
                            <div class="col-md-6"><label class="form-label">Last Name (EN) *</label><input type="text" name="last_name_en" class="form-control" value="{{ $user->last_name_en }}" required></div>
                            <div class="col-md-6"><label class="form-label">Last Name (AR)</label><input type="text" name="last_name_ar" class="form-control" value="{{ $user->last_name_ar }}"></div>
                            <div class="col-md-6"><label class="form-label">Email *</label><input type="email" name="email" class="form-control" value="{{ $user->email }}" required></div>
                            <div class="col-md-6"><label class="form-label">Phone</label><input type="text" name="phone" class="form-control" value="{{ $user->phone }}"></div>
                            <div class="col-md-6"><label class="form-label">Language</label><select name="locale" class="form-select"><option value="ar" {{ $user->locale=='ar'?'selected':'' }}>Arabic</option><option value="en" {{ $user->locale=='en'?'selected':'' }}>English</option></select></div>
                            <div class="col-md-6"><label class="form-label">Avatar</label><input type="file" name="avatar" class="form-control" accept="image/*"></div>
                            <div class="col-md-4"><label class="form-label">Date of Birth</label><input type="date" name="date_of_birth" class="form-control" value="{{ $user->clientProfile?->date_of_birth?->format('Y-m-d') }}"></div>
                            <div class="col-md-4"><label class="form-label">Gender</label><select name="gender" class="form-select"><option value="">Select</option><option value="male" {{ $user->clientProfile?->gender=='male'?'selected':'' }}>Male</option><option value="female" {{ $user->clientProfile?->gender=='female'?'selected':'' }}>Female</option><option value="prefer_not_to_say" {{ $user->clientProfile?->gender=='prefer_not_to_say'?'selected':'' }}>Prefer not to say</option></select></div>
                            <div class="col-md-4"><label class="form-label">Nationality</label><input type="text" name="nationality" class="form-control" value="{{ $user->clientProfile?->nationality }}"></div>
                            <div class="col-md-6"><label class="form-label">City</label><input type="text" name="city" class="form-control" value="{{ $user->clientProfile?->city }}"></div>
                            <div class="col-md-6"><label class="form-label">Country</label><input type="text" name="country" class="form-control" value="{{ $user->clientProfile?->country }}"></div>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">{{ __('messages.update') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
