<?php

namespace App\Http\Controllers\Gudang;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
		$title = 'Dashboard';
		$page  = 'dashboard';
    	return view('Gudang.dashboard',compact('title','page'));
    }

    public function settingsProfile()
    {
    	$title = 'Settins Profile | Gudang';

    	return view('Gudang.settings-profile',compact('title'));
    }

	public function save(Request $request)
	{
		$nama  	  = $request->nama;
		$username = $request->username;
		$password = $request->password;

		if (User::checkUsername($username) == false) {
			return redirect('/admin/settings-profile')->withInput($request->input());
		}

		$data_users = ['name' => $nama,'username' => $username,'password' => bcrypt($password)];

		if ($username == '' && $password != '') {
			unset($data_users['username']);
			if ($nama == '') {
				unset($data_users['name']);
			}
			User::where('id_users',Auth::id())
				->update($data_users);

			$message = 'Berhasil Ubah Password';
		}
		else if($username != '' && $password == '') {
			unset($data_users['password']);
			if ($nama == '') {
				unset($data_users['name']);
			}
			User::where('id_users',Auth::id())
				->update($data_users);	

			$message = 'Berhasil Ubah Username';
		}
		else if ($username != '' && $password != '') {
			if ($nama == '') {
				unset($data_users['name']);
			}
			User::where('id_users',Auth::id())
				->update($data_users);

			$message = 'Berhasil Ubah Username & Password';
		}

		return redirect('/gudang/settings-profile')->with('message',$message);
	}
}
