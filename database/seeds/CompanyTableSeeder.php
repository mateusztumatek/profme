<?php

use Illuminate\Database\Seeder;

class CompanyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        for($i = 0; $i<50; $i++){
            $user =\App\User::orderByRaw("RAND()")->first();
            \App\Company::create([
               'email' => $faker->companyEmail,
                'user_id' => $user->id,
                'official_name' => $faker->company,
                'image' => null,
                'postal_code' => $faker->postcode,
                'street' => $faker->streetName,
                'nip' => random_int(0,10000) + 10000000000,
                'city' => $faker->city,
                'country' => $faker->country,
                'is_verify' => 1,
                'street_number' => random_int(0,100),
            ]);
        }


    }
}
