<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Post;


class RateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        $users = \Illuminate\Foundation\Auth\User::get();
        $posts = \App\Post::get();
        foreach ($posts as $post) {


            $u = User::inRandomOrder()->limit(10)->get();
            foreach($u as $user){
                $random = rand(1,20);
                 switch ($random){
                      case $random<2:
                          $random = 1;
                          break;
                      case $random>=2 && $random<5:
                          $random = 2;
                          break;
                      case $random>=5 && $random<13:
                          $random = 3;
                          break;
                      case $random>=13 && $random<17:
                          $random = 4;
                          break;
                      case $random>=17 && $random<=20:
                          $random = 5;
                          break;
                  }
                \App\Rate::create([
                    'elem_id' => $post->id,
                    'user_id' => $user->id,
                    'company_id' => null,
                    'elem_type' => 'post',
                    'rate' => $random,
                ]);

            }
        }
    }
}
