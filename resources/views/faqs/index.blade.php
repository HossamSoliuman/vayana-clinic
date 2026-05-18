@extends('layouts.app')

@section('title', __('messages.faqs'))

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <h1 class="mb-4">{{ __('messages.faqs') }}</h1>
            @forelse($faqs as $category => $items)
                <h4 class="mt-4 mb-3 text-primary">{{ ucfirst($category) }}</h4>
                <div class="accordion" id="faq{{ $loop->index }}">
                    @foreach($items as $faq)
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button {{ !$loop->first ? 'collapsed' : '' }}" type="button" data-bs-toggle="collapse" data-bs-target="#faq{{ $loop->parent->index }}_{{ $loop->index }}">
                                    {{ $faq->localized_question }}
                                </button>
                            </h2>
                            <div id="faq{{ $loop->parent->index }}_{{ $loop->index }}" class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}" data-bs-parent="#faq{{ $loop->parent->index }}">
                                <div class="accordion-body">
                                    {{ $faq->localized_answer }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @empty
                <div class="text-center text-muted">No FAQs available.</div>
            @endforelse
        </div>
    </div>
</div>
@endsection
