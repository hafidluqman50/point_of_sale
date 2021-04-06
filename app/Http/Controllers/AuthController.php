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
        $username = $request->username;
        $password = $request->password;

    	if (Auth::attempt(['username' => $username, 'password' => $password, 'status_delete' => 0])) 
    	{
    		if (Auth::user()->level_user == 2) 
    		{
    			return redirect('/admin/dashboard');
    		}
            else if (Auth::user()->level_user == 1) 
            {
                return redirect('/gudang/dashboard');
            }
    		else if(Auth::user()->level_user == 0)
    		{
    			return redirect('/kasir/dashboard');
    		}
    		else if (Auth::user()->status_akun == 0) 
    		{
                Auth::logout();
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
