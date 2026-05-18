@extends('layouts.admin')

@section('title', 'Resources')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Resources</h2>
    <a href="{{ route('admin.resources.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Add Resource</a>
</div>
<div class="card">
    <div class="card-body">
        <form method="GET" class="row g-3 mb-3">
            <div class="col-md-3">
                <select name="type" class="form-select" onchange="this.form.submit()">
                    <option value="">All Types</option>
                    <option value="blog_article" {{ request('type')=='blog_article'?'selected':'' }}>Blog Article</option>
                    <option value="audio" {{ request('type')=='audio'?'selected':'' }}>Audio</option>
                    <option value="self_help_ebook" {{ request('type')=='self_help_ebook'?'selected':'' }}>eBook</option>
                    <option value="video" {{ request('type')=='video'?'selected':'' }}>Video</option>
                    <option value="guided_meditation" {{ request('type')=='guided_meditation'?'selected':'' }}>Meditation</option>
                    <option value="mental_health_conversation" {{ request('type')=='mental_health_conversation'?'selected':'' }}>Conversation</option>
                    <option value="assessment" {{ request('type')=='assessment'?'selected':'' }}>Assessment</option>
                </select>
            </div>
        </form>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead><tr><th>Title</th><th>Type</th><th>Category</th><th>Views</th><th>Active</th><th>Published</th><th>Actions</th></tr></thead>
                <tbody>
                    @forelse($resources as $resource)
                        <tr>
                            <td>{{ $resource->title_en }}</td>
                            <td>{{ $resource->type }}</td>
                            <td>{{ $resource->category?->name_en ?? 'N/A' }}</td>
                            <td>{{ $resource->view_count }}</td>
                            <td><span class="badge bg-{{ $resource->is_active ? 'success' : 'secondary' }}">{{ $resource->is_active ? 'Yes' : 'No' }}</span></td>
                            <td>{{ $resource->published_at?->format('M d, Y') ?? 'Draft' }}</td>
                            <td class="table-actions">
                                <a href="{{ route('admin.resources.edit', $resource) }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
                                <form action="{{ route('admin.resources.destroy', $resource) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @empty<tr><td colspan="7" class="text-center text-muted">No resources</td></tr>@endforelse
                </tbody>
            </table>
        </div>
        {{ $resources->links() }}
    </div>
</div>
@endsection
