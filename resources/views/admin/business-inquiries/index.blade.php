@extends('layouts.admin')

@section('title', 'Business Inquiries')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4"><h2>Business Inquiries</h2></div>
<div class="card">
    <div class="card-body">
        <form method="GET" class="row g-3 mb-3">
            <div class="col-md-3">
                <select name="status" class="form-select" onchange="this.form.submit()">
                    <option value="">All</option>
                    <option value="new" {{ request('status')=='new'?'selected':'' }}>New</option>
                    <option value="in_progress" {{ request('status')=='in_progress'?'selected':'' }}>In Progress</option>
                    <option value="contacted" {{ request('status')=='contacted'?'selected':'' }}>Contacted</option>
                    <option value="closed" {{ request('status')=='closed'?'selected':'' }}>Closed</option>
                </select>
            </div>
        </form>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead><tr><th>Organization</th><th>Contact</th><th>Service</th><th>Status</th><th>Assigned To</th><th>Submitted</th><th>Actions</th></tr></thead>
                <tbody>
                    @forelse($inquiries as $inquiry)
                        <tr>
                            <td>{{ $inquiry->organization_name }}</td>
                            <td>{{ $inquiry->contact_person_name }}<br><small>{{ $inquiry->email }}</small></td>
                            <td>{{ $inquiry->type_of_service ?? 'N/A' }}</td>
                            <td><span class="badge bg-{{ $inquiry->status=='new'?'info':($inquiry->status=='closed'?'secondary':($inquiry->status=='contacted'?'success':'warning text-dark')) }}">{{ $inquiry->status }}</span></td>
                            <td>{{ $inquiry->assignedUser?->full_name ?? 'Unassigned' }}</td>
                            <td>{{ $inquiry->created_at->format('M d, Y') }}</td>
                            <td class="table-actions"><a href="{{ route('admin.business-inquiries.show',$inquiry) }}" class="btn btn-sm btn-info"><i class="bi bi-eye"></i></a></td>
                        </tr>
                    @empty<tr><td colspan="7" class="text-center text-muted">No inquiries</td></tr>@endforelse
                </tbody>
            </table>
        </div>
        {{ $inquiries->links() }}
    </div>
</div>
@endsection
