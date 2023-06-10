<?php

namespace App\Providers;

use App\View\Composers\CartMenuComposer;
use App\View\Composers\MobileMenuComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // ...
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('mobile-menu', MobileMenuComposer::class);
        View::composer('navbar', CartMenuComposer::class);
    }
}
