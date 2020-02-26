<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class hasAuth
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
                return redirect('/admin/dashboard');
            }
            else if (Auth::user()->level_user == 0) 
            {
                return redirect('/petugas/kasir');
            }
        }
        return $next($request);
    }
}
