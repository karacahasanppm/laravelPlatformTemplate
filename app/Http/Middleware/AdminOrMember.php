<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use function PHPUnit\Framework\exactly;

class AdminOrMember
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::check()){
            $role = Auth::user()->role;
            if ($role !== 'superuser'){
                if ($role !== 'admin'){
                    if($role !== 'user'){
                        abort(403,'You are not authorized to view this page.');
                    }else{
                        if(Auth::id() != $request->id){
                            abort(403,'You are not authorized to view this page.');
                        }
                    }
                }else{
                    if (Auth::user()->firm_id != User::find($request->user_id)->firm_id){
                        abort(403,'You are not authorized to view this page.');
                    }
                }
            }
        }else{
            return redirect()->route('login');
        }

        return $next($request);
    }
}
