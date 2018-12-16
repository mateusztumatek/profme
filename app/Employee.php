<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
        /*$table->increments('id');
        $table->integer('user_id')->unsigned();
        $table->integer('company_id')->unsigned();
        $table->string('position');
        $table->date('since');
        $table->date('untill')->nullable();*/

    protected $fillable = ['id', 'user_id', 'company_id', 'position', 'since', 'untill', 'first', 'active', 'description'];

    public function getUser(){
        return User::findOrFail($this->user_id);
    }

    public function getCompany(){
        return Company::findOrFail($this->company_id);
    }

    public function getRateDiligence(){

        return Rate::where('elem_id', $this->id)->where('company_id', $this->company_id)->where('user_id', $this->user_id)->where('elem_type', 'diligence')->first();
    }

    public function getRateKnowledge(){

        return Rate::where('elem_id', $this->id)->where('company_id', $this->company_id)->where('user_id', $this->user_id)->where('elem_type', 'knowledge')->first();
    }

    public function getRatePunctuality(){

        return Rate::where('elem_id', $this->id)->where('company_id', $this->company_id)->where('user_id', $this->user_id)->where('elem_type', 'punctuality')->first();
    }
    public function deleteRates(){
        Rate::where('company_id', "!=", null)->where('elem_id', $this->id)->delete();
    }

    public function getEmployeeRate(){
        $rate = 0;
        $count = 0;
        if(!empty($this->getRateDiligence())){
            $rate = $rate + $this->getRateDiligence()->rate;
            $count = $count + 1;
        }
        if(!empty($this->getRateKnowledge())){
            $rate = $rate + $this->getRateKnowledge()->rate;
            $count = $count + 1;
        }
        if(!empty($this->getRatePunctuality())){
            $rate = $rate + $this->getRatePunctuality()->rate;
            $count = $count + 1;
        }
        if($rate == 0){
            return null;
        }
        $rate = $rate / $count;
        return $rate;
    }
    public function delete(){
        Report::where('elem_id', $this->id)->where('elem_type', 'employee')->delete();
        parent::delete();
    }
}
