<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com
 * https://www.sigasmart.com.br
 */

namespace App\Http\Controllers;

use App\Http\Requests\StoredRouteRequest;
use App\StoredRoute;


class StoredRouteController extends AbstractController
{

    protected $model = StoredRoute::class;


    public function store(StoredRouteRequest $request){

        return parent::save($request);
    }
}
