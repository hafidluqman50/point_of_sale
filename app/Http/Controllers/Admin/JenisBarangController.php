<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\JenisBarang;

class JenisBarangController extends Controller
{
    public function index()
    {
		$title    = 'Jenis Barang';
		$page     = 'jenis-barang';
		$treeview = 'inventory';

		return view('Admin.jenis-barang.main',compact('title','page','treeview'));
    }

    public function tambah()
    {
		$title    = 'Jenis Barang Tambah';
		$page     = 'jenis-barang';
		$treeview = 'inventory';

		return view('Admin.jenis-barang.tambah',compact('title','page','treeview'));
    }

    public function save(Request $request)
    {
    	$nama_jenis = $request->nama_jenis;

    	$data_jenis_barang = ['nama_jenis' => $nama_jenis];

    	JenisBarang::create($data_jenis_barang);

    	return redirect('/admin/data-jenis-barang')->with('message','Berhasil Tambah Jenis Barang');
    }

    public function edit($id)
    {
		$title    = 'Jenis Barang Edit';
		$page     = 'jenis-barang';
		$treeview = 'inventory';
		$row	  = JenisBarang::where('id_jenis_barang',$id)->firstOrFail();

		return view('Admin.jenis-barang.edit',compact('title','page','treeview','row','id'));
    }

    public function update($id,Request $request)
    {
    	$nama_jenis = $request->nama_jenis;

    	$data_jenis_barang = ['nama_jenis' => $nama_jenis];

    	JenisBarang::where('id_jenis_barang',$id)
    				->update($data_jenis_barang);

    	return redirect('/admin/data-jenis-barang')->with('message','Berhasil Update Jenis Barang');
    }

    public function delete($id)
    {
    	JenisBarang::where('id_jenis_barang',$id)
    				->update(['status_delete' => 1]);

    	return redirect('/admin/data-jenis-barang')->with('message','Berhasil Menghapus Jenis Barang');
    }
}
