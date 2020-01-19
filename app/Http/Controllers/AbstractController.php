<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com
 * https://www.sigasmart.com.br
 */

namespace App\Http\Controllers;


abstract class AbstractController extends Controller
{


    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }


    public function index(){

        $rows = [];

        if($this->model){

            $rows = $this->getModel()->getData();
        }

        return response()->json($rows);
    }

    public function show($id){

        $row = $this->getModel()->findById($id);

        if(!$row)
            return response()->json([], 500 );

        $row->append('file');

        return response()->json($row->initForm($row->toArray()));
    }

    public function save($request){

        $this->getModel()->saveBy($request->all());

        $row = $this->getModel()->findById($this->getModel()->getResultLastId());

        $row->append('file');

        return response()->json($row->initForm($row->toArray()));
    }

}
