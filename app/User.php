<?php

namespace App;

use App\Notifications\VerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Mail;
use PhpParser\Node\Expr\Empty_;


class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'date_of_birth', 'city', 'sex', 'last_activity', 'phone','active','verify'
    ];
    protected $date = ['deleted_at'];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function verify(){
        return $this->token === null;
    }

    public function sendVerificationEmail(){
        Mail::to($this->email)->send(new \App\Mail\VerifyEmail($this));
    }

    public function getImages(){
       return $images = Image::where('user_id', $this->id)->get();

    }

    public function getProfileImage(){
        $image = Image::where('user_id', $this->id)->where('avatar', 1)->where('active', 1)->first();

        return $image;

    }

    public function getProfileURL(){
        $image = Image::where('user_id', $this->id)->where('avatar', 1)->where('active', 1)->first();
        if(!empty($image)){
            return asset('public/users/'. $this->id. '/' . $image->path);
        } else{
            return asset('img/profile1.jpg');
        }
    }
}
