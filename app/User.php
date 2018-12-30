<?php

namespace App;

use App\Notifications\VerifyEmail;
use Carbon\Carbon;
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
        'name', 'email', 'password', 'date_of_birth', 'city', 'sex', 'last_activity', 'phone','active','verify', 'banned_at', 'banned_to'
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

    public function isbanned(){
        return ($this->banned_to > Carbon::today() && $this->banned_to != null)? true : false;
    }

    public function getRates(){
        $all_rates = Rate::all();
        $to_return = [];
        foreach ($all_rates as $rate){
            if($rate->getElement()->getUser() instanceof User){
                if($rate->getElement()->getUser() == Auth::user()){
                    array_push($to_return, $rate);
                }
            }
        }
        return $to_return;
    }

    public function getPrivileges(){
        if($this->sex == 'male'){
            $privileges = Privilege::where('active', 1)->where('sex', '!=', 'female')->get();
        } else{
            $privileges = Privilege::where('active', 1)->where('sex', '!=', 'male')->get();
        }
        $array =  [];
        foreach ($privileges as $privilege){
            $test = true;
            $settings = $privilege->getSettings();
            foreach ($settings as $setting){
                switch (key($setting)){
                    case 'rate':
                        if(Rate::getRate($this) < $setting[key($setting)]){
                            $test = false;
                        }
                        break;
                    case 'count':
                        if (count($this->getRates()) < $setting[key($setting)]){
                            $test = false;
                        }
                        break;
                    case 'diligence_count':
                        if(Rate::getUserEmployeeRateCount($this, 'diligence') < $setting[key($setting)]){
                            $test = false;
                        }
                        break;
                    case 'diligence':
                        if(Rate::getUserEmployeeRate($this, 'diligence') < $setting[key($setting)]){
                            $test = false;
                        }
                        break;
                    case 'knowledge_count':
                        if(Rate::getUserEmployeeRateCount($this, 'knowledge') < $setting[key($setting)]){
                            $test = false;
                        }
                        break;
                    case 'knowledge':
                        if(Rate::getUserEmployeeRate($this, 'knowledge') < $setting[key($setting)]){
                            $test = false;
                        }
                        break;
                    case 'punctuality_count':
                        if(Rate::getUserEmployeeRateCount($this, 'punctuality') < $setting[key($setting)]){
                            $test = false;
                        }
                        break;
                    case 'punctuality':
                        if(Rate::getUserEmployeeRate($this, 'punctuality') < $setting[key($setting)]){
                            $test = false;
                        }
                        break;
                }
            }
            if($test){
                array_push($array, $privilege);
            }
        }
        return $array;
    }
    public function getFriendsRates(){
        $array = [];
        $rates = Rate::orderBy('created_at', 'desc')->get();
        foreach ($rates as $rate){
            $user = User::find($rate->getElement()->user_id);
            if(Friend::isFriends(Auth::user(), $user)){
                array_push($array, $rate);
            }
            if(count($array) == 6){
                break;
            }
        }
        return $array;
    }
}
