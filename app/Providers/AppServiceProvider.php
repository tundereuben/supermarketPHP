<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('components.layouts.app', function ($view) {
            $view->with('wishlistCount', auth()->check() ? auth()->user()->wishlists()->count() : 0);
            $view->with('cartCount', array_sum(session('cart', [])));
        });
    }
}
