@extends('layouts.admin')

@section('title', 'FAQs')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>FAQs</h2>
    <a href="{{ route('admin.faqs.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Add FAQ</a>
</div>
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead><tr><th>Question (EN)</th><th>Category</th><th>Order</th><th>Active</th><th>Actions</th></tr></thead>
                <tbody>
                    @forelse($faqs as $faq)
                        <tr>
                            <td>{{ Str::limit($faq->question_en, 60) }}</td>
                            <td>{{ $faq->category }}</td>
                            <td>{{ $faq->display_order }}</td>
                            <td><span class="badge bg-{{ $faq->is_active ? 'success' : 'secondary' }}">{{ $faq->is_active ? 'Yes' : 'No' }}</span></td>
                            <td class="table-actions">
                                <a href="{{ route('admin.faqs.edit', $faq) }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
                                <form action="{{ route('admin.faqs.destroy', $faq) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete?')">@csrf @method('DELETE')<button type="submit" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button></form>
                            </td>
                        </tr>
                    @empty<tr><td colspan="5" class="text-center text-muted">No FAQs</td></tr>@endforelse
                </tbody>
            </table>
        </div>
        {{ $faqs->links() }}
    </div>
</div>
@endsection
