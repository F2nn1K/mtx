<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Forçar HTTPS no Render
        if (env('APP_ENV') === 'production') {
            URL::forceScheme('https');
        }
    }
}
