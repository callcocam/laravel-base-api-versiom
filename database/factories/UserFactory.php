<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'uuid'=>$faker->uuid,
        'name'=>"CLAUDIO CAMPOS",
        'slug'=>"claudio-campos",
        'email'=>"contato@sigasmart.com.br",
        'phone'=>"(48)99680-1064",
        'document'=>"01728422981",
        'status'=>"published",
        'description'=>"Sistema integrado de gerenciamento e administração",
        'email_verified_at' => now(),
        'password' => \Illuminate\Support\Facades\Hash::make('password'),
        'remember_token' => Str::random(10),
    ];
});
