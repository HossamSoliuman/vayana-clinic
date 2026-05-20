<header class="site-header" data-site-header>
    <nav class="site-nav" aria-label="Primary">
        <div class="site-nav__inner">
            <a class="site-nav__brand" href="{{ route('home') }}" aria-label="Vayana Home">
                <img src="{{ asset('images/logo.png') }}" alt="Vayana" width="160" height="44" decoding="async">
            </a>

            <button class="site-nav__toggle" type="button" data-nav-toggle aria-label="Open menu" aria-controls="siteNavPanel" aria-expanded="false">
                <span class="site-nav__toggle-bars" aria-hidden="true"></span>
            </button>

            <div class="site-nav__panel" id="siteNavPanel" data-nav-panel>
                <div class="site-nav__panel-head">
                    <span class="site-nav__panel-title">Menu</span>
                    <button class="site-nav__close" type="button" data-nav-close aria-label="Close menu">×</button>
                </div>

                <ul class="site-nav__links">
                    <li><a class="site-nav__link" href="{{ route('about') }}">{{ __('messages.about') }}</a></li>
                    <li><a class="site-nav__link" href="{{ route('services.index') }}">{{ __('messages.services') }}</a></li>
                    <li><a class="site-nav__link" href="{{ route('providers.index') }}">{{ __('messages.providers') }}</a></li>
                    <li><a class="site-nav__link" href="{{ route('resources.index') }}">{{ __('messages.resources') }}</a></li>
                    <li><a class="site-nav__link" href="{{ route('journal.index') }}">{{ __('messages.journal') }}</a></li>
                    <li><a class="site-nav__link" href="{{ route('business.index') }}">{{ __('messages.for_business') }}</a></li>
                </ul>

                <div class="site-nav__actions">
                    <div class="lang-switch" role="group" aria-label="Language switch">
                        <a class="lang-switch__opt {{ app()->getLocale() === 'en' ? 'is-active' : '' }}" href="{{ route('language.switch', 'en') }}">EN</a>
                        <a class="lang-switch__opt {{ app()->getLocale() === 'ar' ? 'is-active' : '' }}" href="{{ route('language.switch', 'ar') }}">عربي</a>
                    </div>

                    @auth
                        <div class="site-nav__user">
                            <button class="site-nav__user-btn" type="button" data-user-toggle aria-expanded="false">
                                {{ auth()->user()->full_name }}
                                <i class="bi bi-chevron-down" aria-hidden="true"></i>
                            </button>
                            <div class="site-nav__user-menu" data-user-menu>
                                <a class="site-nav__user-item" href="{{ route('dashboard') }}">{{ __('messages.dashboard') }}</a>
                                <a class="site-nav__user-item" href="{{ route('profile.edit') }}">{{ __('messages.profile') }}</a>
                                @if (in_array(auth()->user()->role, ['admin', 'super_admin']))
                                    <a class="site-nav__user-item" href="{{ route('admin.dashboard') }}">{{ __('messages.admin_panel') }}</a>
                                @endif
                                <!-- Form container wrapped cleanly to secure mobile flex heights -->
                                <div class="site-nav__user-logout-wrapper">
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="site-nav__user-item site-nav__user-item--danger">{{ __('messages.logout') }}</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @else
                        <a class="site-nav__text" href="{{ route('login') }}">{{ __('messages.login') }}</a>
                        <a class="site-nav__btn" href="{{ route('join-us.index') }}">
                            {{ __('messages.join_us') }}
                            <span aria-hidden="true">↗</span>
                        </a>
                    @endauth
                </div>
            </div>
        </div>

        <!-- Positioned right behind the action drawer to fix backdrop rendering order -->
        <div class="site-nav__backdrop" data-nav-backdrop hidden></div>
    </nav>
</header>
