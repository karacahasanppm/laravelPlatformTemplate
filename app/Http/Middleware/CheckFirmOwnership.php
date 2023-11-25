<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckFirmOwnership
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if (!Auth::user()->hasRole('SuperUser') || Auth::user()->firm_id == "0"){
            if (Auth::user()->firm_id != $request->firm_id){
                abort(403,'You are not authorized to view this page.');
            }
        }
        return $next($request);
    }
}
