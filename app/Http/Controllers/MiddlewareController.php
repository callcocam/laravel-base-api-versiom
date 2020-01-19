<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com
 * https://www.sigasmart.com.br
 */

namespace App\Http\Controllers;

use App\Http\Requests\MiddlewareRequest;
use App\Middleware;


class MiddlewareController extends AbstractController
{

    protected $model = Middleware::class;


    public function store(MiddlewareRequest $request){

        return parent::save($request);
    }
}
