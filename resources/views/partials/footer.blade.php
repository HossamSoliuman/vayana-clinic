<footer style="background-image: url('{{ asset('images/footer/footer_bg.png') }}'); background-size: cover; background-position: center; background-repeat: no-repeat;" class="site-footer" aria-label="Footer">
    <div class="site-footer__bg" aria-hidden="true"></div>

    <div class="site-footer__inner">
        <!-- Logo + Social -->
        <div class="site-footer__top">
            <div class="site-footer__brand">
                <img src="{{ asset('images/footer/logo_footer.png') }}" alt="Vayana" width="120" height="56">

                <div class="site-footer__social" aria-label="Social links">
                    <a href="#" aria-label="Visit our Facebook page">
                        <img src="{{ asset('images/footer/facebook.png') }}" alt="" width="24" height="24" loading="lazy" decoding="async">
                    </a>
                    <a href="#" aria-label="Visit our Instagram profile">
                        <img src="{{ asset('images/footer/instagram.png') }}" alt="" width="24" height="24" loading="lazy" decoding="async">
                    </a>
                    <a href="#" aria-label="Visit our LinkedIn profile">
                        <img src="{{ asset('images/footer/linkedin.png') }}" alt="" width="24" height="24" loading="lazy" decoding="async">
                    </a>
                    <a href="#" aria-label="Visit our YouTube channel">
                        <img src="{{ asset('images/footer/youtube.png') }}" alt="" width="24" height="24" loading="lazy" decoding="async">
                    </a>
                    <a href="#" aria-label="Visit our Snapchat profile">
                        <img src="{{ asset('images/footer/mage_snapchat.png') }}" alt="" width="24" height="24" loading="lazy" decoding="async">
                    </a>
                    <a href="#" aria-label="Visit our TikTok channel">
                        <img src="{{ asset('images/footer/tiktok.png') }}" alt="" width="24" height="24" loading="lazy" decoding="async">
                    </a>
                </div>
            </div>
        </div>

        <!-- Horizontal Links Row -->
        <nav class="site-footer__nav" aria-label="Footer navigation">
            <ul class="site-footer__nav-list">
                <li><a href="{{ route('faqs.index') }}">FAQ</a></li>
                <li><a href="#">Subscription</a></li>
                <li><a href="#">Terms</a></li>
                <li><a href="#">Cookies</a></li>
                <li><a href="{{ route('about') }}">Contact</a></li>
            </ul>
        </nav>

        <!-- Description -->
        <p class="site-footer__desc">
            {{ App\Models\SiteSetting::get('footer_description_' . app()->getLocale(), 'Vayana is dedicated to supporting mental health and well-being. We connect individuals with trusted therapists and safe spaces. Your journey to healing and growth starts here.') }}
        </p>

        <!-- Bottom Copyright -->
        <div class="site-footer__bottom">
            <p>© {{ date('Y') }} Vayana. All Rights Reserved</p>
        </div>
    </div>
</footer>
