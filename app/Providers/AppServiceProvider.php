<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL; // <-- WAJIB ADA BARIS INI

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Langsung hajar tanpa if-else!
        URL::forceScheme('https');
        
        // (Jika Anda menggunakan Laravel Pagination, tambahkan juga ini biar link next page-nya aman)
        // \Illuminate\Pagination\Paginator::useTailwind();
    }
}