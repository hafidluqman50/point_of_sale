<?php

namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TransaksiDetail;

class TransaksiDetailController extends Controller
{
	public function index($id)
	{
		$title = 'Transaksi Detail';
		$page  = 'transaksi';

		return view('Kasir.transaksi.detail',compact('title','page'));
	}
}
