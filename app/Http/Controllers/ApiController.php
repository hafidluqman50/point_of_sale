<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use App\Models\MenuMakan;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use App\Models\Barang;
use Auth;
use Str;

class ApiController extends Controller
{
	public function __construct()
	{
		$this->middleware(function($request,$next){
			session_expired();
			
			return $next($request);
		});
	}

    public function dataMenu()
    {
    	$menu_makan = MenuMakan::where('status_delete',0)->get();

    	return response()->json($menu_makan);
    }

    public function dataMenuCari(Request $request)
    {
    	$cari_menu = $request->cari_menu;

    	$data_cari = MenuMakan::where('nama_menu','like','%'.$cari_menu.'%')
    						  ->where('status_delete',0)
			    			  ->get();

    	return response()->json($data_cari);
    }

    public function listMenu()
    {
    	$get_menu = [];
    	if (session()->has('data_session')) {
    		$data_session = session()->get('data_session');
			if (count($data_session['list_menu']) != count($get_menu)) {
		    	for ($i=0; $i < count($data_session['list_menu']); $i++) {
	    			$get_menu[$i] = array_values($data_session['list_menu'])[$i];
		    	}
			}

	    	$list_menu = [
				'list_menu'    => $get_menu,
				'total_harga'  => $data_session['total_harga'],
				'time_expired' => $data_session['time_expired'],
	    	];

	    	session()->put('data_session',$list_menu);
    	}
    	else {
    		$data_session = [
				'list_menu'    => [],
				'total_harga'  => 0,
				'time_expired' => '',
    		];

    		session()->put('data_session',$data_session);

    		$list_menu = $data_session;
    	}

    	return $list_menu;
    }

    public function tambahListMenu(Request $request)
    {
		if (session()->has('data_session')) {
			$session   = session()->get('data_session');
		}
		else {
			$session = [
				'list_menu'    => [],
				'total_harga'  => 0,
				'time_expired' => '',
    		];

    		session()->put('data_session',$session);
		}

		$data_menu = json_decode($request->data_menu,TRUE);

    	array_push($session['list_menu'],$data_menu);

		$session['time_expired'] = generate_time(60*60);
		$session['total_harga']+=$data_menu['sub_total'];

    	session()->put('data_session',$session);

    	return session()->get('data_session');
    }

    public function updateListMenu(Request $request)
    {
		$session       = session()->get('data_session');
		$data_update   = json_decode($request->data_update,TRUE);
		$index_arr     = $data_update['indexMenu'];
		$get_sub_total = $session['list_menu'][$index_arr]['sub_total'];

		$session['total_harga']-=$get_sub_total;

		$session['list_menu'][$index_arr]['banyak_pesan'] = $data_update['banyak_pesan'];
		$session['list_menu'][$index_arr]['keterangan']   = $data_update['keterangan'];
		$session['list_menu'][$index_arr]['sub_total']    = $data_update['sub_total'];
		$session['total_harga']+=$data_update['sub_total'];

		session()->put('data_session',$session);
    }

    public function hapusListMenu(Request $request)
    {
		$session                = session()->get('data_session');

		$index_arr              = array_search($request->id_list,array_column($session['list_menu'],'id_list'));

		$session['total_harga']-=$session['list_menu'][$index_arr]['sub_total'];

    	unset($session['list_menu'][$index_arr]);

    	$session['list_menu'] = array_values($session['list_menu']);

    	session()->put('data_session',$session);
    }

    public function dataMenuCheckout(Request $request)
    {
		$menu             = $request->menu;
		$total_harga      = $request->total_harga;
		$total_bayar      = $request->total_bayar;
		$status_transaksi = $request->status_transaksi;
		$ket_bayar        = $request->ket_bayar;
		$keterangan       = $request->keterangan;
		
		$id_transaksi = (string)Str::uuid();
    	Transaksi::create([
			'id_transaksi'		=> $id_transaksi,
			'tanggal_transaksi' => date('Y-m-d'),
			'total_harga'		=> $total_harga,
			'total_bayar'		=> $total_bayar,
			'status_transaksi'	=> $status_transaksi,
			'ket_bayar'			=> $ket_bayar,
			'keterangan'		=> $keterangan,
			'id_users'          => Auth::id()
    	]);

		for ($i=0; $i < count($menu); $i++) { 
			$insert_data[] = [
				'id_transaksi_detail' => (string)Str::uuid(),
				'id_transaksi'        => $id_transaksi,
				'id_menu_makan'       => $menu[$i]['id_menu_makan'],
				'banyak_pesan'        => $menu[$i]['banyak_pesan'],
				'sub_total'           => $menu[$i]['sub_total'],
				'keterangan'          => $menu[$i]['keterangan'],
				'created_at'          => date('Y-m-d H:i:s'),
				'updated_at'          => date('Y-m-d H:i:s'),
			];
		}

		TransaksiDetail::insert($insert_data);

		session()->forget('data_session');

		$data_session = [
			'list_menu'    => [],
			'total_harga'  => 0,
			'time_expired' => '',
		];

		session()->put('data_session',$data_session);

		return response()->json(['message' => 'Berhasil Input Pesanan']);
    }

    public function dataPembayaran(Request $request) 
    {
		$page   = ($request->page - 1) * 5;
		// $limit 	= $request->page * 5;
		// $get_transaksi 	= Transaksi::where('tanggal_transaksi',now()->toDateString())
		// 						->offset($page)
		// 						->limit($limit);

		$get_transaksi 	= Transaksi::offset($page)
									->limit(5)
									->orderBy('created_at','desc');

		$count      = ceil(Transaksi::count()/5);
		
		$pembayaran = $get_transaksi->get();

    	return response()->json(['count' => $count, 'pembayaran' => $pembayaran]);
    }

    public function ajaxDataBarang($id)
    {
    	$barang = Barang::where('id_jenis_barang',$id)
    					->where('status_delete',0)
    					->get();

    	return $barang;
    }
}
