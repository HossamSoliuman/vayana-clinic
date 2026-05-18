@extends('layouts.admin')

@section('title', 'Edit Program')

@section('content')
<div class="flex items-center justify-between mb-8">
    <h2 class="text-2xl font-bold text-text">{{ __('messages.edit_program') }}</h2>
    <a href="{{ route('admin.programs.index') }}" class="inline-flex items-center gap-2 px-4 py-2 border border-border text-text-muted rounded-lg hover:bg-surface-secondary transition-colors text-sm"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><path d="m12 19-7-7 7-7"/><path d="M19 12H5"/></svg> Back</a>
</div>
<div class="bg-surface rounded-xl border border-border">
    <div class="p-6">
        <form action="{{ route('admin.programs.update', $program) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
                <div class="lg:col-span-1"><label class="block text-sm font-medium text-text mb-1.5">Name (EN) *</label><input type="text" name="name_en" class="w-full rounded-lg border border-border px-3 py-2 text-sm text-text bg-surface focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary" value="{{ $program->name_en }}" required></div>
                <div class="lg:col-span-1"><label class="block text-sm font-medium text-text mb-1.5">Name (AR)</label><input type="text" name="name_ar" class="w-full rounded-lg border border-border px-3 py-2 text-sm text-text bg-surface focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary" value="{{ $program->name_ar }}"></div>
                <div class="lg:col-span-1"><label class="block text-sm font-medium text-text mb-1.5">{{ __('messages.slug') }}</label><input type="text" name="slug" class="w-full rounded-lg border border-border px-3 py-2 text-sm text-text bg-surface focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary" value="{{ $program->slug }}"></div>
                
                <div class="lg:col-span-1"><label class="block text-sm font-medium text-text mb-1.5">{{ __('messages.service') }}</label><select name="service_id" class="w-full rounded-lg border border-border px-3 py-2 text-sm text-text bg-surface focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary"><option value="">{{ __('messages.none') }}</option>@foreach($services as $s)<option value="{{ $s->id }}" {{ $program->service_id==$s->id?'selected':'' }}>{{ $s->name_en }}</option>@endforeach</select></div>
                <div class="lg:col-span-1"><label class="block text-sm font-medium text-text mb-1.5">Program Type *</label><select name="program_type" class="w-full rounded-lg border border-border px-3 py-2 text-sm text-text bg-surface focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary" required><option value="group" {{ $program->program_type=='group'?'selected':'' }}>Group</option><option value="individual" {{ $program->program_type=='individual'?'selected':'' }}>Individual</option><option value="workshop" {{ $program->program_type=='workshop'?'selected':'' }}>Workshop</option></select></div>
                <div class="lg:col-span-1"><label class="block text-sm font-medium text-text mb-1.5">{{ __('messages.level') }}</label><select name="level" class="w-full rounded-lg border border-border px-3 py-2 text-sm text-text bg-surface focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary"><option value="">{{ __('messages.none') }}</option><option value="beginner" {{ $program->level=='beginner'?'selected':'' }}>Beginner</option><option value="intermediate" {{ $program->level=='intermediate'?'selected':'' }}>Intermediate</option><option value="advanced" {{ $program->level=='advanced'?'selected':'' }}>Advanced</option></select></div>
                
                <div class="lg:col-span-1"><label class="block text-sm font-medium text-text mb-1.5">{{ __('messages.duration') }}</label><input type="text" name="duration" class="w-full rounded-lg border border-border px-3 py-2 text-sm text-text bg-surface focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary" value="{{ $program->duration }}"></div>
                <div class="lg:col-span-1"><label class="block text-sm font-medium text-text mb-1.5">{{ __('messages.sessions') }}</label><input type="number" name="session_count" class="w-full rounded-lg border border-border px-3 py-2 text-sm text-text bg-surface focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary" value="{{ $program->session_count }}"></div>
                <div class="lg:col-span-1"><label class="block text-sm font-medium text-text mb-1.5">{{ __('messages.max_participants') }}</label><input type="number" name="max_participants" class="w-full rounded-lg border border-border px-3 py-2 text-sm text-text bg-surface focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary" value="{{ $program->max_participants }}"></div>
                
                <div class="lg:col-span-1"><label class="block text-sm font-medium text-text mb-1.5">Price/Session</label><input type="number" step="0.01" name="price_per_session" class="w-full rounded-lg border border-border px-3 py-2 text-sm text-text bg-surface focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary" value="{{ $program->price_per_session }}"></div>
                <div class="lg:col-span-1"><label class="block text-sm font-medium text-text mb-1.5">{{ __('messages.full_price') }}</label><input type="number" step="0.01" name="full_program_price" class="w-full rounded-lg border border-border px-3 py-2 text-sm text-text bg-surface focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary" value="{{ $program->full_program_price }}"></div>
                <div class="lg:col-span-1"><label class="block text-sm font-medium text-text mb-1.5">{{ __('messages.currency') }}</label><select name="currency" class="w-full rounded-lg border border-border px-3 py-2 text-sm text-text bg-surface focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary"><option value="SAR" {{ $program->currency=='SAR'?'selected':'' }}>SAR</option><option value="USD" {{ $program->currency=='USD'?'selected':'' }}>USD</option></select></div>
                
                <div class="lg:col-span-1"><label class="block text-sm font-medium text-text mb-1.5">{{ __('messages.start_date') }}</label><input type="date" name="start_date" class="w-full rounded-lg border border-border px-3 py-2 text-sm text-text bg-surface focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary" value="{{ $program->start_date?->format('Y-m-d') }}"></div>
                <div class="lg:col-span-1"><label class="block text-sm font-medium text-text mb-1.5">{{ __('messages.end_date') }}</label><input type="date" name="end_date" class="w-full rounded-lg border border-border px-3 py-2 text-sm text-text bg-surface focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary" value="{{ $program->end_date?->format('Y-m-d') }}"></div>
                <div class="lg:col-span-1"><label class="block text-sm font-medium text-text mb-1.5">{{ __('messages.facilitator') }}</label><select name="facilitator_provider_id" class="w-full rounded-lg border border-border px-3 py-2 text-sm text-text bg-surface focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary"><option value="">{{ __('messages.none') }}</option>@foreach($providers as $p)<option value="{{ $p->id }}" {{ $program->facilitator_provider_id==$p->id?'selected':'' }}>{{ $p->user?->full_name }}</option>@endforeach</select></div>
                
                <div class="lg:col-span-3">
                    <label class="block text-sm font-medium text-text mb-1.5">{{ __('messages.image') }}</label>
                    <input type="file" name="image" class="w-full rounded-lg border border-border px-3 py-2 text-sm text-text bg-surface focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary" accept="image/*">
                    @if($program->image)<div class="mt-2"><img src="{{ asset('storage/'.$program->image) }}" class="h-16 rounded border border-border object-cover"></div>@endif
                </div>
                <div class="lg:col-span-3"><label class="block text-sm font-medium text-text mb-1.5">Description (EN) *</label><textarea name="description_en" class="w-full rounded-lg border border-border px-3 py-2 text-sm text-text bg-surface focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary" rows="3" required>{{ $program->description_en }}</textarea></div>
                <div class="lg:col-span-3"><label class="block text-sm font-medium text-text mb-1.5">Description (AR)</label><textarea name="description_ar" class="w-full rounded-lg border border-border px-3 py-2 text-sm text-text bg-surface focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary" rows="3">{{ $program->description_ar }}</textarea></div>
                
                <div class="flex items-center gap-2"><input type="checkbox" name="is_featured" value="1" {{ $program->is_featured?'checked':'' }} class="w-4 h-4 text-primary border-border rounded focus:ring-primary"><label class="text-sm font-medium text-text">{{ __('messages.featured') }}</label></div>
                <div class="flex items-center gap-2"><input type="checkbox" name="is_active" value="1" {{ $program->is_active?'checked':'' }} class="w-4 h-4 text-primary border-border rounded focus:ring-primary"><label class="text-sm font-medium text-text">{{ __('messages.active') }}</label></div>
            </div>
            <button type="submit" class="px-4 py-2.5 bg-primary text-white rounded-lg hover:bg-primary-hover transition-colors text-sm font-medium">{{ __('messages.update_program') }}</button>
        </form>
    </div>
</div>
@endsection
