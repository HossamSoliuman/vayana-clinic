@extends('layouts.admin')

@section('title', 'Inquiry Details')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Inquiry Details</h2>
    <a href="{{ route('admin.business-inquiries.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left"></i> Back</a>
</div>
<div class="row g-4">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Information</div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr><td><strong>Organization:</strong></td><td>{{ $inquiry->organization_name }}</td></tr>
                    <tr><td><strong>Contact Person:</strong></td><td>{{ $inquiry->contact_person_name }}</td></tr>
                    <tr><td><strong>Email:</strong></td><td>{{ $inquiry->email }}</td></tr>
                    <tr><td><strong>Phone:</strong></td><td>{{ $inquiry->phone }}</td></tr>
                    <tr><td><strong>Type of Service:</strong></td><td>{{ $inquiry->type_of_service ?? 'N/A' }}</td></tr>
                    <tr><td><strong>Organization Size:</strong></td><td>{{ $inquiry->organization_size ?? 'N/A' }}</td></tr>
                    <tr><td><strong>Message:</strong></td><td>{{ $inquiry->message ?? 'N/A' }}</td></tr>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">Manage</div>
            <div class="card-body">
                <form action="{{ route('admin.business-inquiries.update', $inquiry) }}" method="POST">
                    @csrf
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select mb-2">
                        <option value="new" {{ $inquiry->status=='new'?'selected':'' }}>New</option>
                        <option value="in_progress" {{ $inquiry->status=='in_progress'?'selected':'' }}>In Progress</option>
                        <option value="contacted" {{ $inquiry->status=='contacted'?'selected':'' }}>Contacted</option>
                        <option value="closed" {{ $inquiry->status=='closed'?'selected':'' }}>Closed</option>
                    </select>
                    <label class="form-label">Assign To</label>
                    <select name="assigned_to" class="form-select mb-2">
                        <option value="">Unassigned</option>
                        @foreach($staff as $s)
                            <option value="{{ $s->id }}" {{ $inquiry->assigned_to==$s->id?'selected':'' }}>{{ $s->full_name }}</option>
                        @endforeach
                    </select>
                    <textarea name="admin_notes" class="form-control mb-2" placeholder="Notes...">{{ $inquiry->admin_notes }}</textarea>
                    <button type="submit" class="btn btn-primary w-100">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
