<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group([
    'prefix'=>'/admin',
], function ($router){

    $router->view('/{vue_capture?}', "layouts.admin")
        ->where('vue_capture', '[\/\w\.\,\-]*');

});