<?php

namespace App\Http\Controllers;

use App\Image;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Validator;
use Illuminate\Auth;

class UserController extends Controller
{
    public function edit(User $user){
        return view('user.edit_user', compact('user'));
    }

    public function update(User $user, Request $request){

        $this->validate($request,[
           'name' => 'required|max:255',
            'date' => 'required|before:13 years ago',
            'city' => 'required',
            'phone'=> 'min:11|numeric',

        ], ['date' => 'data twoich urodzin nie moze byc pozniejsza niz 13 lat wstecz']);
        $user->update([
           'name' => $request['name'],
            'date_of_birth' => $request['date'],
            'city' => $request['city'],
            'phone' => $request['phone'],

        ]);



        return back();
    }
    public  function show( User $user){
        return view('user.user', compact('user'));
    }


    public function add_photo(User $user, Request $request){
        $file = $request->file('photo_input');

        if ($request->hasFile('photo_input')) {

            $filename = $request->file('photo_input')->getClientOriginalName();
            $extension = $request->file('photo_input')->getClientOriginalExtension();
            $upload_path = 'public/users/' . $user->id;
            $picture = sha1($filename . time()) . '.' . $extension;
            $upload_success = $file->move($upload_path, $picture);
            if($request->profile == 'on'){
                $profile = 1;
                $images = Image::where('user_id', $user->id)->where('avatar', 1)->get();
                foreach ($images as $image){
                    $image->avatar = 0;
                    $image->save();
                }

            }else {
                $profile = 0;
            }

            Image::create([
                'path' => $picture,
                'user_id' => $user->id,
                'tags' => $request->tags,
                'active' => $request->active,
                'avatar' => $profile,
            ]);

        }
        return back();
    }

    public function updateProfileImage(Image $image){

        $image->setAvatar($image);
        return back();
    }

    public function changeActiveImage(Image $image){
        $image->changeActive();
        return back();
    }
    public function deleteImage(Image $image){
        $image->delete();
        return back();
    }
}
