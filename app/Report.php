<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Report;

class Report extends Model
{

    protected $fillable = ['user_id', 'elem_id', 'elem_type', 'seen', 'accepted', 'description'];
    protected $count=0;



    public function getCount(){
        return $this->count;
    }
    public function getUser(){
        return User::findOrFail($this->user_id);
    }
    static function checkIfReported($elem_type, $elem_id, $user_id){
        $report = Report::where('elem_type', $elem_type)->where('elem_id', $elem_id)->where('user_id', $user_id)->first();
        if(!empty($report)){
            return true;
        } else {
            return false;
        }


    }
    static function getReports(){
        $reports = Report::all();

        $temp = array();
        foreach ($reports as $report){
            $tt = Report::where('elem_id', $report->elem_id)->where('elem_type', $report->elem_type)->orderBy('created_at', 'desc')->first();
            array_push($temp, $tt);
        }

        $collection = collect($temp);
        $temp = $collection->unique()->values()->all();
        foreach ($temp as $t){
            $t->initCount();
        }
        $temp = collect($temp);
        $temp = $reports->sortBy('seen');

        return $temp;
    }

    protected function initCount(){
        $report = Report::where('elem_id', $this->elem_id)->where('elem_type', $this->elem_type)->where('id', '!=', $this->id)->get();
        foreach ($report as $item){
            $this->count = $this->count+1;
        }
    }

    public function getOtherReports(){
        $reports = Report::where('elem_id', $this->elem_id)->where('elem_type', $this->elem_type)->where('id', '!=', $this->id)->get();
        $temp = array();
        foreach ($reports as $item){
            array_push($temp, $item);
        }
        return $temp;
    }

    public function getElement(){
        if($this->elem_type == 'education'){
            return Education::findOrFail($this->elem_id);
        }
        if($this->elem_type == 'post'){
            return Post::findOrFail($this->elem_id);
        }
        if($this->elem_type == 'employee'){
            return Employee::findOrFail($this->elem_id);
        }
        if($this->elem_type == 'image'){
            return Image::findOrFail($this->elem_id);
        }
    }
    public function getUrl(){
        if($this->elem_type == 'education' || $this->elem_type == 'post' || $this->elem_type == 'employee' || $this->elem_type == 'image') {
            return url('user/' . $this->getElement()->user_id);
        }

    }

    public function getElementName(){
        if($this->elem_type == 'education') {
            return 'użytkownik => Wykształcenie => '. $this->getElement()->institution;
        }
        if($this->elem_type == 'employee') {
            return 'użytkownik => praca => '. $this->getElement()->position;
        }
        if($this->elem_type == 'post') {
            return 'użytkownik => aktywność => '. $this->getElement()->title;
        }
        if($this->elem_type == 'image') {
            return "użytkownik => aktywność => ". "<img src='.$this->getElement()->getPath().''>";
        }
    }
}
