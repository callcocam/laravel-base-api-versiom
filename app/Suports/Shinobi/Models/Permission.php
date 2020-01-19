<?php

namespace App\Suports\Shinobi\Models;

use App\AbstractModel;
use App\Suports\Common\Header;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Suports\Shinobi\Concerns\RefreshesPermissionCache;
use App\Suports\Shinobi\Contracts\Permission as PermissionContract;

class Permission extends AbstractModel implements PermissionContract
{
    use RefreshesPermissionCache;
    
    /**
     * The attributes that are fillable via mass assignment.
     *
     * @var array
     */
    protected $fillable = ['name', 'slug', 'groups', 'description', 'status','created_at','updated_at'];

    /**
     * Create a new Permission instance.
     * 
     * @param  array  $attributes
     * @return void
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setTable(config('shinobi.tables.permissions'));
    }

    /**
     * Permissions can belong to many roles.
     *
     * @return Model
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(config('shinobi.models.role'))->withTimestamps();
    }

    public function initTable(){

        return [
            (new Header('id'))->setWidth(50)->render(),
            (new Header('name'))
                ->setLabel('Nome')
                ->setSortable(true)
                ->setVisible(true)
                ->render(),
            //(new Header('slug'))->render(),
            //(new Header('groups'))->render(),
           // (new Header('description'))->render(),
            (new Header('status'))
                ->setLabel('Situação')
                ->setFormat('status')
                ->setSortable(true)
                ->setVisible(true)->render(),
            //(new Header('created_at'))->render(),
            (new Header('updated_at'))
                ->setLabel('Última Atualização')
                ->setFormat('date')
                ->setSortable(true)
                ->setVisible(true)->render(),
            (new Header('actions'))
                ->setLabel('#')
                ->setVisible(true)->addActions('perrmisions'),
        ];

    }
}
