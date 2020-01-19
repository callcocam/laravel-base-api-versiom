<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Company;
use Faker\Generator as Faker;

$factory->define(Company::class, function (Faker $faker) {
    return [
        'uuid'=>$faker->uuid,
        'assets'=>config('app.url'),
        'name'=>"SIGA SMART",
        'slug'=>"siga-smart",
        'email'=>"contato@sigasmart.com.br",
        'phone'=>"(48)99680-1064",
        'document'=>"01728422981",
        'status'=>"published",
        'description'=>"Sistema integrado de gerenciamento e administração"
    ];
});
