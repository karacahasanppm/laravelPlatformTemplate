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
        $user = Auth::user();
        $requestedUser = User::find($request->user_id);
        if(Auth::check()){
            if (!$user->hasRole('SuperUser')){
                if (!$user->hasRole('Admin')){
                    if(!$user->hasRole(['User','Viewer'])){
                        abort(403,'You are not authorized to view this page.');
                    }else{
                        if($user->id != $request->user_id){
                            abort(403,'You are not authorized to view this page.');
                        }
                    }
                }else{
                    if ($user->firm_id != $requestedUser->firm_id){
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
