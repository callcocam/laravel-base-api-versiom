<?php

namespace App\Suports\Shinobi\Forms;

use App\AbstractForm;
use App\Suports\Shinobi\Models\Permission;

class RoleForm extends AbstractForm
{



    public function buildForm()
    {
        $this
            ->add('id', 'hidden')
            ->add('slug', 'hidden')
            ->add('name', 'text',[
                'label'=>'Nome'
            ])

           ->add('special', 'choice',[
               'choices'=>[
                   ''=>'Not Defined',
                   'all-access'=>'All Access',
                   'no-access'=>'No Access',
               ],
               'expanded'=>true,
           ])
            ->addPrivilege()
            ->addDescription()
            ->getStatus()
            ->addSubmit();

           parent::buildForm();

    }


    protected function addPrivilege(){

        $model = $this->getModel();

        if(!$model)
            return $this;

        if($model->special)
            return $this;

        $permissions = $this->getModel()->permissions()->get();

        $data = [];

        $map = $permissions->map(function($items){
            $data = $items->id;
            return $data;
        });

        if($map){
            $data = $map->toArray();
        }

        return  $this->add('privilege', 'entity',[
            'class' => Permission::class,
            'selected'=>$data,
            'multiple'=>true,
            'expanded'=>true,
        ]);

    }

}
