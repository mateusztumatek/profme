<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected  $fillable = ['path', 'active', 'tags', 'user_id', 'avatar'];


    public function user(){
        $this->belongsTo('App/User');
    }


    public function setAvatar(Image $image){
        $images = Image::where('user_id', $image->user_id)->get();
        foreach ($images as $img){
            if($img->id != $image->id){
                $img->avatar = 0;
                $img->save();
            }
        }
        $image->avatar = 1;
        $image->save();
    }
    public function changeActive(){
        if($this->active == 1){
            $this->active = 0;
            $this->save();
        } else {

            $this->active = 1;
            $this->save();
        }
    }

    public function delete(){


        Image::where('id', $this->id)->delete();


    }

    public function getPath(){
        return public_path('/users/'. $this->user_id. '/'. $this->path);
    }
}
