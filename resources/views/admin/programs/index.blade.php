@extends('layouts.admin')

@section('title', 'Programs')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Therapy Programs</h2>
    <a href="{{ route('admin.programs.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Add Program</a>
</div>
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead><tr><th>Name</th><th>Type</th><th>Duration</th><th>Price</th><th>Featured</th><th>Active</th><th>Actions</th></tr></thead>
                <tbody>
                    @forelse($programs as $program)
                        <tr>
                            <td>{{ $program->name_en }}</td>
                            <td>{{ $program->program_type }}</td>
                            <td>{{ $program->duration ?? 'N/A' }}</td>
                            <td>{{ $program->full_program_price ?? $program->price_per_session ?? 'N/A' }} {{ $program->currency }}</td>
                            <td><span class="badge bg-{{ $program->is_featured ? 'success' : 'secondary' }}">{{ $program->is_featured ? 'Yes' : 'No' }}</span></td>
                            <td><span class="badge bg-{{ $program->is_active ? 'success' : 'secondary' }}">{{ $program->is_active ? 'Yes' : 'No' }}</span></td>
                            <td class="table-actions">
                                <a href="{{ route('admin.programs.edit', $program) }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
                                <form action="{{ route('admin.programs.destroy', $program) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @empty<tr><td colspan="7" class="text-center text-muted">No programs</td></tr>@endforelse
                </tbody>
            </table>
        </div>
        {{ $programs->links() }}
    </div>
</div>
@endsection
