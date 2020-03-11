<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BarangMasuk;

class BarangMasukController extends Controller
{
    public function index()
    {
		$title    = 'Barang Masuk';
		$page     = 'barang-masuk';
		$treeview = 'inventory';

		return view('Admin.barang-masuk.main',compact('title','page','treeview'));
    }
}
