<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {

            if (Auth::user()->hasRole('SuperUser')){

                return redirect()->route('superuserDashboard');

            }

            if (!Auth::user()->hasRole(['Admin','User','Viewer'])) {
                Auth::logout();
                return redirect('/login')->with('error', 'You are not authorized to log in.');
            }

            return redirect()->intended('/home');
        }

        return redirect('/login')->with('error', 'Login information is invalid.');
    }
}
