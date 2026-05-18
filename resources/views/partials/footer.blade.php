<footer class="bg-light border-top mt-5 py-4">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h5>Vayana</h5>
                <p class="text-muted small">{{ App\Models\SiteSetting::get('footer_description_' . app()->getLocale(), 'Mental Health & Wellness Platform') }}</p>
            </div>
            <div class="col-md-4">
                <h6>Quick Links</h6>
                <ul class="list-unstyled small">
                    <li><a href="{{ route('services.index') }}" class="text-decoration-none text-muted">{{ __('messages.services') }}</a></li>
                    <li><a href="{{ route('providers.index') }}" class="text-decoration-none text-muted">{{ __('messages.providers') }}</a></li>
                    <li><a href="{{ route('join-us.index') }}" class="text-decoration-none text-muted">{{ __('messages.join_us') }}</a></li>
                    <li><a href="{{ route('faqs.index') }}" class="text-decoration-none text-muted">{{ __('messages.faqs') }}</a></li>
                </ul>
            </div>
            <div class="col-md-4">
                <h6>Contact</h6>
                <ul class="list-unstyled small text-muted">
                    <li><i class="bi bi-envelope"></i> {{ App\Models\SiteSetting::get('contact_email', 'info@vayana.sa') }}</li>
                    <li><i class="bi bi-telephone"></i> {{ App\Models\SiteSetting::get('contact_phone', '') }}</li>
                </ul>
            </div>
        </div>
        <hr>
        <div class="text-center small text-muted">
            &copy; {{ date('Y') }} Vayana. All rights reserved.
        </div>
    </div>
</footer>
