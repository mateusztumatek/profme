<?php

namespace App\Http\Controllers;

use App\Privilege;
use Illuminate\Http\Request;
use App\User;

class PrivilegeController extends Controller
{
    public function index(Privilege $privilege = null){
        return view('privilege.create')->render();
    }
    public function show(User $user){
        $privileges = $user->getPrivileges();
        return view('privilege.user_privileges', compact('user', 'privileges'));
    }

    public function store(Request $request){
        if($request->hasFile('image')){
            $file = $request->file('image');
            $filename = $request->file('image')->getClientOriginalName();
            $extension = $request->file('image')->getClientOriginalExtension();
            $image = $filename;
        } else {
            $filename = null;
        }
        if($request->active == 'on'){
            $request->active = 1;
        }else {
            $request->active = 0;
        }

        $request->validate([
            'name' => 'required',
            'user_id' => 'required',
            'count' => 'min:0',
            'rate' => 'min:0|max:4.9',
            'diligence_count' => 'min:0',
            'diligence' => 'min:0|max:4.9',
            'knowledge_count' => 'min:0',
            'knowledge' => 'min:0|max:4.9',
            'punctuality_count' => 'min:0',
            'punctuality' => 'min:0|max:4.9',
            'group' => 'required',
            'image' => 'required',
        ]);
        $privilege = Privilege::create([
            'name' => $request->name,
            'user_id' => $request->user_id,
            'count' => $request->count,
            'rate' => $request->rate,
            'diligence_count' => $request->diligence_count,
            'diligence' => $request->diligence,
            'knowledge_count' => $request->knowledge_count,
            'knowledge' => $request->knowledge,
            'punctuality_count' => $request->punctuality_count,
            'punctuality' => $request->punctuality,
            'group' => $request->group,
            'active' => $request->active,
            'icon' => $filename,
            'sex' => $request->sex,
            'description' => $request->description,
        ]);

        if(isset($image)){
            $path = 'public/privilege/'. $privilege->id;
            $file->move($path,$image);
        }

        return back()->with(['message' => 'przywilej został dodany poprawnie']);
    }

    public function edit(Privilege $privilege){
        return view('privilege.create', compact('privilege'))->render();
    }

    public function update(Request $request, Privilege $privilege){
        if($request->hasFile('image')){
            $file = $request->file('image');
            $filename = $request->file('image')->getClientOriginalName();
            $extension = $request->file('image')->getClientOriginalExtension();
            $image = $filename;
        } else {
            $filename = null;
        }
        if($request->active == 'on'){
            $request->active = 1;
            $privilege->active = 1;
        }else {
            $request->active = 0;
            $privilege->active = 0;
        }

        $request->validate([
            'name' => 'required',
            'count' => 'min:0',
            'rate' => 'min:0|max:4.9',
            'diligence_count' => 'min:0',
            'diligence' => 'min:0|max:4.9',
            'knowledge_count' => 'min:0',
            'knowledge' => 'min:0|max:4.9',
            'punctuality_count' => 'min:0',
            'punctuality' => 'min:0|max:4.9',
            'group' => 'required'
        ]);

        if($request->hasFile('image')){
            $privilege->deleteIcon();
            $path = 'public/privilege/'. $privilege->id;
            $file->move($path,$image);
            $privilege->icon = $filename;
        }
        $privilege->name = $request->name;
        $privilege->count = $request->count;
        $privilege->rate = $request->rate;
        $privilege->diligence_count = $request->diligence_count;
        $privilege->diligence = $request->diligence;
        $privilege->knowledge_count = $request->knowledge_count;
        $privilege->knowledge = $request->knowledge;
        $privilege->punctuality_count = $request->punctuality_count;
        $privilege->punctuality = $request->punctuality;
        $privilege->sex = $request->sex;
        $privilege->group = $request->group;
        $privilege->description = $request->description;
        $privilege->save();
        return back()->with(['message' => 'element '. $privilege->id. ' został edytowany poprawnie']);

    }

    public function destroy(Privilege $privilege){
        $privilege->deleteIcon();
        $privilege->delete();
        return back()->with(['message' => 'przywilej został usunięty']);
    }
}
