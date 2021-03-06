<?php

/**
 * ==============================================================================================================
 *
 * Created by Claudio Campos.
 * User: callcocam@gmail.com
 * https://www.sigasmart.com.br
 * ==============================================================================================================
 */
namespace App\Suports\ManualRoute;


use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;

class AutoRouteServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

    }
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

        $this->app->bind('autoRoute',
            function($app) {
                return new AbstractRoute(app(Router::class));
            });
    }

}
