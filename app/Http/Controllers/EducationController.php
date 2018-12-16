<?php

namespace App\Http\Controllers;

use App\Education;
use App\Employee;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EducationController extends Controller
{
    public function store(Request $request, User $user){

        $request->validate([
            'institution' => 'required',
            'since' => 'required',
            'image' => 'required',
        ]);

        if($request->hasFile('image')){
            $file = $request->file('image');
            $path = 'public/users/'. Auth::id() .'/education';
            $filename = $request->file('image')->getClientOriginalName();
            $extension = $request->file('image')->getClientOriginalExtension();
            $image = $filename;
            $file->move($path,$image);
        } else {
            $filename = null;
        }

        Education::create([
           'user_id' => $user->id,
           'institution' => $request->institution,
           'direction_id' => $request->direction,
           'description' => $request->description,
           'active' => 1,
           'image_url' => $filename,
           'since' => $request->since,
           'untill' => $request->untill,
        ]);
        $educations = Education::where('user_id', $user->id)->get();
        return view('user.education_index', compact('user', 'educations'));
    }

    public function delete(Education $education){
        $user = User::findOrFail($education->user_id);
        $education->delete();
        $educations = Education::where('user_id', $user->id)->get();
        return view('user.education_index', compact('user', 'educations'));
    }

    public function edit(Education $education){
        return view('user.education_edit', compact('education'));
    }

    public function update(Request $request, Education $education){

        $user = User::findOrFail($education->user_id);
        $request->validate([
            'institution' => 'required',
            'since' => 'required',
        ]);

        if($request->hasFile('image')){
            $file = $request->file('image');
            $path = 'public/users/'. Auth::id() .'/education';
            $filename = $request->file('image')->getClientOriginalName();
            $extension = $request->file('image')->getClientOriginalExtension();
            $image = $filename;
            $file->move($path,$image);
            $education->image_url = $filename;

        } else {
            $filename = null;
        }

        $education->institution = $request->institution;
        $education->direction_id = $request->direction;
        $education->description = $request->description;
        $education->since = $request->since;
        $education->untill = $request->untill;
            if($request->active == 'on'){
                $education->active = 1;
            }else {
                $education->active = 0;
            }


        $education->update();
        $educations = Education::where('user_id', $user->id)->get();

        return view('user.education_index', compact('user', 'educations'));

    }
}
