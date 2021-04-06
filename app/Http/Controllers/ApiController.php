<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use App\Models\ItemJual;
use App\Models\ItemJualDetail;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use App\Models\Tagihan;
use App\Models\TagihanDetail;
use App\Models\Barang;
use App\Models\JenisItem;
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

    public function dataItemJual(Request $request)
    {
		$page        = ($request->page - 1) * 18;
		$jenis_menu  = $request->jenis_menu;

		if ($jenis_menu == '') {
			$item_jual   = ItemJual::where('status_delete',0)
									->offset($page)
									->limit(18)
									->orderBy('created_at','DESC')
									->get();
    								
			$count       = ceil(ItemJual::count()/18);
		}
		else {
			$item_jual   = ItemJual::join('jenis_item','item_jual.id_jenis_item','=','jenis_item.id_jenis_item')
    								->where('nama_jenis_slug',$jenis_menu)
									->where('item_jual.status_delete',0)
									->offset($page)
									->limit(18)
									->orderBy('created_at','DESC')
									->get();

			$get_count 	 = ItemJual::join('jenis_item','item_jual.id_jenis_item','=','jenis_item.id_jenis_item')
    								->where('nama_jenis_slug',$jenis_menu)
    								->count();

			$count       = ceil($get_count/18);
		}
		$data_item = [];

    	foreach ($item_jual as $key => $value) {
    		$item_detail_jual = ItemJualDetail::where('id_item_jual',$value->id_item_jual)->get();
    		$data_item[$key] = [
				'id_item_jual' => $value->id_item_jual,
				'nama_item'    => $value->nama_item,
				'harga_item'   => $value->harga_item,
				'foto_item'    => $value->foto_item,
				'status_item'  => $value->status_item,
				'varian'       => []
    		];
    		foreach ($item_detail_jual as $i => $j) {
    			array_push($data_item[$key]['varian'],['nama_varian' => $j->nama_varian,'harga_varian' => $j->harga_varian]);
    		}
    	}

    	return response()->json(['count' => $count, 'data_item' => $data_item]);
    }

    public function dataItemJualCari(Request $request)
    {
		$cari_item  = $request->cari_item;
		$jenis_menu = $request->jenis_menu;
		$page       = ($request->page - 1) * 18;

		if ($jenis_menu == '') {
	    	$item_jual = ItemJual::where('nama_item','like','%'.$cari_item.'%')
	    						  ->where('item_jual.status_delete',0)
	    						  ->offset($page)
	    						  ->limit(18)
				    			  ->get();

			$count       = ceil(ItemJual::where('nama_item','like','%'.$cari_item.'%')->count()/18);
		}
		else {
	    	$item_jual = ItemJual::join('jenis_item','item_jual.id_jenis_item','=','jenis_item.id_jenis_item')
    							  ->where('nama_jenis_slug',$jenis_menu)
	    						  ->where('nama_item','like','%'.$cari_item.'%')
	    						  ->where('item_jual.status_delete',0)
	    						  ->offset($page)
	    						  ->limit(18)
				    			  ->get();

			$get_count	 = ItemJual::join('jenis_item','item_jual.id_jenis_item','=','jenis_item.id_jenis_item')
    							  ->where('nama_jenis_slug',$jenis_menu)
    							  ->where('nama_item','like','%'.$cari_item.'%')
    							  ->count();

			$count       = ceil($get_count/18);
		}

		$data_cari = [];

    	foreach ($item_jual as $key => $value) {
    		$item_detail_jual = ItemJualDetail::where('id_item_jual',$value->id_item_jual)->get();
    		$data_cari[$key] = [
				'id_item_jual' => $value->id_item_jual,
				'nama_item'    => $value->nama_item,
				'harga_item'   => $value->harga_item,
				'foto_item'    => $value->foto_item,
				'status_item'  => $value->status_item,
				'varian'       => []
    		];
    		foreach ($item_detail_jual as $i => $j) {
    			array_push($data_cari[$key]['varian'],['nama_varian' => $j->nama_varian,'harga_varian' => $j->harga_varian]);
    		}
    	}

    	return response()->json(['count' => $count, 'data_item' => $data_cari]);
    }

   //  public function listItem()
   //  {
   //  	$get_item = [];
   //  	if (session()->has('data_session')) {
   //  		$data_session = session()->get('data_session');
			// if (count($data_session['list_item']) != count($get_item)) {
		 //    	for ($i=0; $i < count($data_session['list_item']); $i++) {
	  //   			$get_item[$i] = array_values($data_session['list_item'])[$i];
		 //    	}
			// }

	  //   	$list_item = [
			// 	'list_item'    => $get_item,
			// 	'total_harga'  => $data_session['total_harga'],
			// 	'time_expired' => $data_session['time_expired'],
	  //   	];

	  //   	session()->put('data_session',$list_item);
   //  	}
   //  	else {
   //  		$data_session = [
			// 	'list_item'    => [],
			// 	'total_harga'  => 0,
			// 	'time_expired' => '',
   //  		];

   //  		session()->put('data_session',$data_session);

   //  		$list_item = $data_session;
   //  	}

   //  	return $list_item;
   //  }

  //   public function tambahListMenu(Request $request)
  //   {
		// if (session()->has('data_session')) {
		// 	$session   = session()->get('data_session');
		// }
		// else {
		// 	$session = [
		// 		'list_item'    => [],
		// 		'total_harga'  => 0,
		// 		'time_expired' => '',
  //   		];

  //   		session()->put('data_session',$session);
		// }

		// $data_pesan = json_decode($request->data_pesan,TRUE);

  //   	array_push($session['list_item'],$data_pesan);

		// $session['time_expired'] = generate_time(60*60);
		// $session['total_harga']+=$data_pesan['sub_total'];

  //   	session()->put('data_session',$session);

  //   	return session()->get('data_session');
  //   }

  //   public function updateListMenu(Request $request)
  //   {
		// $session       = session()->get('data_session');
		// $data_update   = json_decode($request->data_update,TRUE);
		// $index_arr     = $data_update['indexMenu'];
		// $get_sub_total = $session['list_item'][$index_arr]['sub_total'];

		// $session['total_harga']-=$get_sub_total;

		// $session['list_item'][$index_arr]['banyak_pesan'] = $data_update['banyak_pesan'];
		// $session['list_item'][$index_arr]['keterangan']   = $data_update['keterangan'];
		// $session['list_item'][$index_arr]['sub_total']    = $data_update['sub_total'];
		// if (isset($session['list_item'][$index_arr]['varian_pilih'])) {
		// 	$session['list_item'][$index_arr]['varian_pilih'] = $data_update['varian_pilih'];
		// }
		// $session['total_harga']+=$data_update['sub_total'];

		// session()->put('data_session',$session);
  //   }

  //   public function hapusListMenu(Request $request)
  //   {
		// $session                = session()->get('data_session');

		// $index_arr              = array_search($request->id_list,array_column($session['list_item'],'id_list'));

		// $session['total_harga']-=$session['list_item'][$index_arr]['sub_total'];

  //   	unset($session['list_item'][$index_arr]);

  //   	$session['list_item'] = array_values($session['list_item']);

  //   	session()->put('data_session',$session);
  //   }

  //   public function destroyListMenu(Request $request)
  //   {
		// session()->forget('data_session');

		// $data_session = [
		// 	'list_item'    => [],
		// 	'total_harga'  => 0,
		// 	'time_expired' => '',
		// ];

		// session()->put('data_session',$data_session);

		// return response()->json(['message'=>'Berhasil Destroy Menu']);
  //   }

    public function loadJenisItem()
    {
    	$jenis_item = JenisItem::orderBy('nama_jenis','asc')->get();
    	$data_jenis_item[] = [];

    	foreach ($jenis_item as $key => $value) {
    		$data_jenis_item[$key] = [
				'id_jenis_item'   => $value->id_jenis_item,
				'nama_jenis'      => $value->nama_jenis,
				'nama_jenis_slug' => $value->nama_jenis_slug
    		];
    	}

    	return response()->json($data_jenis_item);
    }

    public function dataItemJualCheckout(Request $request)
    {
		$menu             = $request->menu;
		$total_harga      = $request->total_harga;
		$total_bayar      = $request->total_bayar;
		$kembalian		  = $request->kembalian;
		$status_transaksi = $request->status_transaksi;
		$ket_bayar        = $request->ket_bayar;
		$keterangan       = $request->keterangan;
		
		$id_transaksi = (string)Str::uuid();
    	Transaksi::create([
			'id_transaksi'		=> $id_transaksi,
			'tanggal_transaksi' => date('Y-m-d'),
			'total_harga'		=> $total_harga,
			'total_bayar'		=> $total_bayar,
			'kembalian'			=> $kembalian,
			'status_transaksi'	=> $status_transaksi,
			'ket_bayar'			=> $ket_bayar,
			'keterangan'		=> $keterangan,
			'id_users'          => Auth::id()
    	]);

		for ($i=0; $i < count($menu); $i++) {
			if (isset($menu[$i]['varian_pilih'])) {
				$varian = $menu[$i]['varian_pilih']['namaVarian'].' : '.$menu[$i]['varian_pilih']['hargaVarian'];
			 }
			 else {
			 	$varian = '';
			 }

			 if (isset($menu[$i]['id_tagihan_detail'])) {

			 	TagihanDetail::where('id_tagihan_detail',$menu[$i]['id_tagihan_detail'])
			 				->update(['status_tagihan_detail' => 'sudah-dibayar']);

				// Membandingkan jumlah tagihan yang sudah dibayar dengan keseluruhan jumlah data berdasarkan id_tagihan
			 	$count_awal = TagihanDetail::where('id_tagihan',$menu[$i]['id_tagihan'])
			 								->where('status_tagihan_detail','sudah-dibayar')
			 								->count();

			 	$count_akhir = TagihanDetail::where('id_tagihan',$menu[$i]['id_tagihan'])
			 								->count();

			 	if ($count_awal == $count_akhir) {
			 		Tagihan::where('id_tagihan',$menu[$i]['id_tagihan'])->update(['status_tagihan' => 'sudah-lunas']);
			 	}
			 }
			$insert_data[] = [
				'id_transaksi_detail' => (string)Str::uuid(),
				'id_transaksi'        => $id_transaksi,
				'id_item_jual'        => $menu[$i]['id_item_jual'],
				'banyak_pesan'        => $menu[$i]['banyak_pesan'],
				'sub_total'           => $menu[$i]['sub_total'],
				'keterangan'          => $menu[$i]['keterangan'],
				'varian'			  => $varian,
				'created_at'          => date('Y-m-d H:i:s'),
				'updated_at'          => date('Y-m-d H:i:s'),
			];
		}

		TransaksiDetail::insert($insert_data);

		if (Auth::user()->level_user == 2) {
			$url = '/admin/transaksi/struk/'.$id_transaksi;
		}
		else {
			$url = '/kasir/transaksi/struk/'.$id_transaksi;
		}

		return response()->json(['message' => 'Berhasil Input Pesanan','url_href' => $url]);
    }

    public function listTagihan(Request $request)
    {
		$page = ($request->page - 1) * 5;

		$tagihan = Tagihan::where('status_tagihan','belum-lunas')
							->offset($page)
							->limit(5)
							->orderBy('created_at','desc')
							->get();

		$count = ceil(Tagihan::where('status_tagihan','belum-lunas')->count()/5);

    	$list_tagihan = [];

    	foreach ($tagihan as $key => $value) {
    		$list_tagihan[$key] = [
				'id_tagihan'      => $value->id_tagihan,
				'nama_customer'   => $value->nama_customer,
				'total_tagihan'	  => $value->total_tagihan,
				'keterangan'	  => $value->keterangan
    		];
    	}

    	return response()->json(['count' => $count, 'list_tagihan' => $list_tagihan]);
    }

    public function cariTagihan(Request $request)
    {
		$cari_tagihan = $request->cari_tagihan;
		$page         = ($request->page - 1) * 5;

    	$tagihan = Tagihan::where('nama_customer','like','%'.$cari_tagihan.'%')
						  ->where('status_tagihan','belum-lunas')
						  ->offset($page)
						  ->limit(5)
		    			  ->get();

		$count = ceil(Tagihan::where('status_tagihan','belum-lunas')->count()/5);

    	$list_tagihan = [];

    	foreach ($tagihan as $key => $value) {
    		$list_tagihan[$key] = [
				'id_tagihan'      => $value->id_tagihan,
				'nama_customer'   => $value->nama_customer,
				'total_tagihan'	  => $value->total_tagihan,
				'keterangan'	  => $value->keterangan
    		];
    	}

    	return response()->json(['count' => $count, 'list_tagihan' => $list_tagihan]);	
    }

    public function tagihanDetail(Request $request,$id)
    {
		$page = ($request->page - 1) * 5;

		$tagihan_detail = TagihanDetail::getData($id,$page);

		$count = ceil(TagihanDetail::where('id_tagihan',$id)->count()/5);

		$data_detail = [];

    	foreach ($tagihan_detail as $key => $value) {
    		$data_detail[$key] = [
				'id_tagihan'        => $value->id_tagihan,
				'id_tagihan_detail' => $value->id_tagihan_detail,
				'tgl_tagihan'		=> $value->tgl_tagihan,
				'nama_item'         => $value->nama_item,
				'banyak_pesan'		=> $value->banyak_pesan,
				'sub_total'			=> $value->sub_total,
				'varian'			=> $value->varian,
				'keterangan'		=> $value->keterangan
    		];
    	}

    	return response()->json(['count' => $count, 'data_detail_tagihan' => $data_detail]);
    }

    public function cariTagihanDetail(Request $request,$id)
    {
		$page = ($request->page - 1) * 5;
		$cari = $request->cari;

		$tagihan_detail = TagihanDetail::cariData($id,$cari,$page);

		$count = ceil(TagihanDetail::where('id_tagihan',$id)->count()/5);

		$data_detail = [];

    	foreach ($tagihan_detail as $key => $value) {
    		$data_detail[$key] = [
				'id_tagihan'        => $value->id_tagihan,
				'id_tagihan_detail' => $value->id_tagihan_detail,
				'tgl_tagihan'		=> $value->tgl_tagihan,
				'nama_item'         => $value->nama_item,
				'banyak_pesan'		=> $value->banyak_pesan,
				'sub_total'			=> $value->sub_total,
				'varian'			=> $value->varian,
				'keterangan'		=> $value->keterangan
    		];
    	}

    	return response()->json(['count' => $count, 'data_detail_tagihan' => $data_detail]);
    }

    public function tagihanProses(Request $request)
    {
		$menu            = $request->menu;
		$total_tagihan   = $request->total_harga;
		$nama_customer   = $request->nama_customer;
		$keterangan      = $request->keterangan;
		
		if (Tagihan::where('nama_customer',$nama_customer)->where('keterangan',$keterangan)->count() > 0) {
			$id_tagihan = Tagihan::where('nama_customer',$nama_customer)->where('keterangan',$keterangan)->firstOrFail()->id_tagihan;
		}
		else {
			$id_tagihan    = (string)Str::uuid();
			Tagihan::create([
				'id_tagihan'     => $id_tagihan,
				'nama_customer'  => $nama_customer,
				'total_tagihan'  => $total_tagihan,
				'keterangan'     => $keterangan,
				'status_tagihan' => 'belum-lunas',
				'id_users'       => Auth::id()
			]);
		}

		for ($i=0; $i < count($menu); $i++) {
			if (isset($menu[$i]['varian_pilih'])) {
				$varian = $menu[$i]['varian_pilih']['namaVarian'].' : '.$menu[$i]['varian_pilih']['hargaVarian'];
			 }
			 else {
			 	$varian = '';
			 }
			$insert_data[] = [
				'id_tagihan_detail'     => (string)Str::uuid(),
				'id_tagihan'            => $id_tagihan,
				'tgl_tagihan'           => date('Y-m-d'),
				'id_item_jual'          => $menu[$i]['id_item_jual'],
				'banyak_pesan'          => $menu[$i]['banyak_pesan'],
				'sub_total'             => $menu[$i]['sub_total'],
				'keterangan'            => $menu[$i]['keterangan'],
				'varian'                => $varian,
				'status_tagihan_detail' => 'belum-dibayar',
				'created_at'            => date('Y-m-d H:i:s'),
				'updated_at'            => date('Y-m-d H:i:s'),
			];
		}

		TagihanDetail::insert($insert_data);

		// session()->forget('data_session');

		// $data_session = [
		// 	'list_item'    => [],
		// 	'total_harga'  => 0,
		// 	'time_expired' => '',
		// ];

		// session()->put('data_session',$data_session);

		return response()->json(['message' => 'Berhasil Input Tagihan']);
    }

    public function hapusTagihan(Request $request)
    {
    	Tagihan::where('id_tagihan',$request->id_tagihan)->delete();

    	return response()->json(['message' => 'Berhasil Hapus']);
    }

    public function hapusDetailTagihan(Request $request)
    {
    	TagihanDetail::where('id_tagihan',$request->id_tagihan)->where('id_tagihan_detail',$request->id_tagihan_detail)->delete();

    	return response()->json(['message' => 'Berhasil Hapus']);
    }

    public function bayarSemuaTagihan(Request $request)
    {

		$get_tagihan = TagihanDetail::getData($request->id_tagihan);

		$tagihan[] = [];

		$total_harga = 0;

		foreach ($get_tagihan as $key => $value) {
			if ($value->varian == " " || $value->varian == null) {
				$varian = null;
			}
			else {
				$explode     = explode(":",$value->varian);
				
				$namaVarian  = rtrim($explode[0],"");
				$hargaVarian = (int)ltrim($explode[1],"");

				$varian = ['namaVarian'=>$namaVarian,'hargaVarian'=>$hargaVarian];
			}

			$tagihan[$key] = [
				'id_tagihan'        => $value->id_tagihan,
				'id_tagihan_detail' => $value->id_tagihan_detail,
				'id_item_jual'		=> $value->id_item_jual,
				'tgl_tagihan'       => $value->tgl_tagihan,
				'nama_item'         => $value->nama_item,
				'banyak_pesan'      => $value->banyak_pesan,
				'sub_total'         => $value->sub_total,
				'varian_pilih'      => $varian,
				'keterangan'        => $value->keterangan
			];

			$total_harga += $value->sub_total;
		}

		return response()->json(['tagihan'=>$tagihan,'total_harga'=>$total_harga]);
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
