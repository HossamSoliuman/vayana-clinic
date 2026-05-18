<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', __('messages.admin_panel')) - {{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="bg-surface-secondary text-text font-sans antialiased">
    <div class="min-h-screen flex">
        <aside class="fixed inset-y-0 ltr:left-0 rtl:right-0 z-50 w-64 bg-sidebar text-sidebar-text overflow-y-auto">
            <div class="px-6 py-6 border-b border-sidebar-hover text-center">
                <h5 class="text-white text-xl font-bold">{{ config('app.name') }}</h5>
                <p class="text-sidebar-text text-xs mt-1 uppercase tracking-wider">{{ __('messages.admin_panel') }}</p>
            </div>
            <nav class="p-4 space-y-1">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm rounded-lg transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-sidebar-active text-sidebar-text-active' : 'hover:bg-sidebar-hover hover:text-sidebar-text-active' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5"><rect width="7" height="9" x="3" y="3" rx="1"/><rect width="7" height="5" x="14" y="3" rx="1"/><rect width="7" height="9" x="14" y="12" rx="1"/><rect width="7" height="5" x="3" y="16" rx="1"/></svg>
                    {{ __('messages.dashboard') }}
                </a>
                <a href="{{ route('admin.users.index') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm rounded-lg transition-colors {{ request()->routeIs('admin.users.*') ? 'bg-sidebar-active text-sidebar-text-active' : 'hover:bg-sidebar-hover hover:text-sidebar-text-active' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                    {{ __('messages.users') }}
                </a>
                <a href="{{ route('admin.providers.index') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm rounded-lg transition-colors {{ request()->routeIs('admin.providers.*') ? 'bg-sidebar-active text-sidebar-text-active' : 'hover:bg-sidebar-hover hover:text-sidebar-text-active' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><polyline points="16 11 18 13 22 9"/></svg>
                    {{ __('messages.providers') }}
                </a>
                <a href="{{ route('admin.applications.index') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm rounded-lg transition-colors {{ request()->routeIs('admin.applications.*') ? 'bg-sidebar-active text-sidebar-text-active' : 'hover:bg-sidebar-hover hover:text-sidebar-text-active' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5"><path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"/><path d="M14 2v4a2 2 0 0 0 2 2h4"/><path d="M10 9H8"/><path d="M16 13H8"/><path d="M16 17H8"/></svg>
                    {{ __('messages.applications') }}
                </a>
                <a href="{{ route('admin.appointments.index') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm rounded-lg transition-colors {{ request()->routeIs('admin.appointments.*') ? 'bg-sidebar-active text-sidebar-text-active' : 'hover:bg-sidebar-hover hover:text-sidebar-text-active' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/><path d="m9 16 2 2 4-4"/></svg>
                    {{ __('messages.appointments') }}
                </a>
                <a href="{{ route('admin.business-inquiries.index') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm rounded-lg transition-colors {{ request()->routeIs('admin.business-inquiries.*') ? 'bg-sidebar-active text-sidebar-text-active' : 'hover:bg-sidebar-hover hover:text-sidebar-text-active' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5"><path d="M6 22V4a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v18Z"/><path d="M6 12H4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h2"/><path d="M18 9h2a2 2 0 0 1 2 2v9a2 2 0 0 1-2 2h-2"/><path d="M10 6h4"/><path d="M10 10h4"/><path d="M10 14h4"/><path d="M10 18h4"/></svg>
                    {{ __('messages.business_inquiries') }}
                </a>
                <a href="{{ route('admin.services.index') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm rounded-lg transition-colors {{ request()->routeIs('admin.services.*') ? 'bg-sidebar-active text-sidebar-text-active' : 'hover:bg-sidebar-hover hover:text-sidebar-text-active' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5"><rect width="7" height="7" x="3" y="3" rx="1"/><rect width="7" height="7" x="14" y="3" rx="1"/><rect width="7" height="7" x="14" y="14" rx="1"/><rect width="7" height="7" x="3" y="14" rx="1"/></svg>
                    {{ __('messages.services') }}
                </a>
                <a href="{{ route('admin.programs.index') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm rounded-lg transition-colors {{ request()->routeIs('admin.programs.*') ? 'bg-sidebar-active text-sidebar-text-active' : 'hover:bg-sidebar-hover hover:text-sidebar-text-active' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg>
                    {{ __('messages.programs') }}
                </a>
                <a href="{{ route('admin.resources.index') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm rounded-lg transition-colors {{ request()->routeIs('admin.resources.*') ? 'bg-sidebar-active text-sidebar-text-active' : 'hover:bg-sidebar-hover hover:text-sidebar-text-active' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5"><path d="m16 6 4 14"/><path d="M12 6v14"/><path d="M8 8v12"/><path d="M4 4v16"/></svg>
                    {{ __('messages.resources') }}
                </a>
                <a href="{{ route('admin.workshops.index') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm rounded-lg transition-colors {{ request()->routeIs('admin.workshops.*') ? 'bg-sidebar-active text-sidebar-text-active' : 'hover:bg-sidebar-hover hover:text-sidebar-text-active' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5"><path d="M2 3h20"/><path d="M21 3v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V3"/><path d="m7 21 5-5 5 5"/></svg>
                    {{ __('messages.workshops') }}
                </a>
                <a href="{{ route('admin.reviews.index') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm rounded-lg transition-colors {{ request()->routeIs('admin.reviews.*') ? 'bg-sidebar-active text-sidebar-text-active' : 'hover:bg-sidebar-hover hover:text-sidebar-text-active' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                    {{ __('messages.reviews') }}
                </a>
                <a href="{{ route('admin.faqs.index') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm rounded-lg transition-colors {{ request()->routeIs('admin.faqs.*') ? 'bg-sidebar-active text-sidebar-text-active' : 'hover:bg-sidebar-hover hover:text-sidebar-text-active' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5"><circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/><path d="M12 17h.01"/></svg>
                    {{ __('messages.faqs') }}
                </a>
                <a href="{{ route('admin.journal-prompts.index') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm rounded-lg transition-colors {{ request()->routeIs('admin.journal-prompts.*') ? 'bg-sidebar-active text-sidebar-text-active' : 'hover:bg-sidebar-hover hover:text-sidebar-text-active' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5"><path d="M13.4 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-7.4"/><path d="M2 6h4"/><path d="M2 10h4"/><path d="M2 14h4"/><path d="M2 18h4"/><path d="M21.378 5.626a1 1 0 1 0-3.004-3.004l-5.01 5.012a2 2 0 0 0-.506.854l-.837 2.87a.5.5 0 0 0 .62.62l2.87-.837a2 2 0 0 0 .854-.506z"/></svg>
                    {{ __('messages.journal_prompts') }}
                </a>
                <a href="{{ route('admin.partners.index') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm rounded-lg transition-colors {{ request()->routeIs('admin.partners.*') ? 'bg-sidebar-active text-sidebar-text-active' : 'hover:bg-sidebar-hover hover:text-sidebar-text-active' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5"><path d="m11 17 2 2a1 1 0 1 0 3-3"/><path d="m14 14 2.5 2.5a1 1 0 1 0 3-3l-3.88-3.88a3 3 0 0 0-4.24 0l-.88.88a1 1 0 1 1-3-3l2.81-2.81a5.79 5.79 0 0 1 7.06-.87l.47.28a2 2 0 0 0 1.42.25L21 4"/><path d="m21 3 1 11h-2"/><path d="M3 3 2 14l6.5 6.5a1 1 0 1 0 3-3"/><path d="M3 4h8"/></svg>
                    {{ __('messages.partners') }}
                </a>
                <a href="{{ route('admin.subscription-plans.index') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm rounded-lg transition-colors {{ request()->routeIs('admin.subscription-plans.*') ? 'bg-sidebar-active text-sidebar-text-active' : 'hover:bg-sidebar-hover hover:text-sidebar-text-active' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5"><rect width="20" height="14" x="2" y="5" rx="2"/><line x1="2" x2="22" y1="10" y2="10"/></svg>
                    {{ __('messages.plans') }}
                </a>
                <a href="{{ route('admin.settings.index') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm rounded-lg transition-colors {{ request()->routeIs('admin.settings.*') ? 'bg-sidebar-active text-sidebar-text-active' : 'hover:bg-sidebar-hover hover:text-sidebar-text-active' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5"><path d="M12.22 2h-.44a2 2 0 0 0-2 2v.18a2 2 0 0 1-1 1.73l-.43.25a2 2 0 0 1-2 0l-.15-.08a2 2 0 0 0-2.73.73l-.22.38a2 2 0 0 0 .73 2.73l.15.1a2 2 0 0 1 1 1.72v.51a2 2 0 0 1-1 1.74l-.15.09a2 2 0 0 0-.73 2.73l.22.38a2 2 0 0 0 2.73.73l.15-.08a2 2 0 0 1 2 0l.43.25a2 2 0 0 1 1 1.73V20a2 2 0 0 0 2 2h.44a2 2 0 0 0 2-2v-.18a2 2 0 0 1 1-1.73l.43-.25a2 2 0 0 1 2 0l.15.08a2 2 0 0 0 2.73-.73l.22-.39a2 2 0 0 0-.73-2.73l-.15-.08a2 2 0 0 1-1-1.74v-.5a2 2 0 0 1 1-1.74l.15-.09a2 2 0 0 0 .73-2.73l-.22-.38a2 2 0 0 0-2.73-.73l-.15.08a2 2 0 0 1-2 0l-.43-.25a2 2 0 0 1-1-1.73V4a2 2 0 0 0-2-2z"/><circle cx="12" cy="12" r="3"/></svg>
                    {{ __('messages.settings') }}
                </a>
                
                <hr class="border-sidebar-hover my-4">

                <a href="{{ route('home') }}" target="_blank" class="flex items-center gap-3 px-4 py-2.5 text-sm rounded-lg hover:bg-sidebar-hover hover:text-sidebar-text-active transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" x2="21" y1="14" y2="3"/></svg>
                    {{ __('messages.view_site') }}
                </a>
                
                <a href="{{ route('language.switch', app()->getLocale() === 'en' ? 'ar' : 'en') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm rounded-lg hover:bg-sidebar-hover hover:text-sidebar-text-active transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5"><circle cx="12" cy="12" r="10"/><path d="M12 2a14.5 14.5 0 0 0 0 20 14.5 14.5 0 0 0 0-20"/><path d="M2 12h20"/></svg>
                    {{ app()->getLocale() === 'en' ? 'عربي' : 'English' }}
                </a>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="flex items-center gap-3 px-4 py-2.5 text-sm rounded-lg hover:bg-sidebar-hover hover:text-sidebar-text-active transition-colors w-full ltr:text-left rtl:text-right">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" x2="9" y1="12" y2="12"/></svg>
                        {{ __('messages.logout') }}
                    </button>
                </form>
            </nav>
        </aside>

        <main class="flex-1 ltr:ml-64 rtl:mr-64 min-h-screen p-8 w-full overflow-x-hidden">
            @if(session('success'))
                <div id="alert-success" class="flex items-center justify-between p-4 mb-6 rounded-lg bg-emerald-50 border border-emerald-200 text-emerald-800">
                    <div class="flex items-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><path d="m9 11 3 3L22 4"/></svg>
                        {{ session('success') }}
                    </div>
                    <button type="button" onclick="document.getElementById('alert-success').remove()" class="text-emerald-500 hover:text-emerald-700">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
                    </button>
                </div>
            @endif

            @if($errors->any())
                <div id="alert-error" class="flex items-start justify-between p-4 mb-6 rounded-lg bg-red-50 border border-red-200 text-red-800">
                    <div class="flex items-start gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5 mt-0.5"><circle cx="12" cy="12" r="10"/><line x1="12" x2="12" y1="8" y2="12"/><line x1="12" x2="12.01" y1="16" y2="16"/></svg>
                        <ul class="list-disc list-inside">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <button type="button" onclick="document.getElementById('alert-error').remove()" class="text-red-500 hover:text-red-700">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
                    </button>
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    @stack('scripts')
    <script>
        function openModal(id) {
            const modal = document.getElementById(id);
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }
        function closeModal(id) {
            const modal = document.getElementById(id);
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }
        function switchTab(tabName) {
            document.querySelectorAll('.tab-panel').forEach(p => p.classList.add('hidden'));
            document.querySelectorAll('.tab-btn').forEach(b => {
                b.classList.remove('border-primary', 'text-primary');
                b.classList.add('border-transparent', 'text-text-muted');
            });
            document.getElementById('tab-' + tabName).classList.remove('hidden');
            document.querySelector('[data-tab="' + tabName + '"]').classList.remove('border-transparent', 'text-text-muted');
            document.querySelector('[data-tab="' + tabName + '"]').classList.add('border-primary', 'text-primary');
        }
    </script>
</body>
</html>
