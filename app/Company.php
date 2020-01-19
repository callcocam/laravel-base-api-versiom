<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com
 * https://www.sigasmart.com.br
 */

namespace App;


use App\Suports\TraitForm;

class Company extends AbstractModel
{
    use TraitForm;

    protected $fillable = [
        'assets',
        'name',
        'slug',
        'email',
        'phone',
        'document',
        'status',
        'description'
    ];


    public function address(){

        return $this->morphOne(Addres::class, 'addresable');
    }

    public function initForm($data = [])
    {

        $this
            ->addHiden('id')
            ->add('name')
            ->addHiden('slug')
            ->add('email',[
                'type'=>'email',
            ])
            ->addFile('file')
            ->add('phone')
            ->add('document')
            ->addSeparator([
                'label'=>"Endereço"
            ])
            ->add('zip')
            ->add('city')
            ->add('state')
            ->add('country')
            ->add('street')
            ->add('district')
            ->add('number')
            ->add('complement')
            ->addSeparator()
            ->add('status',[
                'type'=>'radio',
                'options'=>[
                    ["text"=> 'Publicado', "value" => 'published'],
                    ["text"=> 'Rascunho', "value" => 'draft'],
                ]
            ])
            ->add('description',[
                'type'=>'editor'
            ]);

        return $this->render($data);
    }
}
