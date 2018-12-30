<?php

use Illuminate\Database\Seeder;
use App\User;

use App\Friend;

class FriendsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        $users = User::get();
        foreach ($users as $user) {
           $random1 = $random = rand(1,5);
           if($random1 > 2){
               $accept = 1;
           } else {
               $accept = 0;
           }
           $u = User::inRandomOrder()->limit(10)->get();
            foreach ($u as $us){
                if(!\App\Friend::isFriends($user, $us)){
                    \App\Friend::create([
                        'user_1' => $user->id,
                        'user_2' => $us->id,
                        'accepted' => $accept,
                    ]);
                }
            }

        }
    }
}
