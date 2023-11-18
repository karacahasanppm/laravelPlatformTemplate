<?php

namespace App\Http\Controllers;

use App\Http\Middleware\RedirectIfAuthenticated;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

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
}
