<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
		$fileName	 = $foto_menu->getClientOriginalName();
		$status_menu = $request->status_menu;

		$data_menu = [
			'id_menu_makan' => (string)Str::uuid(),
			'nama_menu'     => $nama_menu,
			'harga_menu'    => $harga_menu,
			'foto_menu'     => $fileName,
			'status_menu'   => $status_menu
		];

		$foto_menu->move(public_path('assets/foto_menu/'),$fileName);

		MenuMakan::create($data_menu);

		return redirect('/admin/menu-makan')->with('messages','Berhasil Input Menu');
	}

	public function edit($id)
	{

	}

	public function update($id,Request $request)
	{

	}

	public function delete($id)
	{
		
	}
}
