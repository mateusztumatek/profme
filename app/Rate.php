<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    protected $fillable = ['user_id', 'elem_id', 'elem_type', 'rate'];

    public function getElement(){
        if($this->elem_type == 'post'){
            return Post::findOrFail($this->elem_id);
        }
    }


}
