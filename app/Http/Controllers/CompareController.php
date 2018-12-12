<?php

namespace App\Http\Controllers;

use App\Compare;
use App\Employee;
use App\User;
use Illuminate\Http\Request;

class CompareController extends Controller
{
    public function index(Request $request){
        $user_1 = User::findOrFail($request->user_1);
        $user_2 = User::findOrFail($request->user_2_id);
        $compare = new Compare($user_1, $user_2);
        return view('company.compare_users', compact('compare'))->render();
    }

}
