<?php

namespace App\Http\Controllers;

use App\Models\Firm;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FirmController extends Controller
{
    public function adminPage(){
        $users = Firm::find(Auth::user()->firm_id)->users()->whereIn('role',['admin','user'])->get();
        return view('manage-firm.admin',compact('users'));
    }
}
