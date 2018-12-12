<?php

namespace App\Http\Controllers;

use App\Company;
use App\User;
use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input;

class SearchController extends Controller
{
    public function userAutocomplete(){
        $term = \Illuminate\Support\Facades\Input::get('term');
        $query_user = User::where('name', 'LIKE', '%'.$term.'%')->limit(5)->get();
        if($query_user->isEmpty() && $query_companies->isEmpty()){
            return response(null);
        }
        $array[] = array();

        foreach ($query_user as $record){
             array_push($array, ['label' => $record->name, 'value' => $record->name, 'id' => $record->id, 'email' => $record->email, 'type' => 'user']);
        }



        return response()->json($array);
    }

    public function companiesAutocomplete(){
        $term = \Illuminate\Support\Facades\Input::get('term');
        $query_companies = Company::where('official_name', 'LIKE', $term. '%')->orWhere('nip', 'LIKE', $term.'%')->get();
        $array[] = array();
        if($query_companies->isEmpty()){
            return response(null);
        }
        foreach ($query_companies as $record){
            array_push($array, ['label' => $record->official_name, 'value' => $record->official_name, 'id' => $record->id, 'city' => $record->city , 'nip' => $record->nip , 'email' => $record->email, 'type' => 'company', 'logo_url' => $record->getLogo()]);
        }

        return response()->json($array);
    }
}
