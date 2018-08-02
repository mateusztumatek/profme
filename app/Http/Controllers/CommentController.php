<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function __construct()
    {

    }

    public function store(Request $request){
        $comment  = Comment::create($request->all());
        $user = $comment->getUser();
        $comment['user'] = $user->name;
        $comment['user_image'] = $user->getProfileURL();
        $comment['created'] = $comment->created_at->diffForHumans();
        return response()->json($comment);
    }

    public function update(Request $request, $id){
        $comment = Comment::findOrFail($id);
        $comment->content = $request->content;
        $comment->save();

        return back()->with(['message' => 'komentarz został edytowany!']);
    }

    public function delete(Request $request, $id){
        Comment::findOrFail($id)->delete();


        return back()->with(['message' => 'komentarz został usuniety!']);
    }
}
