<?php

namespace App;

use App\Notifications\VerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Expr\Empty_;
use App\Roles;
use App\Post;


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

    public function getActiveImages(){
        return $images = Image::where('user_id', $this->id)->where('active', 1)->get();

    }

    public function getProfileImage(){
        $image = Image::where('user_id', $this->id)->where('avatar', 1)->where('active', 1)->first();

        return $image;

    }
    public function getSex(){
        return ($this->sex == 'male')? 'mężczyzna' : 'kobieta';
    }
    public function getProfileURL(){
        $image = Image::where('user_id', $this->id)->where('avatar', 1)->where('active', 1)->first();
        if(!empty($image)){
            return asset('public/users/'. $this->id. '/' . $image->path);
        } else{
            return asset('img/profile1.jpg');
        }
    }

    public function hasRole($role){

        return Roles::where('user_id', $this->id)->where('name', $role)->first();
    }

    public function getRoles(){
        return Roles::where('user_id', $this->id)->get();
    }

    public function getPosts($count = 200){
        return Post::where('user_id', $this->id)->where('status','<>', 'reported')->take($count)->get();
    }

    public function getCompany(){
        return Company::where('user_id', $this->id)->get();
    }

    public function getUnacceptedFriends(){
        return $unaccept_friends = Friend::where('user_2', $this->id)->where('accepted', 0)->get();
    }

    public function getUnconfirmEmployees(){
        $employees = array();
        foreach ($this->getCompany() as $company){
            foreach ($company->getUnconfirmEmployees() as $em)
            {
                array_push($employees, $em);

            }
        }

        return $employees;
    }

    public function getFriendsPosts(){
        $friends = $friends = Friend::where([['user_1', Auth::id()], ['accepted', 1]])->orWhere([['user_2', Auth::id()], ['accepted', 1]])->get();
        $to_return = array();
        foreach ($friends as $friend){
            $user = $friend->getUser(Auth::user());
            $posts = $user->getPosts(10);
            foreach ($posts as $post){
                array_push($to_return, $post);
            }
        }
        return $to_return;
    }

    public function getUserPositions(){
        return Employee::where('active', 1)->where('user_id', $this->id)->get();
    }

    public function getEducations(){
        return Education::where('user_id', $this->id)->get();
    }
}
