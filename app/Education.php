<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Education extends Model
{
        /*$table->increments('id');
        $table->integer('user_id')->unsigned();
        $table->string('institution');
        $table->string('description')->nullable();
        $table->boolean('active');
        $table->date('since');
        $table->date('untill')->nullable();
        $table->string('image_url');*/

        protected $fillable = ['user_id','direction_id', 'institution', 'description', 'active', 'since', 'untill', 'image_url'];

        public function getImageUrl(){
            return url("public/users/". $this->user_id.'/education/'.$this->image_url);
        }

        public function getDirection(){
            return DB::table('study_directions')->where('id', $this->direction_id)->first();
        }
}
