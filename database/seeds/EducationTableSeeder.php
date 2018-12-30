<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Education;
use Illuminate\Support\Facades\DB;

class EducationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*$faker = \Faker\Factory::create();
        $users = \Illuminate\Foundation\Auth\User::get();
        $posts = \App\Post::all();
        foreach ($posts as $post) {
            $random = rand(1,5);
            $u = User::inRandomOrder()->take(10);
            foreach($u as $user){
                \App\Rate::create([
                   'elem_id' => $post->id,
                    'user_id' => $user->id,
                    'company_id' => null,
                    'elem_type' => 'post',
                ]);
            }
        }*/
    }
}
