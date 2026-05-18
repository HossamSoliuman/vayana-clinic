@extends('layouts.admin')

@section('title', 'Settings')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4"><h2>Site Settings</h2></div>
<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.settings.update') }}" method="POST">
            @csrf
            <ul class="nav nav-tabs mb-3" role="tablist">
                @foreach($groups as $g)
                    <li class="nav-item" role="presentation">
                        <button class="nav-link {{ $loop->first ? 'active' : '' }}" data-bs-toggle="tab" data-bs-target="#tab-{{ $g }}" type="button" role="tab">{{ ucfirst($g) }}</button>
                    </li>
                @endforeach
            </ul>
            <div class="tab-content">
                @foreach($groups as $g)
                    <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="tab-{{ $g }}" role="tabpanel">
                        <div class="row">
                            @php $groupSettings = $settings->get($g, collect()); @endphp
                            @forelse($groupSettings as $s)
                                <div class="col-md-6 mb-3">
                                    <label class="form-label text-capitalize">{{ str_replace(['_en', '_ar', '_'], [' (EN)', ' (AR)', ' '], $s->key) }}</label>
                                    @if($s->type === 'boolean')
                                        <div class="form-check"><input class="form-check-input" type="checkbox" name="{{ $s->key }}" value="1" {{ $s->value ? 'checked' : '' }}></div>
                                    @elseif($s->type === 'text')
                                        <textarea name="{{ $s->key }}" class="form-control" rows="3">{{ $s->value }}</textarea>
                                    @else
                                        <input type="text" name="{{ $s->key }}" class="form-control" value="{{ $s->value }}">
                                    @endif
                                </div>
                            @empty
                                <div class="col-12 text-muted">No settings in this group.</div>
                            @endforelse
                        </div>
                    </div>
                @endforeach
            </div>
            <hr>
            <button type="submit" class="btn btn-primary">Save All Settings</button>
        </form>
    </div>
</div>
@endsection
