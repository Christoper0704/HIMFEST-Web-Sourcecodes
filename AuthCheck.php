<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthCheck
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
        //prevent directing opening Dashboard without logged in
        if(!session()->has('LoggedUser') && ($request->path() !='auth/login' && $request->path() !='auth/register')){
            return redirect('auth/login')->with('fail','You must be logged in');
        }

        if(session()->has('LoggedUser') && ($request->path() =='auth/login' || $request->path() =='auth/register')){
            return back();
        }
        //prevent going back after Logged out
        return $next($request)->header('Cache-Control','no-cache, no-store, max-age=0, must-revalidate')
                              ->header('Pragma','no-cache')
                              ->header('Expires','sSat 01 Jan 1990 00:00:00 GMT');
    }
}
