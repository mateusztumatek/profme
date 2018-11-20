<?php

namespace App\Http\Controllers;

use App\Company;
use App\Education;
use App\Employee;
use App\Image;
use App\User;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Validation\Validator;
use Illuminate\Auth;

class UserController extends Controller
{
    public function edit(User $user){
        return view('user.edit_user', compact('user'));
    }
    public function company_create(){
        return view('user.company.create', compact('user'));
    }

    public function company_store(User $user, Request $request){
        $file = $request->file('logo');
        $this->validate($request, [
           'country' => 'required',
           'city' => 'required',
           'nip' => 'required|digits:10|unique:companies,nip',
            'email' => 'required|email|unique:companies,email',
            'logo' => 'mimes:jpeg,jpg,png'

        ]);
        if ($request->hasFile('logo')) {

            $filename = $request->file('logo')->getClientOriginalName();
            $extension = $request->file('logo')->getClientOriginalExtension();
            $picture = sha1($filename . time()) . '.' . $extension;
        }
        else{
            $picture = null;
        }
        $company = Company::create([
            'user_id' => $user->id,
            'email' => $request['email'],
            'official_name' => $request['name'],
            'city' => $request['city'],
            'postal_code' => $request['postal_code'],
            'street' => $request['street'],
            'street_number' => $request['street_number'],
            'country' => $request['country'],
            'nip' => $request['nip'],
            'image' => $picture,
        ]);
        if($request->has('logo')){
            $upload_path = 'public/users/' . $user->id .'/company/'. $company->id;
            $upload_success = $file->move($upload_path, $picture);
        }


        return back()->with(['succesfull' => true]);
    }

    public function company_edit(Company $company, Request $request){
        $user = User::findOrFail($company->user_id);
        $file = $request->file('logo');
        $this->validate($request, [
            'country' => 'required',
            'city' => 'required',
            'nip' => 'required|digits:10',
            'email' => 'required|email',
            'logo' => 'mimes:jpeg,jpg,png'

        ]);
        if ($request->hasFile('logo')) {

            $filename = $request->file('logo')->getClientOriginalName();
            $extension = $request->file('logo')->getClientOriginalExtension();
            $picture = sha1($filename . time()) . '.' . $extension;
            $company->image = $picture;
        }
        $company->email = $request->email;
        $company->official_name = $request->name;
        $company->city = $request->city;
        $company->postal_code = $request->postal_code;
        $company->street = $request->street;
        $company->street_number = $request->street_number;
        $company->country = $request->country;
        $company->nip = $request->nip;
        $company->update();
      /*  $company = Company::create([
            'user_id' => $user->id,
            'email' => $request['email'],
            'official_name' => $request['name'],
            'city' => $request['city'],
            'postal_code' => $request['postal_code'],
            'street' => $request['street'],
            'street_number' => $request['street_number'],
            'country' => $request['country'],
            'nip' => $request['nip'],
            'image' => $picture,
        ]);*/
        if($request->has('logo')){
            $upload_path = 'public/users/' . $user->id .'/company/'. $company->id;
            $upload_success = $file->move($upload_path, $picture);
        }


        return back()->with(['message' => 'twoja firma została edytowana pomyślnie']);
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
        $posts = Post::where('user_id', $user->id)->get();
        $employees = Employee::where('user_id', $user->id)->orderBy('since', 'desc')->get();
        $educations = Education::where('user_id', $user->id)->get();
        return view('user.user', compact('user', 'employees', 'educations', 'posts'));
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
