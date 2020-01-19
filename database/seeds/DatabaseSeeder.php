<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        factory(\App\Company::class,1)->create()->each(function ($company){

            $company->address()->save(factory(\App\Addres::class)->make());

            factory(\App\User::class)->create()->each(function ($user){

                $user->address()->save(factory(\App\Addres::class)->make());

            });
        });

    }
}
