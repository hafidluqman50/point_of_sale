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
		$title = 'Form Users';
		$page  = 'users';

		return view('Admin.users.tambah',compact('title','page'));
	}

	public function save(Request $request)
	{
		$name          = $request->name;
		$username      = $request->username;
		$password      = $request->password;
		$level_user    = $request->level_user;
		$status_akun   = 1;
		$status_delete = 0;

		$data_user = [
			'name'          => $name,
			'username'      => $username,
			'password'      => bcrypt($password),
			'level_user'    => $level_user,
			'status_akun'   => $status_akun,
			'status_delete' => $status_delete
		];

		User::create($data_user);

		return redirect('/admin/users/')->with('message','Berhasil Input User');
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
