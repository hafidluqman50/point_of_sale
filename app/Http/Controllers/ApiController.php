<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MenuMakan;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use App\Models\Barang;
use Auth;
use Str;

class ApiController extends Controller
{
    public function dataMenu()
    {
    	$menu_makan = MenuMakan::where('status_delete',0)->get();

    	return response()->json($menu_makan);
    }

    public function dataMenuCheckout(Request $request)
    {
		$pesanan     = $request->pesanan;
		$total_harga = $request->total_harga;
		$total_bayar = $request->total_bayar;
		$keterangan  = $request->keterangan;
		
		$id_transaksi = (string)Str::uuid();
    	Transaksi::create([
			'id_transaksi'		=> $id_transaksi,
			'tanggal_transaksi' => date('Y-m-d'),
			'total_harga'		=> $total_harga,
			'total_bayar'		=> $total_bayar,
			'keterangan'		=> $keterangan,
			'id_users'          => Auth::id()
    	]);

		for ($i=0; $i < count($pesanan); $i++) { 
			$insert_data[] = [
				'id_transaksi_detail' => (string)Str::uuid(),
				'id_transaksi'        => $id_transaksi,
				'id_menu_makan'       => $pesanan[$i]['id_menu_makan'],
				'banyak_pesan'        => $pesanan[$i]['banyak_pesan'],
				'sub_total'           => $pesanan[$i]['sub_total'],
				'keterangan'          => $pesanan[$i]['keterangan'],
				'created_at'          => date('Y-m-d H:i:s'),
				'updated_at'          => date('Y-m-d H:i:s'),
			];
		}

		TransaksiDetail::insert($insert_data);

		return response()->json(['message' => 'Berhasil Input Pesanan']);
    }

    public function dataPembayaran() 
    {
    	$pembayaran = Transaksi::where('tanggal_transaksi',now()->toDateString())->get();

    	return response()->json($pembayaran);
    }

    public function ajaxDataBarang($id)
    {
    	$barang = Barang::where('id_jenis_barang',$id)
    					->where('status_delete',0)
    					->get();

    	return $barang;
    }
}
