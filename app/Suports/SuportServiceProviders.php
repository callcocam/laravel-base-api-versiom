<?php


namespace App\Suports;


use App\Suports\ManualRoute\AutoRouteServiceProvider;

use App\Suports\Macros\MacroServiceProvider;
use App\Suports\Shinobi\ShinobiServiceProvider;
use App\Suports\Upload\Providers\UploadServiceProvider;
use Illuminate\Support\ServiceProvider;
use Tymon\JWTAuth\Providers\LaravelServiceProvider;

class SuportServiceProviders extends ServiceProvider
{


    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {


        include app_path("Suports/helpers.php");

        $this->loadProviders();
    }

    /**
     * Load our migration files.
     *
     * @return void
     */
    protected function loadProviders()
    {

        $this->app->register(MacroServiceProvider::class);
        $this->app->register(AutoRouteServiceProvider::class);
        $this->app->register(UploadServiceProvider::class);
        $this->app->register(LaravelServiceProvider::class);
        $this->app->register(ShinobiServiceProvider::class);
        //$this->app->register(FileManagerServiceProvider::class);
    }
}
