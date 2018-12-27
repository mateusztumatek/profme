<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Testing\File;

class Privilege extends Model
{
    //
        /*$table->increments('id');
        $table->integer('user_id');
        $table->string('name');
        $table->string('icon');
        $table->integer('count')->nullable();
        $table->integer('rate')->nullable();
        $table->integer('diligence_count')->nullable();
        $table->integer('diligence')->nullable();
        $table->integer('punctuality_count')->nullable();
        $table->integer('punctuality')->nullable();
        $table->integer('knowledge_count')->nullable();
        $table->integer('knowledge')->nullable();
        $table->string('sex')->nullable();
        $table->boolean('active')->default(true);
        $table->string('group');
        $table->string('description')->nullable();
        $table->timestamps();*/

        protected $fillable = ['user_id', 'name', 'icon', 'count', 'rate', 'diligence_count', 'diligence', 'punctuality_count', 'punctuality', 'knowledge_count', 'knowledge', 'sex', 'active', 'group', 'description'];

        public function getUser(){
            return User::findOrFail($this->user_id);
        }

        public function getIcon(){
            return url('/public/privilege/'.$this->id.'/'.$this->icon);
        }
        public function deleteIcon(){
            \Illuminate\Support\Facades\File::delete(public_path('/public/privilege/'.$this->id.'/'.$this->icon));
        }

        public function getSex(){
            switch ($this->sex){
                case 'both':
                    return 'wszyscy';
                case 'male':
                    return 'mężczyźni';
                case 'female':
                    return 'kobiety';
            }
        }
        public function getSettings(){
            $array = [];
            if($this->count != 0){
                array_push($array, ['count' => $this->count]);
            }
            if($this->rate != 1){
                array_push($array, ['rate' => $this->rate]);
            }
            if($this->diligence_count != 0){
                array_push($array, ['diligence_count' => $this->diligence_count]);
            }
            if($this->diligence != 0){
                array_push($array, ['diligence' => $this->diligence]);
            }
            if($this->knowledge_count != 0){
                array_push($array, ['knowledge_count' => $this->knowledge_count]);
            }
            if($this->knowledge != 0){
                array_push($array, ['knowledge' => $this->knowledge]);
            }
            if($this->punctuality_count != 0){
                array_push($array, ['punctuality_count' => $this->punctuality_count]);
            }
            if($this->punctuality != 0){
                array_push($array, ['punctuality' => $this->punctuality ]);
            }
            return $array;



        }

}
