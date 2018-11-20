<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(Auth::check()){
            $page = Input::get('page', 1); // Get the ?page=1 from the url
            $perPage = 15; // Number of items per page
            $offset = ($page * $perPage) - $perPage;
            $posts = Auth::user()->getFriendsPosts();

            $posts = new LengthAwarePaginator(array_slice($posts, $offset, $perPage, true), count($posts), $perPage, $page,  ['path' => $request->url(), 'query' => $request->query()]);

            return view('home', compact('posts'));
            } else return 'nic';

    }
}
