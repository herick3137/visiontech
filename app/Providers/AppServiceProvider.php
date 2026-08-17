<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

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
        // Força o sistema a carregar o visual (CSS/JS) com segurança (HTTPS) na nuvem
        if (config('app.env') === 'production') {
            URL::forceScheme('https');
        }
    }
}
