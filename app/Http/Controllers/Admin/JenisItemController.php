<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JenisItem;
use Str;

class JenisItemController extends Controller
{
    public function index()
    {
		$title    = 'Jenis Item';
		$page     = 'data-jenis-item';
		$treeview = 'item-jual';

		return view('Admin.jenis-item.main',compact('title','page','treeview'));
    }

    public function tambah()
    {
		$title    = 'Jenis Item';
		$page     = 'data-jenis-item';
		$treeview = 'item-jual';

		return view('Admin.jenis-item.tambah',compact('title','page','treeview'));
    }

    public function save(Request $request)
    {
    	$nama_jenis = $request->nama_jenis;
		$str_slug   = Str::slug($nama_jenis,'-');

		$data_jenis_item = [
			'nama_jenis'      => $nama_jenis,
			'nama_jenis_slug' => $str_slug
		];

		JenisItem::create($data_jenis_item);

		return redirect('/admin/data-jenis-item')->with('message','Berhasil Input Jenis Item');
    }

    public function edit($id)
    {
		$title    = 'Jenis Item';
		$page     = 'data-jenis-item';
		$treeview = 'item-jual';
		$row      = JenisItem::where('id_jenis_item',$id)->firstOrFail();

		return view('Admin.jenis-item.edit',compact('title','page','treeview','row'));
    }

    public function update($id,Request $request)
    {
		$nama_jenis = $request->nama_jenis;
		$str_slug   = Str::slug($nama_jenis,'-');

		$data_jenis_item = [
			'nama_jenis'      => $nama_jenis,
			'nama_jenis_slug' => $str_slug
		];

		JenisItem::where('id_jenis_item',$id)->update($data_jenis_item);

		return redirect('/admin/data-jenis-item')->with('message','Berhasil Update');
    }

    public function delete($id)
    {
    	JenisItem::where('id_jenis_item',$id)->update(['status_delete'=>1]);

    	return redirect('/admin/data-jenis-item')->with('message','Berhasil Hapus');
    }
}
