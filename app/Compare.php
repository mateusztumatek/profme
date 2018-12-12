<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Compare extends Model
{
    protected  $users = [];

    public function __construct(User $user_1, User $user_2, User $user_3 = null)
    {
        array_push($this->users, $user_1);
        array_push($this->users, $user_2);
        if($user_3 != null) array_push($this->users, $user_3);

    }
    public function getUsers(){
        return $this->users;
    }

}
