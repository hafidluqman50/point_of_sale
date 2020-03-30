<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BarangKeluar;

class BarangKeluarController extends Controller
{
    public function index()
    {
		$title    = 'Barang Keluar';
		$page     = 'barang-keluar';
		$treeview = 'inventory';

		return view('Admin.barang-keluar.main',compact('title','page','treeview'));
    }

    public function tambah()
    {
		$title    = 'Barang Keluar Tambah';
		$page     = 'barang-keluar';
		$treeview = 'inventory';

		return view('Admin.barang-keluar.tambah',compact('title','page','treeview'));
    }
}
