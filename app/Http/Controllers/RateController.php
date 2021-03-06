<?php

namespace App\Http\Controllers;

use App\Rate;
use App\User;
use Carbon\Carbon;
use foo\bar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RateController extends Controller
{
    public function __construct()
    {

    }
    public function index(User $user){
        $rates = $user->getRates();
        $rates = collect($rates)->sortByDesc('created_at');
        return view('user.rate_index', compact('rates', 'user'));
    }

    public function store(Request $request){

        $rate = Rate::create([
            'user_id' => $request->user_id,
            'company_id' => null,
            'elem_id' => $request->elem_id,
            'elem_type' => $request->elem_type,
            'rate' => $request->rate,
        ]);

        return back()->with(['message' => 'ocena została dodana!']);
    }

    public function update(Request $request, $id){
        $rate = Rate::findOrFail($id);
        $rate->rate = $request->rate;
        $rate->save();
        return back()->with(['message' => 'ocena została edytowana!']);
    }

    public function users_rate($post, $rate){
        $rates = Rate::where('elem_id', $post)->where('elem_type', 'post')->where('rate', $rate)->get();
         $users = [];
        foreach ($rates as $rate){
            $user = User::findOrFail($rate->user_id);
            $user->imageURL = $user->getProfileURL();
            $user->rate_created_at = $rate->created_at->diffForHumans();
            array_push($users, $user);
        }

        return $users;

    }

    public function destroy(Rate $rate){
        if($rate->user_id != Auth::id()){
            return back()->with(['message' => 'nie masz uprawnień']);
        }
        $rate->delete();
        return back()->with(['message' => 'ocena usunięta pomyślnie']);
    }
}
