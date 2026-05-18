@extends('layouts.admin')

@section('title', 'Add Program')

@section('content')
<div class="flex items-center justify-between mb-8">
    <h2 class="text-2xl font-bold text-text">Add Program</h2>
    <a href="{{ route('admin.programs.index') }}" class="inline-flex items-center gap-2 px-4 py-2 border border-border text-text-muted rounded-lg hover:bg-surface-secondary transition-colors text-sm"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><path d="m12 19-7-7 7-7"/><path d="M19 12H5"/></svg> Back</a>
</div>
<div class="bg-surface rounded-xl border border-border">
    <div class="p-6">
        <form action="{{ route('admin.programs.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
                <div class="lg:col-span-1"><label class="block text-sm font-medium text-text mb-1.5">Name (EN) *</label><input type="text" name="name_en" class="w-full rounded-lg border border-border px-3 py-2 text-sm text-text bg-surface focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary" required></div>
                <div class="lg:col-span-1"><label class="block text-sm font-medium text-text mb-1.5">Name (AR)</label><input type="text" name="name_ar" class="w-full rounded-lg border border-border px-3 py-2 text-sm text-text bg-surface focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary"></div>
                <div class="lg:col-span-1"><label class="block text-sm font-medium text-text mb-1.5">Slug</label><input type="text" name="slug" class="w-full rounded-lg border border-border px-3 py-2 text-sm text-text bg-surface focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary"></div>
                
                <div class="lg:col-span-1"><label class="block text-sm font-medium text-text mb-1.5">Service</label><select name="service_id" class="w-full rounded-lg border border-border px-3 py-2 text-sm text-text bg-surface focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary"><option value="">None</option>@foreach($services as $s)<option value="{{ $s->id }}">{{ $s->name_en }}</option>@endforeach</select></div>
                <div class="lg:col-span-1"><label class="block text-sm font-medium text-text mb-1.5">Program Type *</label><select name="program_type" class="w-full rounded-lg border border-border px-3 py-2 text-sm text-text bg-surface focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary" required><option value="group">Group</option><option value="individual">Individual</option><option value="workshop">Workshop</option></select></div>
                <div class="lg:col-span-1"><label class="block text-sm font-medium text-text mb-1.5">Level</label><select name="level" class="w-full rounded-lg border border-border px-3 py-2 text-sm text-text bg-surface focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary"><option value="">None</option><option value="beginner">Beginner</option><option value="intermediate">Intermediate</option><option value="advanced">Advanced</option></select></div>
                
                <div class="lg:col-span-1"><label class="block text-sm font-medium text-text mb-1.5">Duration</label><input type="text" name="duration" class="w-full rounded-lg border border-border px-3 py-2 text-sm text-text bg-surface focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary" placeholder="e.g. 8 weeks"></div>
                <div class="lg:col-span-1"><label class="block text-sm font-medium text-text mb-1.5">Sessions</label><input type="number" name="session_count" class="w-full rounded-lg border border-border px-3 py-2 text-sm text-text bg-surface focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary"></div>
                <div class="lg:col-span-1"><label class="block text-sm font-medium text-text mb-1.5">Max Participants</label><input type="number" name="max_participants" class="w-full rounded-lg border border-border px-3 py-2 text-sm text-text bg-surface focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary"></div>
                
                <div class="lg:col-span-1"><label class="block text-sm font-medium text-text mb-1.5">Price/Session</label><input type="number" step="0.01" name="price_per_session" class="w-full rounded-lg border border-border px-3 py-2 text-sm text-text bg-surface focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary"></div>
                <div class="lg:col-span-1"><label class="block text-sm font-medium text-text mb-1.5">Full Price</label><input type="number" step="0.01" name="full_program_price" class="w-full rounded-lg border border-border px-3 py-2 text-sm text-text bg-surface focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary"></div>
                <div class="lg:col-span-1"><label class="block text-sm font-medium text-text mb-1.5">Currency</label><select name="currency" class="w-full rounded-lg border border-border px-3 py-2 text-sm text-text bg-surface focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary"><option value="SAR">SAR</option><option value="USD">USD</option></select></div>
                
                <div class="lg:col-span-1"><label class="block text-sm font-medium text-text mb-1.5">Start Date</label><input type="date" name="start_date" class="w-full rounded-lg border border-border px-3 py-2 text-sm text-text bg-surface focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary"></div>
                <div class="lg:col-span-1"><label class="block text-sm font-medium text-text mb-1.5">End Date</label><input type="date" name="end_date" class="w-full rounded-lg border border-border px-3 py-2 text-sm text-text bg-surface focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary"></div>
                <div class="lg:col-span-1"><label class="block text-sm font-medium text-text mb-1.5">Facilitator</label><select name="facilitator_provider_id" class="w-full rounded-lg border border-border px-3 py-2 text-sm text-text bg-surface focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary"><option value="">None</option>@foreach($providers as $p)<option value="{{ $p->id }}">{{ $p->user?->full_name }}</option>@endforeach</select></div>
                
                <div class="lg:col-span-3"><label class="block text-sm font-medium text-text mb-1.5">Image</label><input type="file" name="image" class="w-full rounded-lg border border-border px-3 py-2 text-sm text-text bg-surface focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary" accept="image/*"></div>
                <div class="lg:col-span-3"><label class="block text-sm font-medium text-text mb-1.5">Description (EN) *</label><textarea name="description_en" class="w-full rounded-lg border border-border px-3 py-2 text-sm text-text bg-surface focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary" rows="3" required></textarea></div>
                <div class="lg:col-span-3"><label class="block text-sm font-medium text-text mb-1.5">Description (AR)</label><textarea name="description_ar" class="w-full rounded-lg border border-border px-3 py-2 text-sm text-text bg-surface focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary" rows="3"></textarea></div>
                <div class="lg:col-span-3"><label class="block text-sm font-medium text-text mb-1.5">What You Will Learn (EN) - one per line</label><textarea name="what_you_will_learn_en" class="w-full rounded-lg border border-border px-3 py-2 text-sm text-text bg-surface focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary" rows="3"></textarea></div>
                <div class="lg:col-span-3"><label class="block text-sm font-medium text-text mb-1.5">What You Will Learn (AR) - one per line</label><textarea name="what_you_will_learn_ar" class="w-full rounded-lg border border-border px-3 py-2 text-sm text-text bg-surface focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary" rows="3"></textarea></div>
                
                <div class="flex items-center gap-2"><input type="checkbox" name="is_featured" value="1" class="w-4 h-4 text-primary border-border rounded focus:ring-primary"><label class="text-sm font-medium text-text">Featured</label></div>
                <div class="flex items-center gap-2"><input type="checkbox" name="is_active" value="1" checked class="w-4 h-4 text-primary border-border rounded focus:ring-primary"><label class="text-sm font-medium text-text">Active</label></div>
            </div>
            <button type="submit" class="px-4 py-2.5 bg-primary text-white rounded-lg hover:bg-primary-hover transition-colors text-sm font-medium">Save Program</button>
        </form>
    </div>
</div>
@endsection
