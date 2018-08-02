<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Post;

class Comment extends Model
{
    protected $fillable = ['user_id', 'post_id', 'content'];

    public function getUser(){
        return User::findOrFail($this->user_id);
    }

    public function Post(){
        return Post::findOrFail($this->post_id);
    }
}
