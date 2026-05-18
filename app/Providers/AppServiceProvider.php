<?php

namespace App\Providers;

use App\Models\ClientReview;
use App\Models\ProviderApplication;
use App\Observers\ClientReviewObserver;
use App\Observers\ProviderApplicationObserver;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        ClientReview::observe(ClientReviewObserver::class);
        ProviderApplication::observe(ProviderApplicationObserver::class);

        View::share('appLocale', app()->getLocale());
        View::share('appDir', app()->getLocale() === 'ar' ? 'rtl' : 'ltr');
    }
}
