@extends('layouts.admin')

@section('title', 'User Details')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>User Details</h2>
    <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left"></i> Back</a>
</div>

<div class="row g-4">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body text-center">
                @if($user->avatar)
                    <img src="{{ asset('storage/' . $user->avatar) }}" class="rounded-circle mb-3" width="100" height="100" alt="">
                @else
                    <div class="rounded-circle bg-secondary text-white d-inline-flex align-items-center justify-content-center mb-3" style="width:100px;height:100px;font-size:2rem">
                        {{ strtoupper(substr($user->first_name_en, 0, 1)) }}
                    </div>
                @endif
                <h5>{{ $user->full_name }}</h5>
                <p class="text-muted">{{ $user->email }}</p>
                <span class="badge bg-primary">{{ $user->role }}</span>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Information</div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr><td><strong>Name (EN):</strong></td><td>{{ $user->first_name_en }} {{ $user->last_name_en }}</td></tr>
                    <tr><td><strong>Name (AR):</strong></td><td>{{ $user->first_name_ar ?? 'N/A' }} {{ $user->last_name_ar ?? '' }}</td></tr>
                    <tr><td><strong>Phone:</strong></td><td>{{ $user->phone ?? 'N/A' }}</td></tr>
                    <tr><td><strong>Locale:</strong></td><td>{{ $user->locale }}</td></tr>
                    <tr><td><strong>Status:</strong></td><td><span class="badge bg-{{ $user->is_active ? 'success' : 'danger' }}">{{ $user->is_active ? 'Active' : 'Inactive' }}</span></td></tr>
                    <tr><td><strong>Email Verified:</strong></td><td>{{ $user->email_verified_at ? $user->email_verified_at->format('M d, Y') : 'Not Verified' }}</td></tr>
                    <tr><td><strong>Joined:</strong></td><td>{{ $user->created_at->format('M d, Y H:i') }}</td></tr>
                </table>
            </div>
        </div>
        @if($user->clientProfile)
            <div class="card mt-4">
                <div class="card-header">Client Profile</div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tr><td><strong>Date of Birth:</strong></td><td>{{ $user->clientProfile->date_of_birth?->format('M d, Y') ?? 'N/A' }}</td></tr>
                        <tr><td><strong>Gender:</strong></td><td>{{ $user->clientProfile->gender ?? 'N/A' }}</td></tr>
                        <tr><td><strong>Nationality:</strong></td><td>{{ $user->clientProfile->nationality ?? 'N/A' }}</td></tr>
                        <tr><td><strong>Location:</strong></td><td>{{ $user->clientProfile->city ?? '' }} {{ $user->clientProfile->country ?? '' }}</td></tr>
                    </table>
                </div>
            </div>
        @endif
        @if($user->providerProfile)
            <div class="card mt-4">
                <div class="card-header">Provider Profile</div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tr><td><strong>Title:</strong></td><td>{{ $user->providerProfile->title ?? 'N/A' }}</td></tr>
                        <tr><td><strong>License Number:</strong></td><td>{{ $user->providerProfile->license_number }}</td></tr>
                        <tr><td><strong>Experience:</strong></td><td>{{ $user->providerProfile->years_of_experience ?? 'N/A' }} years</td></tr>
                        <tr><td><strong>Work Type:</strong></td><td>{{ $user->providerProfile->work_type }}</td></tr>
                        <tr><td><strong>Verified:</strong></td><td><span class="badge bg-{{ $user->providerProfile->is_verified ? 'success' : 'warning text-dark' }}">{{ $user->providerProfile->is_verified ? 'Yes' : 'No' }}</span></td></tr>
                        <tr><td><strong>Rating:</strong></td><td>{{ $user->providerProfile->rating_average }} ({{ $user->providerProfile->rating_count }} reviews)</td></tr>
                    </table>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
