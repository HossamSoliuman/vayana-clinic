@extends('layouts.admin')

@section('title', 'Provider Details')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Provider Details</h2>
    <a href="{{ route('admin.providers.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left"></i> Back</a>
</div>

<div class="row g-4">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body text-center">
                <h5>{{ $provider->user?->full_name ?? 'N/A' }}</h5>
                <p class="text-muted">{{ $provider->user?->email }}</p>
                <span class="badge bg-primary">{{ $provider->title ?? 'Provider' }}</span>
                <div class="mt-3">
                    <form action="{{ route('admin.providers.verify', $provider) }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-{{ $provider->is_verified ? 'secondary' : 'success' }}">
                            {{ $provider->is_verified ? 'Unverify' : 'Verify' }}
                        </button>
                    </form>
                    <form action="{{ route('admin.providers.feature', $provider) }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-{{ $provider->is_featured ? 'secondary' : 'warning' }}">
                            {{ $provider->is_featured ? 'Unfeature' : 'Feature' }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Profile Information</div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr><td><strong>License Number:</strong></td><td>{{ $provider->license_number }}</td></tr>
                    <tr><td><strong>Biography:</strong></td><td>{{ $provider->biography_en ?? 'N/A' }}</td></tr>
                    <tr><td><strong>Experience:</strong></td><td>{{ $provider->years_of_experience ?? 'N/A' }} years</td></tr>
                    <tr><td><strong>Work Type:</strong></td><td>{{ $provider->work_type }}</td></tr>
                    <tr><td><strong>Online Price:</strong></td><td>{{ $provider->session_price_online ?? 'N/A' }} {{ $provider->currency }}</td></tr>
                    <tr><td><strong>In-Person Price:</strong></td><td>{{ $provider->session_price_inperson ?? 'N/A' }} {{ $provider->currency }}</td></tr>
                    <tr><td><strong>Specialties:</strong></td><td>{{ $provider->specialties->pluck('name_en')->implode(', ') ?: 'N/A' }}</td></tr>
                    <tr><td><strong>Languages:</strong></td><td>{{ $provider->languages->pluck('language')->implode(', ') ?: 'N/A' }}</td></tr>
                    <tr><td><strong>Rating:</strong></td><td>{{ $provider->rating_average }} ({{ $provider->rating_count }} reviews)</td></tr>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
