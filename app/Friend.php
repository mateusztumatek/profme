<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
class Friend extends Model
{
    protected $fillable = ['user_1', 'user_2', 'accepted'];

    public function getSender(){
        return User::findOrFail($this->user_1);
    }
    public function getRecipient(){
        return User::findOrFail($this->user_2);
    }

    public function getUser(User $user){
        if($this->user_1 == $user->id){
            return User::findOrFail($this->user_2);
        } elseif($this->user_2 == $user->id){
            return User::findOrFail($this->user_1);
        }
    }
    static function getUserFriends(User $user, $friends){

        $friends_list = array();
        foreach ($friends as $friend){
            if($user->id == $friend->user_1){
                array_push($friends_list, User::findOrFail($friend->user_2));
            } elseif($user->id == $friend->user_2){
                array_push($friends_list, User::findOrFail($friend->user_1));

            }

        }


        return $friends_list;
    }
    static function isUnacceptFriends(User $user_1, User $user_2){
        if($user_1->id == $user_2->id){
            return false;
        }
        if(!empty(Friend::where([
            ['user_1', $user_1->id],
            ['user_2', $user_2->id],
            ['accepted', 0]
        ])->first())){
            return true;
        }
        if(!empty(Friend::where([
            ['user_2', $user_1->id],
            ['user_1', $user_2->id],
            ['accepted', 0]
        ])->first())){
            return true;
        }

        return false;
    }
    static function isFriends(User $user_1, User $user_2){
        if($user_1->id == $user_2->id){
            return false;
        }
        if(!empty(Friend::where([
            ['user_1', $user_1->id],
            ['user_2', $user_2->id],
            ['accepted', 1]
        ])->first())){
            return true;
        }
        if(!empty(Friend::where([
            ['user_2', $user_1->id],
            ['user_1', $user_2->id],
            ['accepted', 1]
        ])->first())){
            return true;
        }

        return false;
    }
}
