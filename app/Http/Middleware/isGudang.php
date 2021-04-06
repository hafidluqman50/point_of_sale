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
            if (Auth::user()->status_delete == 0) 
            {
                if (Auth::user()->level_user == 1 && Auth::user()->status_akun == 1) 
                {
                    true;
                }
                else if (Auth::user()->level_user == 1 && Auth::user()->status_akun == 0) 
                {
                    Auth::logout();
                    return redirect('/')->with('log','Akun Anda Di Nonaktifkan');
                }
                else {
                    return redirect('/');
                }
            }
            else if(Auth::user()->status_delete == 1)
            {
                Auth::logout();
                return redirect('/')->with('log','Akun Anda Di Hapus');
            }
        }
        else
        {
            return redirect('/')->with('log','Login Dulu');
        }
        return $next($request);
    }
}
