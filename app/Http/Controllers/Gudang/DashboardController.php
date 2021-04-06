<?php

namespace App\Http\Controllers\Gudang;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;

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
		$page  = '';

    	return view('Gudang.settings-profile',compact('title','page'));
    }

	public function save(Request $request)
	{
		$username = $request->username;
		$password = $request->password;

		if (User::checkUsername($username) == false) {
			return redirect('/admin/settings-profile')->withInput($request->input());
		}

		$data_users = ['username' => $username,'password' => bcrypt($password)];

		if ($username == '' && $password != '') {
			unset($data_users['username']);
			User::where('id_users',Auth::id())
				->update($data_users);

			$message = 'Berhasil Ubah Password';
		}
		else if($username != '' && $password == '') {
			unset($data_users['password']);
			User::where('id_users',Auth::id())
				->update($data_users);	

			$message = 'Berhasil Ubah Username';
		}
		else if ($username != '' && $password != '') {
			User::where('id_users',Auth::id())
				->update($data_users);

			$message = 'Berhasil Ubah Username & Password';
		}

		return redirect('/gudang/settings-profile')->with('message',$message);
	}
}
