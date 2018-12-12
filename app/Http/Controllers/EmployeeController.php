<?php

namespace App\Http\Controllers;

use App\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function store(Request $request){
        if(isset($request->untill)){
            $request->validate([
                'since' => 'required|before:today',
                'untill' => 'after:since'
            ]);
        } else {
            $request->validate([
                'since' => 'required|before:today',
            ]);
        }

        if(!empty(Employee::where('user_id', $request->user_id)->where('company_id', $request->company_id)->where('position', $request->position)->first())){
            return response()->json(['message' => 'zgłoszenie na to stanowisko zostało już przyjęte']);
        }
        $tt = 'user';
        if(isset($request->untill)){
            Employee::create([
                'user_id' => $request->user_id,
                'company_id' => $request->company_id,
                'position' => $request->position,
                'description' => $request->description,
                'since' => $request->since,
                'untill' => $request->untill,
                'first' => $tt,
                'active' => 0,


            ]);
        } else {
            Employee::create([
                'user_id' => $request->user_id,
                'company_id' => $request->company_id,
                'position' => $request->position,
                'description' => $request->description,
                'since' => $request->since,
                'untill' => null,
                'first' => $tt,
                'active' => 0,


            ]);
        }



        return response()->json(['message' => 'dodałeś swojego pracodawcę teraz musisz poczekać aż on zaakeptuje twoje zgłoszenie']);

    }
}
