<?php

namespace App\Http\Controllers;

use App\Models\Firm;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;

class FirmController extends Controller
{
    public function createFirm(Request $request){

        $request->validate([
            'name_input' => 'required|string|unique:firms,name|min:3|max:30'
        ]);

        $firm = new Firm();
        $firm->name = $request->name_input;
        $firm->save();

        return Redirect::back()->with(['success' => 'Successfully saved']);

    }
    public function adminPage(Request $request){

        $users = User::query()
            ->where('firm_id','=',Auth::user()->firm_id)
            ->whereHas("roles",function ($q){
                $q->whereIn("name", ["Admin","User",'Viewer','Api']);
            })->get();

        if (isset($request->q)){

            $recipients = Firm::find(Auth::user()->firm_id)->recipients()
                ->where(function ($query) use ($request){
                $query->where('recipient','LIKE',"%{$request->q}%");
                $query->orWhere('recipient_type','LIKE',"%{$request->q}%");
            })->paginate(15);

        }else{

            $recipients = Firm::find(Auth::user()->firm_id)->recipients()->paginate(15);

        }

        return view('manage-firm.admin',compact('users','recipients'));
    }
}
