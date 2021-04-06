<?php

namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use App\Models\Tagihan;
use Illuminate\Http\Request;
use Auth;

class DashboardController extends Controller
{
	public function index()
	{
		$title = 'Dashboard | Kasir';
		$page  = 'dashboard';
		$dataset_transaksi = [];

		for ($i=1; $i <= 12; $i++) { 
			$transaksi = Transaksi::whereYear('tanggal_transaksi',date('Y'))->whereMonth('tanggal_transaksi',$i)->count();

			$dataset_transaksi[] = $transaksi;
		}

		$transaksi_per_year = Transaksi::selectRaw('YEAR(tanggal_transaksi) as tahun_transaksi, COUNT(*) as hitung')
										->groupBy('tahun_transaksi')
										->orderBy('tahun_transaksi','DESC')
										->limit(5)
										->get();

		$label_per_year   = [];
		$dataset_per_year = [];

		foreach ($transaksi_per_year as $key => $value) {
			$label_per_year[]   = $value->tahun_transaksi;
			$dataset_per_year[] = $value->hitung; 
		}

		$total_transaksi = Transaksi::where('tanggal_transaksi',date('Y-m-d'))->count();
		$total_tagihan   = Tagihan::where('status_tagihan','belum-lunas')->count();

		return view('Kasir.dashboard',compact('title','page','dataset_transaksi','label_per_year','dataset_per_year','total_transaksi','total_tagihan'));
	}

    public function settingsProfile()
    {
    	$title = 'Settins Profile | Kasir';
		$page  = '';

    	return view('Kasir.settings-profile',compact('title','page'));
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

		return redirect('/kasir/settings-profile')->with('message',$message);
	}
}
