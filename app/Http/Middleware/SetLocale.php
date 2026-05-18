<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    public function handle(Request $request, Closure $next): Response
    {
        $locale = $this->resolveLocale($request);
        App::setLocale($locale);
        Session::put('locale', $locale);
        return $next($request);
    }

    private function resolveLocale(Request $request): string
    {
        if (Auth::check() && Auth::user()->locale) {
            return Auth::user()->locale;
        }

        if (Session::has('locale')) {
            return Session::get('locale');
        }

        $browserLocale = $request->getPreferredLanguage(['ar', 'en']);
        if ($browserLocale) {
            return $browserLocale;
        }

        return config('app.locale', 'ar');
    }
}
