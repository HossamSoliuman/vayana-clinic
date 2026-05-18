@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Dashboard</h2>
    <span class="text-muted">{{ now()->format('F d, Y') }}</span>
</div>

<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card stat-card">
            <div class="card-body d-flex align-items-center">
                <div class="icon bg-primary text-white me-3"><i class="bi bi-people"></i></div>
                <div>
                    <h5 class="mb-0">{{ $stats['total_users'] }}</h5>
                    <small class="text-muted">Total Users</small>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stat-card">
            <div class="card-body d-flex align-items-center">
                <div class="icon bg-success text-white me-3"><i class="bi bi-person-badge"></i></div>
                <div>
                    <h5 class="mb-0">{{ $stats['verified_providers'] }}</h5>
                    <small class="text-muted">Verified Providers</small>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stat-card">
            <div class="card-body d-flex align-items-center">
                <div class="icon bg-warning text-white me-3"><i class="bi bi-file-earmark-text"></i></div>
                <div>
                    <h5 class="mb-0">{{ $stats['pending_applications'] }}</h5>
                    <small class="text-muted">Pending Applications</small>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stat-card">
            <div class="card-body d-flex align-items-center">
                <div class="icon bg-info text-white me-3"><i class="bi bi-calendar-check"></i></div>
                <div>
                    <h5 class="mb-0">{{ $stats['pending_appointments'] }}</h5>
                    <small class="text-muted">Pending Appointments</small>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span><i class="bi bi-file-earmark-text"></i> Recent Applications</span>
                <a href="{{ route('admin.applications.index') }}" class="btn btn-sm btn-outline-primary">View All</a>
            </div>
            <div class="list-group list-group-flush">
                @forelse($recentApplications as $app)
                    <a href="{{ route('admin.applications.show', $app) }}" class="list-group-item list-group-item-action">
                        <div class="d-flex justify-content-between">
                            <span>{{ $app->full_name }}</span>
                            <span class="badge bg-warning text-dark">{{ $app->status }}</span>
                        </div>
                        <small class="text-muted">{{ $app->created_at->diffForHumans() }}</small>
                    </a>
                @empty
                    <div class="list-group-item text-muted">No pending applications</div>
                @endforelse
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span><i class="bi bi-calendar-check"></i> Recent Appointments</span>
                <a href="{{ route('admin.appointments.index') }}" class="btn btn-sm btn-outline-primary">View All</a>
            </div>
            <div class="list-group list-group-flush">
                @forelse($recentAppointments as $appt)
                    <a href="{{ route('admin.appointments.show', $appt) }}" class="list-group-item list-group-item-action">
                        <div class="d-flex justify-content-between">
                            <span>{{ $appt->full_name }}</span>
                            <span class="badge bg-info">{{ $appt->status }}</span>
                        </div>
                        <small class="text-muted">{{ $appt->preferred_date?->format('M d, Y') }}</small>
                    </a>
                @empty
                    <div class="list-group-item text-muted">No pending appointments</div>
                @endforelse
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span><i class="bi bi-building"></i> New Inquiries</span>
                <a href="{{ route('admin.business-inquiries.index') }}" class="btn btn-sm btn-outline-primary">View All</a>
            </div>
            <div class="list-group list-group-flush">
                @forelse($recentInquiries as $inquiry)
                    <a href="{{ route('admin.business-inquiries.show', $inquiry) }}" class="list-group-item list-group-item-action">
                        <div class="d-flex justify-content-between">
                            <span>{{ $inquiry->organization_name }}</span>
                            <span class="badge bg-secondary">{{ $inquiry->status }}</span>
                        </div>
                        <small class="text-muted">{{ $inquiry->created_at->diffForHumans() }}</small>
                    </a>
                @empty
                    <div class="list-group-item text-muted">No new inquiries</div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
