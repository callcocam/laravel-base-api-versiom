<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Addres;
use Faker\Generator as Faker;

$factory->define(Addres::class, function (Faker $faker) {
    $name = $faker->text(50);
    return [
        'company_id' => get_tenant_id(),
        'user_id' => null,
        'uuid' => \Illuminate\Support\Str::uuid(),
        'name' => $name,
        'slug' => \Illuminate\Support\Str::slug($name),
        'zip' => $faker->postcode,
        'city' => $faker->city,
        'state' => $faker->stateAbbr,
        'street' => $faker->streetAddress,
        'district' => $faker->streetName,
        'number' => $faker->buildingNumber                      ,
        'complement' =>  $faker->secondaryAddress,
        'updated_at' => date("Y-m-d H:i:s"),
        'created_at' => date("Y-m-d H:i:s"),
    ];
});
