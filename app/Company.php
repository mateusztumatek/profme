<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;

class Company extends Model
{
    /*
         $table->integer('user_id');
            $table->string('official_name');
            $table->string('image');
            $table->boolean('is_verify')->default(false);
            $table->timestamps();
     */

    protected $fillable = ['user_id', 'email', 'official_name','city','postal_code','street','street_number','country', 'image','nip', 'is_verify'];

    public function getUser(){
        return User::findOrFail($this->user_id);
    }
    public function getLogo(){
        return ($this->image != null)? URL::to('/').'/public/users/'.$this->getUser()->id.'/company/'.$this->id.'/' . $this->image : null;

    }
    public function getPositions(){
        return Employee::where('company_id', $this->id)->get();
    }

    public function getCountPosition($position)
    {

        return count(Employee::where('company_id', $this->id)->where('position', $position)->get());
    }

    public function getUnconfirmEmployees(){
        return Employee::where('company_id', $this->id)->where('active', 0)->get();
    }

}
