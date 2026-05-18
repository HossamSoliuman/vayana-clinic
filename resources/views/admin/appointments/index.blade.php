@extends('layouts.admin')

@section('title', 'Appointments')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4"><h2>Appointments</h2></div>
<div class="card">
    <div class="card-body">
        <form method="GET" class="row g-3 mb-3">
            <div class="col-md-3">
                <select name="status" class="form-select" onchange="this.form.submit()">
                    <option value="">All</option>
                    <option value="pending" {{ request('status')=='pending'?'selected':'' }}>Pending</option>
                    <option value="confirmed" {{ request('status')=='confirmed'?'selected':'' }}>Confirmed</option>
                    <option value="cancelled" {{ request('status')=='cancelled'?'selected':'' }}>Cancelled</option>
                    <option value="completed" {{ request('status')=='completed'?'selected':'' }}>Completed</option>
                </select>
            </div>
        </form>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead><tr><th>Name</th><th>Email</th><th>Preferred Date</th><th>Status</th><th>Submitted</th><th>Actions</th></tr></thead>
                <tbody>
                    @forelse($appointments as $appt)
                        <tr>
                            <td>{{ $appt->full_name }}</td>
                            <td>{{ $appt->email }}</td>
                            <td>{{ $appt->preferred_date?->format('M d, Y') }} {{ $appt->preferred_time?->format('H:i') }}</td>
                            <td><span class="badge bg-{{ $appt->status=='confirmed'?'success':($appt->status=='cancelled'?'danger':($appt->status=='completed'?'info':'warning text-dark')) }}">{{ $appt->status }}</span></td>
                            <td>{{ $appt->created_at->format('M d, Y') }}</td>
                            <td class="table-actions"><a href="{{ route('admin.appointments.show',$appt) }}" class="btn btn-sm btn-info"><i class="bi bi-eye"></i></a></td>
                        </tr>
                    @empty<tr><td colspan="6" class="text-center text-muted">No appointments</td></tr>@endforelse
                </tbody>
            </table>
        </div>
        {{ $appointments->links() }}
    </div>
</div>
@endsection
