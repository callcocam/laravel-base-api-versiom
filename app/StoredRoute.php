<?php


namespace App;


class StoredRoute extends AbstractModel
{

    protected $fillable = [
        'uuid',
        'middleware_id',
        'verb',
        'prefix',
        'name',
        'slug',
        'route',
        'pattern',
        'controller',
        'method',
        'resource',
        'status',
        'description',
    ];
}
