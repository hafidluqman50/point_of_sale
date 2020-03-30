<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class isGudang
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check()) 
        {
            if (Auth::user()->level_user == 1) 
            {
                true;
            }
            else
            {
                return redirect('/');
            }
        }
        else
        {
            return redirect('/')->with('log','Login Dulu');
        }
        return $next($request);
    }
}
