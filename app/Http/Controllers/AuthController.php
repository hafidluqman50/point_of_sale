<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class AuthController extends Controller
{
    public function index()
    {
    	return view('login');
    }

    public function login(Request $request)
    {
    	$auth = $request->only('username','password');

    	if (Auth::attempt($auth)) 
    	{
    		if (Auth::user()->level_user == 1) 
    		{
    			return redirect('/admin/dashboard');
    		}
    		else if(Auth::user()->level_user == 0)
    		{
    			return redirect('/petugas/kasir');
    		}
    		else if (Auth::user()->status_akun == 0) 
    		{
    			return redirect('/')->with('log','Akun Non Aktif');
    		}
    	}
    	else
    	{
    		return redirect('/')->with('log','Username Dan Password Salah');
    	}
    }

    public function logout()
    {
    	Auth::logout();

    	return redirect('/');
    }
}
