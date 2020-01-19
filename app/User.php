<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com
 * https://www.sigasmart.com.br
 */

namespace App;

use App\Suports\TraitForm;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends AbstractModel implements JWTSubject, \Illuminate\Contracts\Auth\Authenticatable, \Illuminate\Contracts\Auth\CanResetPassword
{
    use Notifiable, Authenticatable, TraitForm, CanResetPassword;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'email',
        'phone',
        'document',
        'status',
        'description',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function address(){

        return $this->morphOne(Addres::class, 'addresable');
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
    /**
     * Override the mail body for reset password notification mail.
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new \App\Notifications\MailResetPasswordNotification($token));
    }

    public function initForm($data = [])
    {
        $this
            ->addHiden('id')
            ->add('name')
            ->addHiden('slug')
            ->add('email',[
                'type'=>'email',
            ])->add('password',[
                'type'=>'password'
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
