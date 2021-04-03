<?php

namespace App\Http\Controllers\Gudang;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JenisBarang;
use App\Models\Barang;

class BarangController extends Controller
{
    public function index()
    {
		$title    = 'Barang';
		$page     = 'barang';
		$treeview = 'inventory';

		return view('Gudang.barang.main',compact('title','page','treeview'));
    }

    public function tambah()
    {
		$title        = 'Barang Tambah';
		$page         = 'barang';
		$treeview     = 'inventory';
		$jenis_barang = JenisBarang::where('status_delete',0)->get();

		return view('Gudang.barang.tambah',compact('title','page','treeview','jenis_barang'));
    }

    public function save(Request $request)
    {
		$nama_barang     = $request->nama_barang;
		$id_jenis_barang = $request->jenis_barang;
		$stok_barang     = $request->stok_barang;
		$satuan_stok     = $request->satuan_stok;

		$data_barang = [
			'nama_barang'     => $nama_barang,
			'id_jenis_barang' => $id_jenis_barang,
			'stok_barang'     => $stok_barang,
			'satuan_stok'     => ucwords($satuan_stok)
		];

		Barang::create($data_barang);

		return redirect('/gudang/data-barang')->with('message','Berhasil Input Barang');
    }

    public function edit($id)
    {
		$title        = 'Barang Edit';
		$page         = 'barang';
		$treeview     = 'inventory';
		$jenis_barang = JenisBarang::where('status_delete',0)->get();
		$row          = Barang::where('id_barang',$id)->firstOrFail();

		return view('Gudang.barang.edit',compact('title','page','treeview','jenis_barang','row','id'));
    }

    public function update($id,Request $request)
    {
		$nama_barang     = $request->nama_barang;
		$id_jenis_barang = $request->jenis_barang;
		$stok_barang     = $request->stok_barang;
		$satuan_stok     = $request->satuan_stok;

		$data_barang = [
			'nama_barang'     => $nama_barang,
			'id_jenis_barang' => $id_jenis_barang,
			'stok_barang'     => $stok_barang,
			'satuan_stok'     => ucwords($satuan_stok)
		];

		Barang::where('id_barang',$id)->update($data_barang);

		return redirect('/gudang/data-barang')->with('message','Berhasil Update Barang');
    }

    public function delete($id)
    {
    	Barang::where('id_barang',$id)->update(['status_delete'=>1]);

    	return redirect('/gudang/data-barang')->with('message','Berhasil Hapus Barang');
    }
}
