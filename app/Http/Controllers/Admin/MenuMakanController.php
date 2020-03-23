<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\MenuMakan;

class MenuMakanController extends Controller
{
	public function index()
	{
		$title = 'Menu Makan';
		$page  = 'menu-makan';

		return view('Admin.menu-makan.main',compact('title','page'));
	}

	public function tambah()
	{
		$title = 'Menu Makan Tambah';
		$page  = 'menu-makan';

		return view('Admin.menu-makan.tambah',compact('title','page'));
	}

	public function save(Request $request)
	{
		$nama_menu   = $request->nama_menu;
		$harga_menu  = $request->harga_menu;
		$foto_menu   = $request->foto_menu;
		$fileName	 = $foto_menu != '' ? uniqid().'_foto_menu_'.$foto_menu->getClientOriginalName() : '-';
		$status_menu = $request->status_menu;

		$data_menu = [
			'nama_menu'     => $nama_menu,
			'harga_menu'    => $harga_menu,
			'foto_menu'     => $fileName,
			'status_menu'   => $status_menu
		];

		if ($foto_menu != '') {
			Image::make($foto_menu)->resize(250,250)->save('assets/foto_menu/'.$fileName);
		}

		MenuMakan::create($data_menu);

		return redirect('/admin/menu-makan')->with('messages','Berhasil Input Menu');
	}

	public function edit($id)
	{
		$title = 'Menu Makan Edit';
		$page  = 'menu-makan';
		$row   = MenuMakan::where('id_menu_makan',$id)->firstOrFail();

		return view('Admin.menu-makan.edit',compact('title','page','row','id'));
	}

	public function update($id,Request $request)
	{
		$nama_menu   = $request->nama_menu;
		$harga_menu  = $request->harga_menu;
		$foto_menu   = $request->foto_menu;
		$fileName	 = $foto_menu != '' ? uniqid().'_foto_menu_'.$foto_menu->getClientOriginalName() : '';
		$status_menu = $request->status_menu;
		$menu_makan  = MenuMakan::where('id_menu_makan',$id)->firstOrFail();

		$data_menu = [
			'nama_menu'     => $nama_menu,
			'harga_menu'    => $harga_menu,
			'foto_menu'     => $fileName,
			'status_menu'   => $status_menu
		];

		if ($fileName == '') {
			unset($data_menu['foto_menu']);
		}
		else {
			remove_file('assets/foto_menu/',$menu_makan->foto_menu);
			Image::make($foto_menu)->resize(250,250)->save('assets/foto_menu/'.$fileName);
		}

		MenuMakan::where('id_menu_makan',$id)->update($data_menu);

		return redirect('/admin/menu-makan')->with('message','Berhasil Edit Menu Makan');
	}

	public function delete($id)
	{
		
	}
}
