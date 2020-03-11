<?php

namespace App\Http\Controllers\Admin;

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

		return view('Admin.barang.main',compact('title','page','treeview'));
    }

    public function tambah()
    {
		$title    = 'Barang Tambah';
		$page     = 'barang';
		$treeview = 'inventory';

		return view('Admin.barang.tambah',compact('title','page','treeview'));
    }
}
