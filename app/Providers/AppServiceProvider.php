<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL; // <-- Pastikan ini di-import

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
        // Paksa menggunakan HTTPS jika di lingkungan production/vercel
        if (config('app.env') === 'production' || env('VERCEL') === '1') {
            URL::forceScheme('https');
        }
    }
}