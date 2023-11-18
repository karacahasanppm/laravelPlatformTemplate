<?php

namespace App\Http\Controllers;

use App\Http\Middleware\RedirectIfAuthenticated;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;
use const http\Client\Curl\AUTH_ANY;

class UserController extends Controller
{
    public function detailPage ($id){

        $user = User::find($id);
        $roles = Role::all();
        return view('manage-firm/user.detail',compact('user','roles'));
    }

    public function updateUser(Request $request){

        $request->validate([
            'user_id' => 'required|integer',
            'email_input' => 'required|unique:users,email,'.$request->user_id,
            'name_input' => 'required',
            'role_select' => Rule::in('Admin','User','Viewer')
        ]);

        $user = User::find($request->user_id);

        $user->email = $request->email_input;
        $user->name = $request->name_input;
        $user->save();
        if ($request->has('role_select')){
            $user->syncRoles($request->role_select);
        }

        return Redirect::back()->with(['success' => 'Successfully saved']);
    }

    public function createUserPage(){
        $roles = Role::query()->where('name','!=','SuperUser')->get();
        return view('manage-firm/user.new',compact('roles'));
    }

    public function createUser(Request $request){

        $firmId = Auth::user()->firm_id;

        $request->validate([
            'email_input' => 'required|email|unique:users,email,'.$request->user_id,
            'name_input' => 'required|string|min:3|max:30',
            'role_select' => 'required|'.Rule::in('Admin','User','Viewer','Api'),
            'password' => 'required|string|min:8|max:30|confirmed',
        ]);

        $user = new User();
        $user->name = $request->name_input;
        $user->email = $request->email_input;
        $user->firm_id = $firmId;
        $user->password = Hash::make($request->password);
        $user->syncRoles($request->role_select);
        $user->save();
        if ($request->role_select === 'Api'){
            $user->createToken('api-token')->plainTextToken;
        }
        return Redirect::back()->with(['success' => 'Successfully saved']);
    }
}
