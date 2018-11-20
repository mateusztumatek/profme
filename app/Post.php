<?php

namespace App;


use Illuminate\Database\DatabaseManager;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Comment;

class Post extends Model
{
    protected $table = 'posts';
    protected $fillable = ['user_id','title', 'description', 'image', 'status', ];

    public function getUser(){
        return User::findOrFail($this->user_id);
    }

    public function getImageURL(){
        $url = asset('public/users/'. $this->user_id . '/' . $this->image);
        return $url;
    }
    public function deleteComments(){
        \App\Comment::where('post_id', $this->id)->delete();
    }

    public function deleteRates(){
        Rate::where('elem_id', $this->id)->where('elem_type', 'post')->delete();
    }
    public function Tags(){
        return DB::table('tags')->where('type', 'post')->where('elem_id', $this->id)->get();
    }

    public function Comments(){
        return Comment::where('post_id', $this->id)->orderBy('created_at', 'desc')->get();
    }

    public function getUserRate($user){
        return Rate::where('elem_type', 'post')->where('user_id', $user->id)->where('elem_id', $this->id)->first();
    }

    public function getRates(){
        return Rate::where('elem_type', 'post')->where('elem_id', $this->id)->get();
    }

    public function deleteTags(){
        DB::table('tags')->where('elem_id', $this->id)->delete();
    }
}
