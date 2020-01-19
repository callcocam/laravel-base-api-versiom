<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com
 * https://www.sigasmart.com.br
 */

namespace App\Suports\Shinobi\Http\Controllers;


use App\Http\Controllers\AbstractController;
use App\Suports\Shinobi\Http\Requests\PermissionRequest;
use App\Suports\Shinobi\Models\Permission;

class PermissionController extends AbstractController
{

   protected $template = 'permissions';

   protected $model = Permission::class;


    /**
     * Store a newly created resource in storage.
     *
     * @param PermissionRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(PermissionRequest $request)
    {
        return $this->save($request);
    }
}
