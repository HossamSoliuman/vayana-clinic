<nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ route('home') }}">Vayana</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="mainNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">{{ __('messages.home') }}</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('about') }}">{{ __('messages.about') }}</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('services.index') }}">{{ __('messages.services') }}</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('providers.index') }}">{{ __('messages.providers') }}</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('programs.index') }}">{{ __('messages.programs') }}</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('resources.index') }}">{{ __('messages.resources') }}</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('workshops.index') }}">{{ __('messages.workshops') }}</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('faqs.index') }}">{{ __('messages.faqs') }}</a></li>
            </ul>
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            {{ auth()->user()->full_name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ route('dashboard') }}"><i class="bi bi-speedometer2"></i> {{ __('messages.dashboard') }}</a></li>
                            <li><a class="dropdown-item" href="{{ route('profile.edit') }}"><i class="bi bi-person"></i> {{ __('messages.profile') }}</a></li>
                            @if(in_array(auth()->user()->role, ['admin', 'super_admin']))
                                <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}"><i class="bi bi-shield-lock"></i> {{ __('messages.admin_panel') }}</a></li>
                            @endif
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="dropdown-item"><i class="bi bi-box-arrow-right"></i> {{ __('messages.logout') }}</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">{{ __('messages.login') }}</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">{{ __('messages.register') }}</a></li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
