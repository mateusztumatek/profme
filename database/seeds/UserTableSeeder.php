<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = \Faker\Factory::create();

        $admin = \App\User::create([
            'name' => 'Mateusz Bielak',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'city' => 'wroclaw',
            'date_of_birth' => '2012-02-02',
            'sex' => 'male',
            'active' => 0,
        ]);

        \App\Roles::create([
           'user_id' => $admin->id,
            'name' => 'admin',
        ]);

        for($i=0; $i<50; $i++){
            $user = \App\User::create([
                'name' => $faker->name,
                'email' => $faker->email,
                'password' => Hash::make('password'),
                'city' => $faker->city,
                'date_of_birth' => $faker->date($format = 'Y-m-d', $max = 'now'),
                'sex' => 'male',
                'active' => 0,
                ]);

            \App\Roles::create([
                'user_id' => $user->id,
                'name' => 'user',
            ]);
        }

    }
}
