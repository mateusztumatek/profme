<?php

use Illuminate\Database\Seeder;
use App\Post;
use App\Models\Tag;
class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        $users = \Illuminate\Foundation\Auth\User::all();
        foreach ($users as $user){
            $random = rand(1,6);

                    $path = 'public/users/'. $user->id;
                    if(!file_exists(public_path($path))){
                        mkdir(public_path($path));
                    }
                    copy(resource_path('files\example_photos/'.$random.'.jpg'), public_path($path.'/'.$random.'.jpg'));



                $post = Post::create([
                    'user_id' => $user->id,
                    'title' => $faker->realText(20),
                    'description' => $faker->realText(80),
                    'image' => $random.'.jpg',

                ]);


                    for ($i = 0; $i<3; $i++){
                        DB::table('tags')->insert([
                            'elem_id' => $post->id,
                            'type' => 'post',
                            'tag' => $faker->word,
                        ]);
                    }

        }
    }
}
