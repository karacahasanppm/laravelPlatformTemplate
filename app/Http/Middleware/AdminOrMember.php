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

        if(Auth::user()->role !== 'superuser'){
            if(Auth::user()->role !== 'admin' ){
                if(Auth::id() != $request->id){
                    abort(403,'You are not authorized to view this page.');
                }
            }else{
                if (Auth::user()->firm_id != User::find($request->id)->firm_id){
                    abort(403,'You are not authorized to view this page.');
                }
            }
        }

        return $next($request);
    }
}
