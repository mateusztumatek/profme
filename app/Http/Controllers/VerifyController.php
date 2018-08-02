<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;

class VerifyController extends Controller
{
    public function index(){
        return view('verify');
    }
    public function verify($token){

        $user = User::where('verify',$token)->first();
        $user->update(['verify' => null]);
        return redirect('/home');

    }
}
