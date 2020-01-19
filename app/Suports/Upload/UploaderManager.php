<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com
 * https://www.sigasmart.com.br
 */

namespace App\Suports\Upload;

use Illuminate\Support\Facades\Route;

class UploaderManager
{
    public static function route($enable = ['store', 'delete'], callable $callback = null): void
    {
        Route::prefix('files')->group(function () use ($enable, $callback) {
            $namespace = '\\Upload\\Http\\Controllers\\';
            if (in_array('store', $enable)) {
                Route::post('/', $namespace . 'UploadController@store');
            }
            if (in_array('delete', $enable)) {
                Route::delete('{file}', $namespace . 'UploadController@destroy');
            }
            if ($callback) {
                $callback();
            }
        });
    }
}
