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
            $user = User::with(['firm'])->find(Auth::id());
            $recipients = Firm::find($user->firm->id)->recipients()->paginate(15);
            return view('home',compact('user','recipients'));
        }else{
            $firms = Firm::all();
            $user = User::find(Auth::id());
            return view('home',compact('firms','user'));
        }
    }



}
