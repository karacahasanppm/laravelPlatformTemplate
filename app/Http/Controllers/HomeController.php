<?php

namespace App\Http\Controllers;

use App\Models\Firm;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (auth()->user()->role !== 'superadmin'){
            $firm = Auth::user()->firm()->first();
            $role = Auth::user()->role;
            return view('home',compact('firm','role'));
        }else{
            $firm = Firm::all();
            $role = Auth::user()->role;
            return view('home',compact('firm','role'));
        }
    }



}
