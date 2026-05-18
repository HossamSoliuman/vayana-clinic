@extends('layouts.admin')

@section('title', 'Appointment Details')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Appointment Details</h2>
    <a href="{{ route('admin.appointments.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left"></i> Back</a>
</div>
<div class="row g-4">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Request Information</div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr><td><strong>Name:</strong></td><td>{{ $appointment->full_name }}</td></tr>
                    <tr><td><strong>Email:</strong></td><td>{{ $appointment->email }}</td></tr>
                    <tr><td><strong>Phone:</strong></td><td>{{ $appointment->phone }}</td></tr>
                    <tr><td><strong>Preferred Provider:</strong></td><td>{{ $appointment->preferredProvider?->user?->full_name ?? 'No preference' }}</td></tr>
                    <tr><td><strong>Preferred Date:</strong></td><td>{{ $appointment->preferred_date?->format('M d, Y') ?? 'N/A' }}</td></tr>
                    <tr><td><strong>Preferred Time:</strong></td><td>{{ $appointment->preferred_time?->format('H:i') ?? 'N/A' }}</td></tr>
                    <tr><td><strong>Reason:</strong></td><td>{{ $appointment->reason_for_visit ?? 'N/A' }}</td></tr>
                    <tr><td><strong>Status:</strong></td><td><span class="badge bg-primary">{{ $appointment->status }}</span></td></tr>
                    <tr><td><strong>Clinic Location (EN):</strong></td><td>{{ $appointment->clinic_location_en ?? 'N/A' }}</td></tr>
                    <tr><td><strong>Clinic Location (AR):</strong></td><td>{{ $appointment->clinic_location_ar ?? 'N/A' }}</td></tr>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">Update Status</div>
            <div class="card-body">
                <form action="{{ route('admin.appointments.status', $appointment) }}" method="POST">
                    @csrf
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select mb-2">
                        <option value="pending" {{ $appointment->status=='pending'?'selected':'' }}>Pending</option>
                        <option value="confirmed" {{ $appointment->status=='confirmed'?'selected':'' }}>Confirmed</option>
                        <option value="cancelled" {{ $appointment->status=='cancelled'?'selected':'' }}>Cancelled</option>
                        <option value="completed" {{ $appointment->status=='completed'?'selected':'' }}>Completed</option>
                    </select>
                    <textarea name="admin_notes" class="form-control mb-2" placeholder="Admin notes...">{{ $appointment->admin_notes }}</textarea>
                    <input type="text" name="clinic_location_en" class="form-control mb-2" placeholder="Clinic location (EN)" value="{{ $appointment->clinic_location_en }}">
                    <input type="text" name="clinic_location_ar" class="form-control mb-2" placeholder="Clinic location (AR)" value="{{ $appointment->clinic_location_ar }}">
                    <button type="submit" class="btn btn-primary w-100">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
