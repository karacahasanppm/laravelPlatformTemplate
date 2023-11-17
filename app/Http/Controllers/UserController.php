<?php

namespace App\Http\Controllers;

use App\Http\Middleware\RedirectIfAuthenticated;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function detailPage ($id){

        $user = User::find($id);
        return view('manage-firm/user.detail',compact('user'));
    }

    public function updateUser(Request $request){

        $request->validate([
            'user_id' => 'required|integer',
            'email_input' => 'required|unique:users,email,'.$request->user_id,
            'name_input' => 'required',
            'role_select' => Rule::in('admin','user')
        ]);

        $user = User::find($request->user_id);

        $user->email = $request->email_input;
        $user->name = $request->name_input;
        if ($request->has('role_select')){
            $user->role = $request->role_select;
        }
        $user->save();

        return Redirect::back()->with(['success' => 'Successfully saved']);
    }
}
