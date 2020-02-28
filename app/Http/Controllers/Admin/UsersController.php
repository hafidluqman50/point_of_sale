<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
	public function index()
	{
		$title = 'Users';
		$page  = 'users';

		return view('Admin.users.main',compact('title','page'));
	}

	public function tambah()
	{

	}

	public function save(Request $request)
	{

	}

	public function edit($id)
	{

	}

	public function update($id,Request $request)
	{
		
	}

	public function delete($id)
	{

	}
}
