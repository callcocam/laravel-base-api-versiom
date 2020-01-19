<?php

namespace App\Providers;

use App\AutoRouteDbService;
use App\StoredRoute;
use App\Suports\SuportServiceProviders;
use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(SuportServiceProviders::class);
        $this->app->bind('autoRouteDb',
            function($app) {
                return new AutoRouteDbService(app(Router::class), app(StoredRoute::class));
            });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
