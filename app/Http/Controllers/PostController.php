<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use foo\bar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('post/create_post');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if($request->hasFile('image')){
            $file = $request->file('image');
            $path = 'public/users/'. Auth::id();
            $filename = $request->file('image')->getClientOriginalName();
            $extension = $request->file('image')->getClientOriginalExtension();
            $image = $filename;
            $file->move($path,$image);
        } else {
            $filename = null;
        }


        $request->validate([
           'title' => 'required|max:255',
        ]);

        $post = Post::create([
           'user_id' => Auth::id(),
           'title' => $request->title,
           'description' => $request->description,
           'image' => $filename,

        ]);

        if($request->has('tags')){
            foreach ($request->tags as $tag){
                DB::table('tags')->insert([
                    'elem_id' => $post->id,
                    'type' => 'post',
                    'tag' => $tag,
                ]);
            }
        }

        return back()->with(['message' => 'twoj post został dodany poprawnie!']);


    }
    public function user_posts($us){
        $user = User::find($us);
        $posts = Post::where('user_id', $us)->get();

        return view('post.user_posts', compact('user', 'posts'));
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return view('post.edit_post', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $post = Post::findOrFail($id);
        if($request->hasFile('image-edit')){
            if(file_exists(public_path().'/public/users/'.$post->user_id.'/'.$post->image))
            unlink(public_path().'/public/users/'.$post->user_id.'/'.$post->image);
            $file = $request->file('image-edit');
            $path = 'public/users/'. Auth::id();
            $filename = $request->file('image-edit')->getClientOriginalName();
            $extension = $request->file('image-edit')->getClientOriginalExtension();
            $image = $filename;
            $file->move($path,$image);
        }



        $post->description = $request->description;
        $post->title = $request->title;
        if($request->hasFile('image-edit')){
            $post->image = $filename;
        }
        $post->save();
        DB::table('tags')->where('elem_id', $post->id)->delete();
        if($request->has('tags')){
            foreach ($request->tags as $tag){
                DB::table('tags')->insert([
                    'elem_id' => $post->id,
                    'type' => 'post',
                    'tag' => $tag,
                ]);
            }
        }
        return back()->with(['message' => 'twoj post zostal edytowany']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $post = Post::findOrFail($id);
        if(file_exists(public_path().'/public/users/'. $post->user_id.'/'.$post->image)){
            unlink(public_path().'/public/users/'. $post->user_id.'/'.$post->image);
        }
        $post->deleteTags();
        $post->deleteRates();
       /* $post->deleteComments();*/
        $post->delete();
        return back()->with(['message' => 'twój post został usunięty poprawnie']);
    }


}
