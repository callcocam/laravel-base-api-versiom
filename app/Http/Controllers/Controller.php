<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com
 * https://www.sigasmart.com.br
 */

namespace App\Http\Controllers;

use App\AbstractModel;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    protected $model;

    protected $perPage = 12;

    /**
     * @return AbstractModel
     */
    protected function getModel(){

        if(is_string($this->model)){

            $this->model = new $this->model;
        }

        return $this->model;
    }

    /**
     * @return AbstractModel
     */
    protected function getSource(){

        if(is_string($this->model)){

            $this->model = $this->model::query();
        }

        return $this->model;
    }
}
