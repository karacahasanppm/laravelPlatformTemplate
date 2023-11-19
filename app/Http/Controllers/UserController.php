<?php

namespace App\Http\Controllers;

use App\Models\Firm;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;
use function PHPUnit\Framework\isNull;

class UserController extends Controller
{
    public function detailPage ($firmId,$userId){
        $user = User::where('firm_id','=',$firmId)->find($userId);
        if (is_null($user)){
            return redirect()->back()->with(['error' => 'User Not Found.']);
        }
        $roles = Role::query()->where('name','!=','SuperUser')->get();
        return view('manage-firm/user.detail',compact('user','roles'));
    }

    public function profilePage($firmId,$userId){
        $user = Auth::user();
        return view('manage-firm/user.profile',compact('user'));
    }

    public function updateUser(Request $request){

         $rules = [
             'user_id' => 'required|integer',
             'email_input' => 'required|unique:users,email,'.$request->user_id,
             'name_input' => 'required',
             'role_select' => Rule::in('Admin','User','Viewer'),
             'password' => 'nullable|string|min:8|max:30|confirmed',
         ];

        $request->validate($rules);

        $user = User::find($request->user_id);

        if (!Auth::user()->hasRole(['Admin','SuperUser'])){
            if(!$request->has('password_old')){
                return redirect()->back()->with(['error' => 'Current Password field is required.']);
            }
            if (!Hash::check($request->password_old,$user->password)){
                return redirect()->back()->with(['error' => 'Current Password does not match.']);
            }
        }

        $user->email = $request->email_input;
        $user->name = $request->name_input;
        if ($request->has('password')){
            $user->password = Hash::make($request->password);
        }
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

    public function deleteUser ($firmId,$id){

        $user = User::findOrFail($id);

        $user->delete();

        return Redirect::route('adminPage',$firmId)->with(['success' => 'Successfully deleted user '.$id]);

    }
}
