<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
class Roles extends Model
{
    var $fillable = ['user_id', 'name'];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
