@extends('layouts.admin')

@section('title', 'Reviews')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4"><h2>Client Reviews</h2></div>
<div class="card">
    <div class="card-body">
        <form method="GET" class="row g-3 mb-3">
            <div class="col-md-3">
                <select name="status" class="form-select" onchange="this.form.submit()">
                    <option value="">All</option>
                    <option value="approved" {{ request('status')=='approved'?'selected':'' }}>Approved</option>
                    <option value="pending" {{ request('status')=='pending'?'selected':'' }}>Pending</option>
                </select>
            </div>
        </form>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead><tr><th>Client</th><th>Rating</th><th>Review</th><th>Provider</th><th>Approved</th><th>Featured</th><th>Actions</th></tr></thead>
                <tbody>
                    @forelse($reviews as $review)
                        <tr>
                            <td>{{ $review->client_name }}</td>
                            <td>{{ $review->rating }}/5</td>
                            <td>{{ Str::limit($review->review_text_en, 50) }}</td>
                            <td>{{ $review->provider?->user?->full_name ?? 'N/A' }}</td>
                            <td><span class="badge bg-{{ $review->is_approved ? 'success' : 'warning text-dark' }}">{{ $review->is_approved ? 'Yes' : 'No' }}</span></td>
                            <td><span class="badge bg-{{ $review->is_featured ? 'success' : 'secondary' }}">{{ $review->is_featured ? 'Yes' : 'No' }}</span></td>
                            <td class="table-actions">
                                <form action="{{ route('admin.reviews.approve', $review) }}" method="POST" class="d-inline">@csrf<button type="submit" class="btn btn-sm btn-{{ $review->is_approved ? 'warning' : 'success' }}"><i class="bi bi-{{ $review->is_approved ? 'x-lg' : 'check-lg' }}"></i></button></form>
                                <form action="{{ route('admin.reviews.feature', $review) }}" method="POST" class="d-inline">@csrf<button type="submit" class="btn btn-sm btn-{{ $review->is_featured ? 'secondary' : 'info' }}"><i class="bi bi-star{{ $review->is_featured ? '' : '-fill' }}"></i></button></form>
                                <form action="{{ route('admin.reviews.destroy', $review) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete?')">@csrf @method('DELETE')<button type="submit" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button></form>
                            </td>
                        </tr>
                    @empty<tr><td colspan="7" class="text-center text-muted">No reviews</td></tr>@endforelse
                </tbody>
            </table>
        </div>
        {{ $reviews->links() }}
    </div>
</div>
@endsection
