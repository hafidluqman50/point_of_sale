<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BarangMasuk;
use App\Models\BarangMasukDetail;
use App\Models\Supplier;
use App\Models\JenisBarang;
use Auth;
use Str;

class BarangMasukController extends Controller
{
    public function index()
    {
		$title    = 'Barang Masuk';
		$page     = 'barang-masuk';
		$treeview = 'inventory';

		return view('Admin.barang-masuk.main',compact('title','page','treeview'));
    }

    public function tambah()
    {
		$title        = 'Barang Masuk Tambah';
		$page         = 'barang-masuk';
		$treeview     = 'inventory';
		$supplier     = Supplier::where('status_delete',0)->get();
		$jenis_barang = JenisBarang::where('status_delete',0)->get();
		return view('Admin.barang-masuk.tambah',compact('title','page','treeview','supplier','jenis_barang'));
    }

    public function save(Request $request)
    {
		$tanggal_barang_masuk = $request->tanggal_barang_masuk;
		$supplier             = $request->supplier;
		$keterangan           = $request->keterangan;
		$id_barang_masuk	  = (string)Str::uuid();
		$data_barang_masuk	  = [
			'id_barang_masuk' => $id_barang_masuk,
			'tanggal_masuk'   => $tanggal_barang_masuk,
			'id_supplier'     => $supplier,
			'keterangan'      => $keterangan,
			'id_users'        => Auth::id()
		];

		BarangMasuk::create($data_barang_masuk);

		$barang       = $request->barang;
		$jumlah_masuk = $request->jumlah_masuk;
		$harga_satuan = $request->harga_satuan;
		$harga_total  = $request->harga_total;

		for ($i=0; $i < count($barang); $i++) { 
			$data_masuk_detail[] = [
				'id_barang_masuk_detail' => (string)Str::uuid(),
				'id_barang_masuk'        => $id_barang_masuk,
				'id_barang'              => $barang[$i],
				'jumlah_masuk'           => $jumlah_masuk[$i],
				'harga_satuan'           => $harga_satuan[$i],
				'harga_total'            => $harga_total[$i]
			];
		}

		BarangMasukDetail::insert($data_masuk_detail);

		return redirect('/admin/data-barang-masuk')->with('message','Berhasil Input Barang Masuk');
    }

    public function detail($id)
    {
		$title    = 'Barang Masuk Detail';
		$page     = 'barang-masuk';
		$treeview = 'inventory';

		return view('Admin.barang-masuk.detail',compact('title','page','treeview'));
    }
}
