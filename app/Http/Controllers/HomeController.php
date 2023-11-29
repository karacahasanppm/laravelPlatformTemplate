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
     * @return \Illuminate\Contracts\Support\Renderable|\Illuminate\Http\RedirectResponse
     */
    public function index()
    {

        $user = User::find(Auth::id());
        if ($user->firm_id == 0 && $user->hasRole('SuperUser')){
            return redirect()->route('superuserDashboard');
        }elseif ($user->firm_id == 0){
            Auth::logout();
            return redirect()->route('login');
        } else{
            $recipients = $user->firm->recipients()->paginate(15);
        }

        return view('home',compact('user','recipients'));

    }



}
