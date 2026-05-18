@extends('layouts.admin')

@section('title', 'Partners')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4"><h2>Partners</h2></div>
<div class="row g-4">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">Add Partner</div>
            <div class="card-body">
                <form action="{{ route('admin.partners.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3"><label class="form-label">Name *</label><input type="text" name="name" class="form-control" required></div>
                    <div class="mb-3"><label class="form-label">Logo *</label><input type="file" name="logo" class="form-control" accept="image/*" required></div>
                    <div class="mb-3"><label class="form-label">Website URL</label><input type="url" name="website_url" class="form-control"></div>
                    <div class="mb-3"><label class="form-label">Display Order</label><input type="number" name="display_order" class="form-control" value="0"></div>
                    <div class="mb-3"><label class="form-label d-block">Active</label><div class="form-check form-check-inline"><input class="form-check-input" type="checkbox" name="is_active" value="1" checked><label class="form-check-label">Yes</label></div></div>
                    <button type="submit" class="btn btn-primary">Add Partner</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead><tr><th>Name</th><th>Logo</th><th>Order</th><th>Active</th><th>Actions</th></tr></thead>
                        <tbody>
                            @forelse($partners as $partner)
                                <tr>
                                    <td>{{ $partner->name }}</td>
                                    <td>@if($partner->logo_path)<img src="{{ asset('storage/'.$partner->logo_path) }}" height="40">@else N/A @endif</td>
                                    <td>{{ $partner->display_order }}</td>
                                    <td><span class="badge bg-{{ $partner->is_active ? 'success' : 'secondary' }}">{{ $partner->is_active ? 'Yes' : 'No' }}</span></td>
                                    <td class="table-actions">
                                        <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editPartner{{ $partner->id }}"><i class="bi bi-pencil"></i></button>
                                        <form action="{{ route('admin.partners.destroy', $partner) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete?')">@csrf @method('DELETE')<button type="submit" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button></form>
                                    </td>
                                </tr>
                                <div class="modal fade" id="editPartner{{ $partner->id }}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="{{ route('admin.partners.update', $partner) }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-header"><h5 class="modal-title">Edit Partner</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
                                                <div class="modal-body">
                                                    <div class="mb-3"><label class="form-label">Name *</label><input type="text" name="name" class="form-control" value="{{ $partner->name }}" required></div>
                                                    <div class="mb-3"><label class="form-label">Logo</label><input type="file" name="logo" class="form-control" accept="image/*"></div>
                                                    <div class="mb-3"><label class="form-label">Website URL</label><input type="url" name="website_url" class="form-control" value="{{ $partner->website_url }}"></div>
                                                    <div class="mb-3"><label class="form-label">Order</label><input type="number" name="display_order" class="form-control" value="{{ $partner->display_order }}"></div>
                                                    <div class="mb-3"><label class="form-label d-block">Active</label><div class="form-check form-check-inline"><input class="form-check-input" type="checkbox" name="is_active" value="1" {{ $partner->is_active?'checked':'' }}><label class="form-check-label">Yes</label></div></div>
                                                </div>
                                                <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button><button type="submit" class="btn btn-primary">Update</button></div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @empty<tr><td colspan="5" class="text-center text-muted">No partners</td></tr>@endforelse
                        </tbody>
                    </table>
                </div>
                {{ $partners->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
