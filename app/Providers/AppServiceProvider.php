<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Routing\UrlGenerator;
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
        // if(env('REDIRECT_HTTPS')) {
        //     $this->app['request']->server->set('HTTPS', true);
        // }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        date_default_timezone_set('America/Lima');
        // if($this->app->enviroment('production')){
        //     URL::forceSchema('https');
        // };
        // if(env('REDIRECT_HTTPS')) {
        //     $url->formatScheme('https');
        // }
    }
}
