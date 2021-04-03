<?php

namespace App\Http\Controllers\Gudang;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BarangKeluar;
use App\Models\BarangKeluarDetail;
use App\Models\JenisBarang;
use Auth;
use Str;

class BarangKeluarController extends Controller
{
    public function index()
    {
		$title    = 'Barang Keluar';
		$page     = 'barang-keluar';
		$treeview = 'inventory';

		return view('Gudang.barang-keluar.main',compact('title','page','treeview'));
    }

    public function tambah()
    {
		$title        = 'Barang Keluar Tambah';
		$page         = 'barang-keluar';
		$treeview     = 'inventory';
		$jenis_barang = JenisBarang::where('status_delete',0)->get();

		return view('Gudang.barang-keluar.tambah',compact('title','page','treeview','jenis_barang'));
    }

    public function save(Request $request)
    {
		$tanggal_barang_keluar = $request->tanggal_barang_keluar;
		$keterangan           = $request->keterangan;
		$id_barang_keluar	  = (string)Str::uuid();

		$data_barang_keluar	  = [
			'id_barang_keluar' => $id_barang_keluar,
			'tanggal_keluar'   => $tanggal_barang_keluar,
			'keterangan'       => $keterangan,
			'id_users'         => Auth::id()
		];

		BarangKeluar::create($data_barang_keluar);

		$barang        = $request->barang;
		$jumlah_keluar = $request->jumlah_keluar;

		for ($i=0; $i < count($barang); $i++) { 
			$data_keluar_detail[] = [
				'id_barang_keluar_detail' => (string)Str::uuid(),
				'id_barang_keluar'        => $id_barang_keluar,
				'id_barang'               => $barang[$i],
				'jumlah_barang'           => $jumlah_keluar[$i]
			];
		}

		BarangKeluarDetail::insert($data_keluar_detail);

		return redirect('/gudang/data-barang-keluar')->with('message','Berhasil Input Barang Keluar');
    }

    public function detail($id)
    {
		$title    = 'Barang Keluar Detail';
		$page     = 'barang-keluar';
		$treeview = 'inventory';

		return view('Gudang.barang-keluar.detail',compact('title','page','treeview'));
    }
}
