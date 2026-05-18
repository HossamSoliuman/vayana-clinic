@extends('layouts.admin')

@section('title', 'Journal Prompts')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4"><h2>Journal Prompts</h2></div>
<div class="row g-4">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">Add New Prompt</div>
            <div class="card-body">
                <form action="{{ route('admin.journal-prompts.store') }}" method="POST">
                    @csrf
                    <div class="mb-3"><label class="form-label">Prompt (EN) *</label><textarea name="prompt_text_en" class="form-control" rows="3" required></textarea></div>
                    <div class="mb-3"><label class="form-label">Prompt (AR)</label><textarea name="prompt_text_ar" class="form-control" rows="3"></textarea></div>
                    <div class="mb-3"><label class="form-label">Category</label><select name="category" class="form-select"><option value="gratitude">Gratitude</option><option value="reflection" selected>Reflection</option><option value="emotion">Emotion</option><option value="goal_setting">Goal Setting</option><option value="mindfulness">Mindfulness</option></select></div>
                    <div class="mb-3"><label class="form-label">Order</label><input type="number" name="display_order" class="form-control" value="0"></div>
                    <div class="mb-3"><label class="form-label d-block">Active</label><div class="form-check form-check-inline"><input class="form-check-input" type="checkbox" name="is_active" value="1" checked><label class="form-check-label">Yes</label></div></div>
                    <button type="submit" class="btn btn-primary">Add Prompt</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead><tr><th>Prompt (EN)</th><th>Category</th><th>Order</th><th>Active</th><th>Actions</th></tr></thead>
                        <tbody>
                            @forelse($prompts as $prompt)
                                <tr>
                                    <td>{{ Str::limit($prompt->prompt_text_en, 60) }}</td>
                                    <td>{{ $prompt->category }}</td>
                                    <td>{{ $prompt->display_order }}</td>
                                    <td><span class="badge bg-{{ $prompt->is_active ? 'success' : 'secondary' }}">{{ $prompt->is_active ? 'Yes' : 'No' }}</span></td>
                                    <td class="table-actions">
                                        <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editPrompt{{ $prompt->id }}"><i class="bi bi-pencil"></i></button>
                                        <form action="{{ route('admin.journal-prompts.destroy', $prompt) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete?')">@csrf @method('DELETE')<button type="submit" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button></form>
                                    </td>
                                </tr>
                                <div class="modal fade" id="editPrompt{{ $prompt->id }}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="{{ route('admin.journal-prompts.update', $prompt) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-header"><h5 class="modal-title">Edit Prompt</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
                                                <div class="modal-body">
                                                    <div class="mb-3"><label class="form-label">Prompt (EN) *</label><textarea name="prompt_text_en" class="form-control" rows="3" required>{{ $prompt->prompt_text_en }}</textarea></div>
                                                    <div class="mb-3"><label class="form-label">Prompt (AR)</label><textarea name="prompt_text_ar" class="form-control" rows="3">{{ $prompt->prompt_text_ar }}</textarea></div>
                                                    <div class="mb-3"><label class="form-label">Category</label><select name="category" class="form-select"><option value="gratitude" {{ $prompt->category=='gratitude'?'selected':'' }}>Gratitude</option><option value="reflection" {{ $prompt->category=='reflection'?'selected':'' }}>Reflection</option><option value="emotion" {{ $prompt->category=='emotion'?'selected':'' }}>Emotion</option><option value="goal_setting" {{ $prompt->category=='goal_setting'?'selected':'' }}>Goal Setting</option><option value="mindfulness" {{ $prompt->category=='mindfulness'?'selected':'' }}>Mindfulness</option></select></div>
                                                    <div class="mb-3"><label class="form-label">Order</label><input type="number" name="display_order" class="form-control" value="{{ $prompt->display_order }}"></div>
                                                    <div class="mb-3"><label class="form-label d-block">Active</label><div class="form-check form-check-inline"><input class="form-check-input" type="checkbox" name="is_active" value="1" {{ $prompt->is_active?'checked':'' }}><label class="form-check-label">Yes</label></div></div>
                                                </div>
                                                <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button><button type="submit" class="btn btn-primary">Update</button></div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @empty<tr><td colspan="5" class="text-center text-muted">No prompts</td></tr>@endforelse
                        </tbody>
                    </table>
                </div>
                {{ $prompts->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
