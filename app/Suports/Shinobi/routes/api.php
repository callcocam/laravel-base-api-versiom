<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix'=>'/admin'],function (\Illuminate\Routing\Router $router) {

    \App\Suports\ManualRoute\Facade\AutoRoute::register('RoleController','roles','roles');
    \App\Suports\ManualRoute\Facade\AutoRoute::register('PermissionController','permissions','permissions');

});
