<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InfoOutlet;
use Illuminate\Http\Request;

class InfoOutletController extends Controller
{
	public function index()
	{
		$title = 'Info Outlet | Admin';
		$page  = 'info-outlet';

		if (InfoOutlet::count() == 0) {
			$compact = compact('title','page');
		}
		else {
			$row     = InfoOutlet::firstOrFail();
			$compact = compact('title','page','row');
		}

		return view('Admin.info-outlet.main',$compact);
	}

	public function save(Request $request)
	{
		$nama_outlet   = $request->nama_outlet;
		$alamat_outlet = $request->alamat_outlet;
		$nomor_telepon = $request->nomor_telepon;
		$catatan       = $request->catatan;
		$id 		   = $request->id_info_outlet;

		$data_outlet = [
			'nama_outlet'   => $nama_outlet,
			'alamat_outlet' => $alamat_outlet,
			'nomor_telepon' => $nomor_telepon,
			'catatan'       => $catatan
		];

		if ($id == '') {
			InfoOutlet::create($data_outlet);
			$message = 'Berhasil Tambah Data Info Outlet';
		}
		else {
			InfoOutlet::where('id_info_outlet',$id)->update($data_outlet);
			$message = 'Berhasil Ubah Data Info Outlet';
		}

		return redirect('/admin/info-outlet')->with('message',$message);
	}
}
