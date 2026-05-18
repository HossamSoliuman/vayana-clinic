@extends('layouts.admin')

@section('title', 'Providers')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Providers</h2>
</div>

<div class="card">
    <div class="card-body">
        <form method="GET" class="row g-3 mb-3">
            <div class="col-md-3">
                <select name="status" class="form-select" onchange="this.form.submit()">
                    <option value="">All Status</option>
                    <option value="verified" {{ request('status') === 'verified' ? 'selected' : '' }}>Verified</option>
                    <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                </select>
            </div>
            <div class="col-md-4">
                <input type="text" name="search" class="form-control" placeholder="Search providers..." value="{{ request('search') }}">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary"><i class="bi bi-search"></i></button>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>License</th>
                        <th>Work Type</th>
                        <th>Verified</th>
                        <th>Featured</th>
                        <th>Rating</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($providers as $provider)
                        <tr>
                            <td>{{ $provider->user?->full_name ?? 'N/A' }}</td>
                            <td>{{ $provider->license_number }}</td>
                            <td>{{ $provider->work_type }}</td>
                            <td><span class="badge bg-{{ $provider->is_verified ? 'success' : 'warning text-dark' }}">{{ $provider->is_verified ? 'Yes' : 'No' }}</span></td>
                            <td><span class="badge bg-{{ $provider->is_featured ? 'success' : 'secondary' }}">{{ $provider->is_featured ? 'Yes' : 'No' }}</span></td>
                            <td>{{ $provider->rating_average }} ({{ $provider->rating_count }})</td>
                            <td class="table-actions">
                                <a href="{{ route('admin.providers.show', $provider) }}" class="btn btn-sm btn-info"><i class="bi bi-eye"></i></a>
                                @if(!$provider->is_verified)
                                    <form action="{{ route('admin.providers.verify', $provider) }}" method="POST" class="d-inline" onsubmit="return confirm('Verify this provider?')">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-success"><i class="bi bi-check-lg"></i></button>
                                    </form>
                                @endif
                                <form action="{{ route('admin.providers.feature', $provider) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-{{ $provider->is_featured ? 'secondary' : 'warning' }}"><i class="bi bi-star{{ $provider->is_featured ? '' : '-fill' }}"></i></button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="7" class="text-center text-muted">No providers found</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{ $providers->links() }}
    </div>
</div>
@endsection
