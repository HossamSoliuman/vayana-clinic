@extends('layouts.admin')

@section('title', 'Settings')

@section('content')
<div class="flex items-center justify-between mb-8">
    <h2 class="text-2xl font-bold text-text">Site Settings</h2>
</div>
<div class="bg-surface rounded-xl border border-border overflow-hidden">
    <form action="{{ route('admin.settings.update') }}" method="POST">
        @csrf
        <div class="flex overflow-x-auto border-b border-border" role="tablist">
            @foreach($groups as $g)
                <button type="button" class="px-6 py-4 text-sm font-medium border-b-2 whitespace-nowrap transition-colors {{ $loop->first ? 'text-primary border-primary bg-primary/5' : 'text-text-muted border-transparent hover:text-text hover:bg-surface-secondary' }}" data-bs-toggle="tab" data-bs-target="#tab-{{ $g }}" role="tab" onclick="switchTab('tab-{{ $g }}', 'settings-tab')">{{ ucfirst($g) }}</button>
            @endforeach
        </div>
        <div class="p-6">
            <div class="tab-content">
                @foreach($groups as $g)
                    <div class="settings-tab {{ $loop->first ? 'block' : 'hidden' }}" id="tab-{{ $g }}" role="tabpanel">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            @php $groupSettings = $settings->get($g, collect()); @endphp
                            @forelse($groupSettings as $s)
                                <div class="col-span-1">
                                    <label class="block text-sm font-medium text-text mb-1.5 capitalize">{{ str_replace(['_en', '_ar', '_'], [' (EN)', ' (AR)', ' '], $s->key) }}</label>
                                    @if($s->type === 'boolean')
                                        <div class="flex items-center gap-2 h-10"><input type="checkbox" name="{{ $s->key }}" value="1" {{ $s->value ? 'checked' : '' }} class="w-4 h-4 text-primary border-border rounded focus:ring-primary"><label class="text-sm text-text">Enabled</label></div>
                                    @elseif($s->type === 'text')
                                        <textarea name="{{ $s->key }}" class="w-full rounded-lg border border-border px-3 py-2 text-sm text-text bg-surface focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary" rows="3">{{ $s->value }}</textarea>
                                    @else
                                        <input type="text" name="{{ $s->key }}" class="w-full rounded-lg border border-border px-3 py-2 text-sm text-text bg-surface focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary" value="{{ $s->value }}">
                                    @endif
                                </div>
                            @empty
                                <div class="col-span-1 md:col-span-2 text-text-muted">No settings in this group.</div>
                            @endforelse
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="px-6 py-4 border-t border-border bg-surface-secondary flex justify-end">
            <button type="submit" class="px-4 py-2.5 bg-primary text-white rounded-lg hover:bg-primary-hover transition-colors text-sm font-medium">Save All Settings</button>
        </div>
    </form>
</div>

<script>
    function switchTab(tabId, groupClass) {
        document.querySelectorAll('.' + groupClass).forEach(el => el.classList.add('hidden'));
        document.getElementById(tabId).classList.remove('hidden');
        
        event.currentTarget.parentElement.querySelectorAll('button').forEach(btn => {
            btn.classList.remove('text-primary', 'border-primary', 'bg-primary/5');
            btn.classList.add('text-text-muted', 'border-transparent');
        });
        
        event.currentTarget.classList.remove('text-text-muted', 'border-transparent');
        event.currentTarget.classList.add('text-primary', 'border-primary', 'bg-primary/5');
    }
</script>
@endsection
