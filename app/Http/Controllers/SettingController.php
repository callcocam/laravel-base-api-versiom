<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com
 * https://www.sigasmart.com.br
 */

namespace App\Http\Controllers;


use App\Company;
use App\Http\Requests\SettingRequest;


class SettingController extends AbstractController
{

    protected $model = Company::class;


    public function settings()
    {

        $row = $this->getModel()->findById(get_tenant_id());

        if(!$row)
            return response()->json([], 500 );

        $address  = $row->address()->first(['slug','zip','city','state','country','street','district','number','complement']);


        $row->append('file');

        if($address)
            return response()->json($row->initForm(array_merge($row->toArray(), $address->toArray())));

        return response()->json($row->initForm($row->toArray()));
    }

    public function store(SettingRequest $request){

        return parent::save($request);
    }
}
