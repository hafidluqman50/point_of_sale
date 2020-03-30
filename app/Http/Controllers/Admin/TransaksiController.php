<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaksi;

class TransaksiController extends Controller
{
    public function index()
    {
		$title = 'Transaksi';
		$page  = 'transaksi';

		return view('Admin.transaksi.main',compact('title','page'));
    }

    public function delete($id)
    {
    	Transaksi::where('id_transaksi',$id)->delete();

    	return redirect('/admin/transaksi')->with('message','Berhasil Hapus Transaksi');
    }

    public function laporanTransaksi(Request $request)
    {
    	
    }
}
