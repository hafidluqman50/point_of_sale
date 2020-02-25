<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
		$title = 'Dashboard';
		$page  = 'dashboard';
    	return view('Admin.dashboard',compact('title','page'));
    }
}
