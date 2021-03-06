<?php

/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com
 * https://www.sigasmart.com.br
 */

namespace App;

use App\Suports\Common\{Select, Eloquent, Delete, Helper, Create, Update};
use App\Processors\AvatarProcessor;
use App\Tenant\BelongsToTenants;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model as ModelAlias;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class AbstractModel extends ModelAlias
{

    use Select, Eloquent, Delete, Helper, Create, Update, BelongsToTenants, SoftDeletes;

    protected $results = [
        'tabla' => null,
        'result' => false,
        'type' => 'is-danger',
        'errors' => "Falhou, não foi possivel realizar a operação!!",
        'message' => "Falhou, não foi possivel realizar a operação!!",
        'title' => 'Operação:'
    ];

    protected $model;

    protected $lastId;

    public static function boot()
    {
        parent::boot();
        //evento executado antes de se criar o model no banco de dados
        self::creating(function ($model) {
            $model->uuid = \Str::uuid();
            $model->company_id = get_tenant_id();
            if (isset($model->user_id) && !(int) $model->user_id) {
                $model->user_id = Auth::id();
            }
        });
    }
    public function saveBy($data){


        $this->slug($data);

        $this->convert_date($data);

        $this->convert_password($data);

        $this->initArray($data);



        if(isset($data['id']) && (int)$data['id']){

            if($this->updateBy($data, $data['id'])){
                //SITEMA DE TAGS
                $this->initTags($data);
                //EX RELACIONA CATEGORIAS COM CATEGORIAS
                $this->initCategorizable($data);
                //EX RELACIONA CATEGORIAS COM POST OU PRODUCTS
                $this->initCategory($data);
                //EX RELACIONA VIDEOS COM POST
                //$this->initVideozable($data);
                //RELACIONA UM AVATAR COM O REGISTRO USER OU POST ETC...
                $this->initAvatar($data);
                //RELACIONA UMA CAPA COM O REGISTRO USER OU POST ETC...
                $this->initCover($data);
                //RELACIONA UMA CAPA COM O REGISTRO USER OU POST ETC...
                $this->initFile($data);
                //RELACIONA UM ADDRESS COM O REGISTRO USER OU CLIENT ETC...
                $this->initAddress($data);
                //RELACIONA OS ROLES COM USERS
                $this->initRoles($data);
                //RELACIONA AS PERMISSIONS COM AS ROLES
                $this->initPermissions($data);
                //RELACIONA AS MENUS COM SUB-MENUS
                $this->initMenuss($data);
                //RELACIONA AS MENUS COM SUB-MENUS
                $this->initTasks($data);
            }

        }
        else{

            if($this->createBy($data)){
                //SITEMA DE TAGS
                $this->initTags($data);
                //EX RELACIONA CATEGORIAS COM CATEGORIAS
                $this->initCategorizable($data);
                //EX RELACIONA CATEGORIAS COM POST OU PRODUCTS
                $this->initCategory($data);
                //EX RELACIONA VIDEOS COM POST
                //$this->initVideozable($data);
                //RELACIONA UM AVATAR COM O REGISTRO USER OU POST ETC...
                $this->initAvatar($data);
                //RELACIONA UMA CAPA COM O REGISTRO USER OU POST ETC...
                $this->initFile($data);
                //RELACIONA UMA CAPA COM O REGISTRO USER OU POST ETC...
                $this->initCover($data);
                //RELACIONA UM ADDRESS COM O REGISTRO USER OU CLIENT ETC...
                $this->initAddress($data);
                //RELACIONA OS ROLES COM USERS
                $this->initRoles($data);
                //RELACIONA AS PERMISSIONS COM AS ROLES
                $this->initPermissions($data);
            }

        }
        return $data;
    }

    public function getAvatarFilenameAttribute()
    {
        if (!empty($this->file)) {
            return $this->file->name;
        }

        return null;
    }

    public function getMessageAttribute()
    {
        return $this->getMessage();
    }

    public function getAvatarAttribute()
    {
        return AvatarProcessor::get($this);
    }

    public function getFileAttribute()
    {
        return AvatarProcessor::get($this);
    }
    public function getImageAttribute()
    {
        return AvatarProcessor::get($this);
    }

    public function getCoverAttribute()
    {
        return AvatarProcessor::get($this);
    }


    public function getCreatedMmDdYyyyHisAttribute()
    {
        if (empty($this->created_at)) {
            return null;
        }

        return $this->created_at->format('m/d/Y H:i:s');
    }


    public function getCreatedMmDdYyyyAttribute()
    {
        if (empty($this->created_at)) {
            return null;
        }

        return $this->created_at->format('m/d/Y');
    }

    public function setCreatedDateAttribute($value)
    {
        try {
            $this->attributes['created_at'] = new Carbon($value);
        } catch (\Exception $exception) {
            $this->attributes['created_at'] = now();
        }
    }

    public function getResults()
    {

        return $this->results;
    }


    public function getResult($key)
    {
        if (isset($this->results[$key])) {
            return $this->results[$key];
        }
        return false;
    }

    public function getResultLastId()
    {
        return $this->lastId;
    }

    public function getModel(){

        return $this->model;

    }

}
