@extends('layouts.admin')

@section('title', 'Subscription Plans')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4"><h2>Subscription Plans</h2></div>
<div class="row g-4">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">Add Plan</div>
            <div class="card-body">
                <form action="{{ route('admin.subscription-plans.store') }}" method="POST">
                    @csrf
                    <div class="mb-3"><label class="form-label">Name (EN) *</label><input type="text" name="name_en" class="form-control" required></div>
                    <div class="mb-3"><label class="form-label">Name (AR)</label><input type="text" name="name_ar" class="form-control"></div>
                    <div class="mb-3"><label class="form-label">Slug</label><input type="text" name="slug" class="form-control"></div>
                    <div class="row">
                        <div class="col-6 mb-3"><label class="form-label">Price *</label><input type="number" step="0.01" name="price" class="form-control" required></div>
                        <div class="col-6 mb-3"><label class="form-label">Currency</label><select name="currency" class="form-select"><option value="SAR">SAR</option><option value="USD">USD</option></select></div>
                    </div>
                    <div class="mb-3"><label class="form-label">Billing Cycle</label><select name="billing_cycle" class="form-select"><option value="monthly">Monthly</option><option value="yearly">Yearly</option></select></div>
                    <div class="mb-3"><label class="form-label">Features (EN) - one per line</label><textarea name="features_en" class="form-control" rows="3"></textarea></div>
                    <div class="mb-3"><label class="form-label">Features (AR) - one per line</label><textarea name="features_ar" class="form-control" rows="3"></textarea></div>
                    <div class="mb-3"><label class="form-label">Session Credits</label><input type="number" name="session_credits" class="form-control"></div>
                    <div class="mb-3"><label class="form-label d-block">Active</label><div class="form-check form-check-inline"><input class="form-check-input" type="checkbox" name="is_active" value="1" checked><label class="form-check-label">Yes</label></div></div>
                    <button type="submit" class="btn btn-primary">Add Plan</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead><tr><th>Name</th><th>Price</th><th>Cycle</th><th>Credits</th><th>Active</th><th>Actions</th></tr></thead>
                        <tbody>
                            @forelse($plans as $plan)
                                <tr>
                                    <td>{{ $plan->name_en }}</td>
                                    <td>{{ $plan->price }} {{ $plan->currency }}</td>
                                    <td>{{ $plan->billing_cycle }}</td>
                                    <td>{{ $plan->session_credits ?? 'N/A' }}</td>
                                    <td><span class="badge bg-{{ $plan->is_active ? 'success' : 'secondary' }}">{{ $plan->is_active ? 'Yes' : 'No' }}</span></td>
                                    <td class="table-actions">
                                        <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editPlan{{ $plan->id }}"><i class="bi bi-pencil"></i></button>
                                    </td>
                                </tr>
                                <div class="modal fade" id="editPlan{{ $plan->id }}" tabindex="-1">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <form action="{{ route('admin.subscription-plans.update', $plan) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-header"><h5 class="modal-title">Edit Plan</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-6 mb-3"><label class="form-label">Name (EN) *</label><input type="text" name="name_en" class="form-control" value="{{ $plan->name_en }}" required></div>
                                                        <div class="col-md-6 mb-3"><label class="form-label">Name (AR)</label><input type="text" name="name_ar" class="form-control" value="{{ $plan->name_ar }}"></div>
                                                        <div class="col-md-6 mb-3"><label class="form-label">Slug</label><input type="text" name="slug" class="form-control" value="{{ $plan->slug }}"></div>
                                                        <div class="col-3 mb-3"><label class="form-label">Price *</label><input type="number" step="0.01" name="price" class="form-control" value="{{ $plan->price }}" required></div>
                                                        <div class="col-3 mb-3"><label class="form-label">Currency</label><select name="currency" class="form-select"><option value="SAR" {{ $plan->currency=='SAR'?'selected':'' }}>SAR</option><option value="USD" {{ $plan->currency=='USD'?'selected':'' }}>USD</option></select></div>
                                                        <div class="col-md-6 mb-3"><label class="form-label">Billing Cycle</label><select name="billing_cycle" class="form-select"><option value="monthly" {{ $plan->billing_cycle=='monthly'?'selected':'' }}>Monthly</option><option value="yearly" {{ $plan->billing_cycle=='yearly'?'selected':'' }}>Yearly</option></select></div>
                                                        <div class="col-md-6 mb-3"><label class="form-label">Session Credits</label><input type="number" name="session_credits" class="form-control" value="{{ $plan->session_credits }}"></div>
                                                        <div class="col-md-6 mb-3"><label class="form-label">Features (EN)</label><textarea name="features_en" class="form-control" rows="3">{{ $plan->features_en ? implode("\n", json_decode($plan->features_en, true) ?: []) : '' }}</textarea></div>
                                                        <div class="col-md-6 mb-3"><label class="form-label">Features (AR)</label><textarea name="features_ar" class="form-control" rows="3">{{ $plan->features_ar ? implode("\n", json_decode($plan->features_ar, true) ?: []) : '' }}</textarea></div>
                                                        <div class="col-md-3 mb-3"><label class="form-label d-block">Active</label><div class="form-check form-check-inline"><input class="form-check-input" type="checkbox" name="is_active" value="1" {{ $plan->is_active?'checked':'' }}><label class="form-check-label">Yes</label></div></div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button><button type="submit" class="btn btn-primary">Update</button></div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @empty<tr><td colspan="6" class="text-center text-muted">No plans</td></tr>@endforelse
                        </tbody>
                    </table>
                </div>
                {{ $plans->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
