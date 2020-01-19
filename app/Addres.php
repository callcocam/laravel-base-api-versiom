<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com
 * https://www.sigasmart.com.br
 */

namespace App;


class Addres extends AbstractModel
{

    protected $table = "address";

    protected $fillable = [
        'uuid','name','slug','zip','city','state','country','street','district','number','complement'
    ];


    public function addresable(){

        return $this->morphTo();
    }
}
