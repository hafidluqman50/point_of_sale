<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TransaksiDetail;

class TransaksiDetailController extends Controller
{
	public function index($id)
	{
		$title = 'Transaksi Detail';
		$page  = 'transaksi';

		return view('Admin.transaksi.detail',compact('title','page'));
	}

	public function delete($id,$id_detail)
	{
		TransaksiDetail::where('id_transaksi',$id)
						->where('id_transaksi_detail',$id_detail)
						->delete();

		return redirect('/admin/transaksi/detail/'.$id)->with('message','Berhasil Hapus Data');
	}
}
