<?php

namespace App\Http\Controllers;

use App\Models\Firm;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FirmController extends Controller
{
    public function adminPage(){
        $users = Firm::find(Auth::user()->firm_id)->users()->where('role','!=','superadmin')->get();
        return view('manage-firm.admin',compact('users'));
    }
}
