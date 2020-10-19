<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UserProfessorMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::user()->isProfessor()){
            return $next($request);
        }
        
        return redirect()->back()->with('warning', 'You are not allowed to access, only admins can');
    }
}
