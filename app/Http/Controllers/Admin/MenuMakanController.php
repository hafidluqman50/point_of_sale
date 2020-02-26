<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
}
