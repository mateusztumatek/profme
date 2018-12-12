<?php

use Illuminate\Database\Seeder;

class study_directions_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $myfile = fopen(resource_path('files\studia.txt'), "r") or die("Unable to open file!");

        while(!feof($myfile)){

           DB::table('study_directions')->insert([
               'name' => iconv("cp1250","UTF-8",fgets($myfile)),
               "created_at" =>  \Carbon\Carbon::now(), # \Datetime()
               "updated_at" => \Carbon\Carbon::now(),  # \Datetime()
            ]);
        }

        fclose($myfile);
    }
}
