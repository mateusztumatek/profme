<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Company;
use App\Employee;
use App\Friend;
use App\Image;
use App\Post;
use App\Privilege;
use App\Rate;
use App\Report;
use App\Roles;
use App\User;
use App\Education;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\URL;


class AdminController extends Controller
{
    public function index(Request $request){
        $reports = Report::getReports();
        $privileges = Privilege::paginate(10);
        $educations = Education::paginate(10);
        $users = User::paginate(10);
        $posts = Post::paginate(10);
        $companies = Company::paginate(10);
        $rates = Rate::paginate(10);
        return view('admin.index', compact('users','companies', 'reports', 'educations', 'posts', 'rates', 'privileges'));
    }

    public function userPermission(User $user){
        $roles = $user->getRoles();


        return response()->json(array(
            'user' => $user,
            'roles' => $roles,
        ));
    }

    public function userChangePermission(Request $request, User $user){
        Roles::where('user_id', $user->id)->where('name', '<>', 'admin' )->delete();

        if($request['permission']){
            foreach ($request['permission'] as $permission){
                if(!($user->hasRole('admin') && $permission == 'admin'))
                Roles::create([
                    'user_id' => $user->id,
                    'name' => $permission,
                ]);
            }
        }
        return back()->with(['message' => 'uprawnienia dla ' .$user->name .' zostaly zmienione']);
    }

    public function deleteUser(User $user){
        /*  Usuwanie wszystkich komentarzy, firm uzytkownikow, ocen ktorych dokonali rol i ich postów*/
        if($user->hasRole('admin')){
            return back()->with(['message' => 'nie można usunąć administratora']);
        }
        $user_name = $user->name;
        Comment::where('user_id', $user->id)->delete();
        Company::where('user_id', $user->id)->delete();
        Rate::where('user_id', $user->id)->delete();
        Employee::where('user_id', $user->id)->delete();
        Roles::where('user_id', $user->id)->delete();
        Post::where('user_id', $user->id)->delete();
        Education::where('user_id', $user->id)->delete();
        Report::where('user_id', $user->id)->delete();
        Friend::where('user_1', $user_id)->where('user_2', $user->id)->delete();
        Image::where('user_id', $user->id)->delete();
        User::findOrFail($user->id)->delete();

        return back()->with(['message' => 'użytkownik ' . $user_name . ' został usunięty.']);

    }

    public function showUser($term){
        $reports = Report::getReports();

        $users = User::where('name', 'LIKE', '%'. $term .'%')->paginate(10);
       $companies = Company::paginate(10);
        return view('admin.index', compact('users', 'companies', 'reports'));
    }


    public function showCompany($term){
        $reports = Report::getReports();

        $companies = Company::where('official_name', 'LIKE', '%'. $term .'%')->paginate(10);
        $users = User::paginate(10);
        return view('admin.index', compact('users', 'companies'));
    }

    public function getCompany(Company $company){
        return response()->json(Company::findOrFail($company->id));
    }

    public function editCompany(Request $request, Company $company){
        if($request->is_verify == 'on'){
            $request->is_verify = 1;
        } else $request->is_verify = 0;
        $user = User::findOrFail($company->user_id);
        $file = $request->file('logo');
        $this->validate($request, [
            'country' => 'required',
            'city' => 'required',
            'nip' => 'required|digits:10',
            'email' => 'required|email',

        ]);
        if ($request->hasFile('logo')) {
            if($company->image){
                unlink(public_path().'/public/users/'. $company->user_id . '/company/'. $company->id .'/'. $company->image);
            }
            $filename = $request->file('logo')->getClientOriginalName();
            $extension = $request->file('logo')->getClientOriginalExtension();
            $picture = sha1($filename . time()) . '.' . $extension;
        }
        else{
            $picture = null;
        }
        $company->official_name = $request->official_name;
        $company->email = $request->email;
        $company->postal_code = $request->postal_code;
        $company->street = $request->street;
        $company->street_number = $request->street_number;
        $company->nip = $request->nip;
        $company->city = $request->city;
        $company->country = $request->country;
        $company->is_verify = $request->is_verify;

        if($request->has('logo')){
            $company->image = $picture;
            $upload_path = 'public/users/' . $user->id .'/company/'. $company->id;
            $upload_success = $file->move($upload_path, $picture);
        }
        $company->save();

        return back()->with(['message' => 'firma '. $company->official_name .' została poprawnie edytowana' ]);
    }

    public function getEducation(Education $education){
        return  view('user.education_edit', compact('education'))->render();
    }

    public function getComments(Post $post){
        return view('admin.comments_modal', compact('post'))->render();
    }

    public function banUser(Request $request, User $user){
        $request->validate([
            'banned_to' => 'required|date'
        ]);
        if($user->hasRole('admin')){
            return back()->with(['message' => 'nie możesz zbanować administratora']);
        }
        $user->banned_at = Carbon::now();
        $user->banned_to = $request->banned_to;
        $user->update();
        if($request->banned_to < Carbon::today()){
            $message = 'użytkownik został odbanowany';
        } else{
            $message = 'użytkownik został zbanowany';
        }
        return back()->with(['message' => $message]);
    }
}
