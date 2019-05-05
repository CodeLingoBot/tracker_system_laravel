<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \URL::forceRootUrl(\Config::get('app.url'));
        if (str_contains(\Config::get('app.url'), 'https://')) {
            \URL::forceScheme('https');
            $_SERVER['HTTPS'] = true;
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
