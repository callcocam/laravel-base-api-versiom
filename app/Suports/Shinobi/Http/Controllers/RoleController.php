<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com
 * https://www.sigasmart.com.br
 */

namespace App\Suports\Shinobi\Http\Controllers;


use App\Http\Controllers\AbstractController;
use App\Suports\Shinobi\Http\Requests\RoleRequest;
use App\Suports\Shinobi\Models\Role;

class RoleController extends AbstractController
{

   protected $template = 'roles';

   protected $model = Role::class;


    /**
     * Store a newly created resource in storage.
     *
     * @param RoleRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {

        return $this->save($request);
    }

}
