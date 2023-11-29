<?php

namespace App\Http\Controllers;

use App\Models\Firm;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FirmController extends Controller
{

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
