<?php

namespace App\Providers;

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
    public function boot()
{
    if (env('APP_ENV') === 'production') {
        \Illuminate\Support\Facades\URL::forceScheme('https');
        
        // Redirect all non-www to www (or vice versa)
        if (request()->getHost() === 'nexiswear.me') {
            return redirect()->to('https://www.nexiswear.me' . request()->getRequestUri());
        }
    }
}

}
