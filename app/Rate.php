<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Post;

class Rate extends Model
{
    protected $fillable = ['user_id', 'elem_id', 'elem_type', 'rate', 'company_id'];

    protected $weight;

    public function initWeight(){
        if($this->elem_type == 'post'){
            $this->weight = 1;
        }
        if($this->elem_type == 'diligence'){
            $this->weight = 3;
        }
        if($this->elem_type == 'punctuality'){
            $this->weight = 3;
        }
        if($this->elem_type == 'knowledge'){
            $this->weight = 3;
        }
    }
    public function getUser(){
        if($this->elem_type == 'post'){
            return User::findOrFail($this->user_id);
        }else
        {
            return Company::findOrFail($this->company_id);
        }
    }
    public function getElement(){
        if($this->elem_type == 'post'){
            return Post::findOrFail($this->elem_id);
        } else if ($this->elem_type == 'diligence' || $this->elem_type == 'punctuality' || $this->elem_type == 'knowledge'){
            return Employee::findOrFail($this->elem_id);
        }
        return null;
    }

    static function getPercentageRate($rate){
        return $rate*100/5;
    }

    static function getRate(User $user){
        $count = 0;
        $user_rate = 0;
        $weights = 0;
        $rates = Rate::all();
        foreach ($rates as $key => $rate) {
            $rate->initWeight();
            $post = $rate->getElement();
            if ($post->user_id != $user->id) {
                $rates->forget($key);
            } else {
                $user_rate = $user_rate + $rate->rate * $rate->weight;
                $weights = $weights + $rate->weight;
            }
        }

        if($user_rate > 0) $user_rate = $user_rate / $weights;



        return $user_rate;
    }
    static function getUserEmployeeRateCount(User $user, $type){
        $rates = Rate::where('elem_type', $type)->get();
        foreach ($rates as $key=>$rate){
            if($rate->getElement()->user_id != $user->id){
                $rates->forget($key);
            }
        }
        return count($rates);
    }

    static function getUserEmployeeRate(User $user, $type){
        $rates = Rate::where('elem_type', $type)->get();
        foreach ($rates as $key=>$rate){
            if($rate->getElement()->user_id != $user->id){
                $rates->forget($key);
            }
        }

        $all = 0;
        foreach ($rates as $rate){
            $all = $rate->rate+$all;
        }
        if($all == 0) return null;

        $all = $all / count($rates);

        return $all;
    }

    static function getCountUserRates($user){
        return count(Rate::where('user_id', $user->id)->get());
    }



}
