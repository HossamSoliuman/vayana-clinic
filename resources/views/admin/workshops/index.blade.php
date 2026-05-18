@extends('layouts.admin')

@section('title', 'Workshops')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Workshops</h2>
    <a href="{{ route('admin.workshops.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Add Workshop</a>
</div>
<div class="card">
    <div class="card-body">
        <form method="GET" class="row g-3 mb-3">
            <div class="col-md-3">
                <select name="category" class="form-select" onchange="this.form.submit()">
                    <option value="">All Categories</option>
                    <option value="wellness" {{ request('category')=='wellness'?'selected':'' }}>Wellness</option>
                    <option value="resilience" {{ request('category')=='resilience'?'selected':'' }}>Resilience</option>
                    <option value="stress_management" {{ request('category')=='stress_management'?'selected':'' }}>Stress Management</option>
                    <option value="confidence" {{ request('category')=='confidence'?'selected':'' }}>Confidence</option>
                    <option value="workplace" {{ request('category')=='workplace'?'selected':'' }}>Workplace</option>
                    <option value="other" {{ request('category')=='other'?'selected':'' }}>Other</option>
                </select>
            </div>
        </form>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead><tr><th>Title</th><th>Date</th><th>Location</th><th>Price</th><th>Open</th><th>Active</th><th>Actions</th></tr></thead>
                <tbody>
                    @forelse($workshops as $workshop)
                        <tr>
                            <td>{{ $workshop->title_en }}</td>
                            <td>{{ $workshop->date_time?->format('M d, Y H:i') ?? 'TBA' }}</td>
                            <td>{{ $workshop->location }}</td>
                            <td>{{ $workshop->price ?? 'Free' }} {{ $workshop->currency }}</td>
                            <td><span class="badge bg-{{ $workshop->is_registration_open ? 'success' : 'secondary' }}">{{ $workshop->is_registration_open ? 'Open' : 'Closed' }}</span></td>
                            <td><span class="badge bg-{{ $workshop->is_active ? 'success' : 'secondary' }}">{{ $workshop->is_active ? 'Yes' : 'No' }}</span></td>
                            <td class="table-actions">
                                <a href="{{ route('admin.workshops.edit', $workshop) }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
                                <form action="{{ route('admin.workshops.destroy', $workshop) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @empty<tr><td colspan="7" class="text-center text-muted">No workshops</td></tr>@endforelse
                </tbody>
            </table>
        </div>
        {{ $workshops->links() }}
    </div>
</div>
@endsection
