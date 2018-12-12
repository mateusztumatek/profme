<?php

namespace App\Http\Controllers;

use App\Friend;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Console\Input\Input;

class FriendController extends Controller
{

    public function index(){

        $friends = Friend::where([['user_1', Auth::id()], ['accepted', 1]])->orWhere([['user_2', Auth::id()], ['accepted', 1]])->paginate(20);

        $unaccept_friends = Friend::where('user_2', Auth::id())->where('accepted', 0)->get();
        return view('Friends.index', compact('friends', 'unaccept_friends'));
    }

    public function store(Request $request){


        Friend::create([
            'user_1' => $request->user_1,
            'user_2' => $request->user_2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        $friends = Friend::where([['user_1', Auth::id()], ['accepted', 1]])->orWhere([['user_2', Auth::id()], ['accepted', 1]])->paginate(20);

        if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
        {
            return view('Friends.friends_list', compact('friends'));

        }
        return back()->with(['message' => 'wyslales zaproszenie temu uzytkownikowi']);

    }

    public function searchFriends($term){

        $users = User::where('name', 'LIKE', '%'.$term.'%')->limit(16)->get();
        foreach ($users as $key => $user){
            if(Friend::isFriends($user, Auth::user()) || $user->id == Auth::id() || Friend::isUnacceptFriends($user, Auth::user())){
                unset($users[$key]);
            }
        }
        return view('Friends.search_friends', compact('users'));
    }

    public function delete(Request $request){
        Friend::where([
            ['user_1', $request->user_1],
            ['user_2', $request->user_2]
        ])->delete();

        Friend::where([
            ['user_1', $request->user_2],
            ['user_2', $request->user_1]
        ])->delete();

        $friends = Friend::where([['user_1', Auth::id()], ['accepted', 1]])->orWhere([['user_2', Auth::id()], ['accepted', 1]])->get();
        if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
        {
            return view('Friends.friends_list', compact('friends'));

        }
        return back()->with(['message' => 'znajomy został usunięty']);
    }

    public function accept(Request $request){
        $friend = Friend::where('user_1', $request->user_1)->where('user_2', $request->user_2)->first();
        $friend->accepted = 1;
        $friend->update();
        $unaccept_friends = Friend::where('user_2', Auth::id())->where('accepted', 0)->get();
        $friends = Friend::where([['user_1', Auth::id()], ['accepted', 1]])->orWhere([['user_2', Auth::id()], ['accepted', 1]])->get();
        $friends_list_view = view('Friends.friends_list', compact('friends'))->render();
        $unaccept_friends_view = view('Friends.unaccept_friends', compact('unaccept_friends'))->render();
        return response()->json(['friends_list_view' => $friends_list_view, 'unaccept_friends_view' => $unaccept_friends_view]);
    }

    public function decline(Request $request){
        $friend = Friend::where('user_1', $request->user_1)->where('user_2', $request->user_2)->first();
        $friend->delete();
        $unaccept_friends = Friend::where('user_2', Auth::id())->where('accepted', 0)->get();
        $friends = Friend::where([['user_1', Auth::id()], ['accepted', 1]])->orWhere([['user_2', Auth::id()], ['accepted', 1]])->get();
        $friends_list_view = view('Friends.friends_list', compact('friends'))->render();
        $unaccept_friends_view = view('Friends.unaccept_friends', compact('unaccept_friends'))->render();
        return response()->json(['friends_list_view' => $friends_list_view, 'unaccept_friends_view' => $unaccept_friends_view]);
    }
}
