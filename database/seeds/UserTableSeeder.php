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
        $admin = \App\User::create([
            'name' => 'Mateusz Bielak',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('pass'),
            'city' => 'wroclaw',
            'date_of_birth' => '19-02-2012',
        ]);

    }
}
