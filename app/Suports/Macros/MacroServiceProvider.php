<?php


namespace App\Suports\Macros;


use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\ServiceProvider;

class MacroServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {


    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        $this->bluePrintMacros();
    }


    public function bluePrintMacros()
    {
        Blueprint::macro('tenant', function(){
            $this->unsignedBigInteger('company_id')->nullable();
            $this
                ->foreign('company_id')
                ->references('id')
                ->on('companies')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        Blueprint::macro('user', function($field="user_id"){
            $this->unsignedBigInteger($field)->nullable();
            $this
                ->foreign($field)
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        Blueprint::macro('status', function($status =[]){
            $this->enum('status', array_merge([  'deleted','draft','published'], $status))->default('published');
        });

    }
}
