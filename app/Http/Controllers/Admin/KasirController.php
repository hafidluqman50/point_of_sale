<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MenuMakan;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;

class KasirController extends Controller
{
    public function index()
    {
    	$title = 'Kasir';

    	return view('Admin.kasir.main',compact('title'));
    }
}
