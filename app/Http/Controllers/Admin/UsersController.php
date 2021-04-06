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
		$title = 'Form Users';
		$page  = 'users';
		$row   = User::where('id_users',$id)->firstOrFail();

		return view('Admin.users.edit',compact('title','page','row','id'));
	}

	public function update($id,Request $request)
	{
		$nama       = $request->nama;
		$username   = $request->username;
		$password   = $request->password;
		$level_user = $request->level_user;

		if (User::checkUsername($username) == false) {
			return redirect('/admin/users/edit/'.$id)->withInput($request->input());
		}

		$data_users = [
						'name'       => $nama,
						'username'   => $username,
						'password'   => bcrypt($password), 
						'level_user' => $level_user
					  ];

		if ($username == '' && $password != '') {
			unset($data_users['username']);
			User::where('id_users',$id)
				->update($data_users);
		}
		else if($username != '' && $password == '') {
			unset($data_users['password']);
			User::where('id_users',$id)
				->update($data_users);	
		}
		else if ($username != '' && $password != '') {
			User::where('id_users',$id)
				->update($data_users);
		}
		else {
			unset($data_users['username']);
			unset($data_users['password']);
			User::where('id_users',$id)
				->update($data_users);
		}

		return redirect('/admin/users')->with('message','Berhasil Update User');
	}

	public function delete($id)
	{
		User::where('id_users',$id)->update(['status_delete' => 1]);

		return redirect('/admin/users')->with('message','Berhasil Hapus User');
	}

    public function statusAkun($id) {
    	$status_akun = User::where('id_users',$id)->firstOrFail()->status_akun;
    	if ($status_akun == 1) {
    		User::where('id_users',$id)->update(['status_akun'=>0]);
    		$message = 'Berhasil Non Aktifkan';
    	}
    	else {
    		User::where('id_users',$id)->update(['status_akun'=>1]);
    		$message = 'Berhasil Aktifkan';	
    	}
    	return redirect('/admin/users')->with('message',$message);
    }
}
