<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
 
Paginator::useBootstrap();
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        date_default_timezone_set('America/Lima');
        URL::forceRootUrl(Config::get('app.url'));
    if (str_contains(Config::get('app.url'), 'https://')) {
        URL::forceScheme('https');
    }
    }
}
