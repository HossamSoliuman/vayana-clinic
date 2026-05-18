@extends('layouts.admin')

@section('title', 'Services')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Services</h2>
    <a href="{{ route('admin.services.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Add Service</a>
</div>
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead><tr><th>Name (EN)</th><th>Name (AR)</th><th>Slug</th><th>Order</th><th>Active</th><th>Actions</th></tr></thead>
                <tbody>
                    @forelse($services as $service)
                        <tr>
                            <td>{{ $service->name_en }}</td>
                            <td>{{ $service->name_ar ?? 'N/A' }}</td>
                            <td>{{ $service->slug }}</td>
                            <td>{{ $service->display_order }}</td>
                            <td><span class="badge bg-{{ $service->is_active ? 'success' : 'secondary' }}">{{ $service->is_active ? 'Yes' : 'No' }}</span></td>
                            <td class="table-actions">
                                <a href="{{ route('admin.services.edit', $service) }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
                                <form action="{{ route('admin.services.destroy', $service) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this service?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @empty<tr><td colspan="6" class="text-center text-muted">No services</td></tr>@endforelse
                </tbody>
            </table>
        </div>
        {{ $services->links() }}
    </div>
</div>
@endsection
