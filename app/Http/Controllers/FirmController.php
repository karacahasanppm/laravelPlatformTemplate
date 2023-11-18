<?php

namespace App\Http\Controllers;

use App\Models\Firm;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FirmController extends Controller
{
    public function adminPage(){
        $users = User::query()
            ->where('firm_id','=',Auth::user()->firm_id)
            ->whereHas("roles",function ($q){
                $q->whereIn("name", ["Admin","User",'Viewer','Api']);
            })->get();
        $recipients = Firm::find(Auth::user()->firm_id)->recipients()->paginate(15);
        return view('manage-firm.admin',compact('users','recipients'));
    }
}
