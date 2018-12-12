<?php

use Illuminate\Database\Seeder;

class EmployeeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        foreach (\App\Company::all() as $company){
            for($i = 0; $i<rand(1,5); $i++){
                $user =\App\User::orderByRaw("RAND()")->first();
                $startDate =  $faker->dateTime($max = 'now', $timezone = null);
                $endDate = $faker->dateTime($max = 'now', $timezone = null);
                \App\Employee::create([
                    'company_id' => $company->id,
                    'user_id' => $user->id,
                    'description' => $faker->text(50),
                    'position' => $faker->jobTitle,
                    'since' => $startDate,
                    'untill' => $endDate,
                    'first' => 'user',
                    'active' => random_int(0,1),
                ]);
            }

        }
    }
}
