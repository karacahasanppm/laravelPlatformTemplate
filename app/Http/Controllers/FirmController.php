<?php

namespace App\Http\Controllers;

use App\Models\Firm;
use App\Models\User;
use Illuminate\Http\Request;

class FirmController extends Controller
{
    public function adminPage(){
        return view('manage-firm.admin');
    }
}
