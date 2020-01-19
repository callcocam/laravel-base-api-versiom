<?php

Route::group(['namespace' => 'Auth','prefix' => 'auth'], function ($router) {

    $router->post('login', 'LoginController')->name('api.admin.login');
    $router->post('register', 'RegisterController')->name('api.admin.register');
    $router->post('refresh', 'RefreshController')->name('api.admin.refresh');
    $router->post('logout', 'LogoutController')->name('api.admin.logout');
    $router->get('me', 'MeController')->name('api.admin.me');
    $router->post('profile', 'ProfileController')->name('api.admin.profile');

    $router->post('reset-password', 'ResetLinkController')->name('api.admin.reset.password.email');
    $router->post('reset/password', 'ResetPasswordController')->name('api.admin.reset.password');
});


Route::group(['prefix' => 'admin'], function ( $router) {


    $router->group(['prefix' => 'settings'], function ($router) {

        $router->get('settings', 'SettingController@settings')->name('api.admin.settings');
        $router->post('store', 'SettingController@store')->name('api.admin.settings.store');
        $router->get('translation', 'TranslationController@index')->name('api.admin.translation');
        $router->post('translation', 'TranslationController@store')->name('api.admin.translation.store');
        $router->delete('translation/{id}', 'TranslationController@delete')->name('api.translation.delete');

    });

    \App\Suports\ManualRoute\Facade\AutoRoute::register('MiddlewareController','middlewares','middlewares');
    \App\Suports\ManualRoute\Facade\AutoRoute::register('StoredRouteController','stored-routes','stored-routes');

    $router->group(['prefix' => 'posts'], function ($router) {

        $router->get('', 'PostController@index');

    });
});


Route::group(['prefix'=>'/admin',], function ($router){

    $router->post('editor/upload', 'EditorController')->name('api.upload.index');

});

// handle reset password form process
//Route::post('reset/password', 'AuthController@callResetPassword');

