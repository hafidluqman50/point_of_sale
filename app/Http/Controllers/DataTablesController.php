<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ItemJual;
use App\Models\JenisItem;
use App\Models\Barang;
use App\Models\JenisBarang;
use App\Models\Supplier;
use App\Models\BarangMasuk;
use App\Models\BarangMasukDetail;
use App\Models\BarangKeluar;
use App\Models\BarangKeluarDetail;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use App\Models\Tagihan;
use App\Models\TagihanDetail;
use App\Models\User;
use DataTables;
use Auth;

class DataTablesController extends Controller
{
    private $level;

    function __construct()
    {
        $this->middleware(function($request,$next){
            if (Auth::user()->level_user == 2) {
                $this->level = 'admin';
            }
            else if (Auth::user()->level_user == 1) {
                $this->level = 'gudang';
            }
            else if (Auth::user()->level_user == 0) {
                $this->level = 'kasir';
            }
            return $next($request);
        });
    }

    public function dataItemJual()
    {
        $item_jual  = ItemJual::join('jenis_item','item_jual.id_jenis_item','=','jenis_item.id_jenis_item')->where('item_jual.status_delete',0)->orderBy('created_at','DESC')->get();
        $datatables = DataTables::of($item_jual)->addColumn('action',function($action){
    		$column = '<a href="'.url("/$this->level/data-item-jual/edit/$action->id_item_jual").'">
    				        <button class="btn btn-warning"> Edit </button>
					   </a>
                       <a href="'.url("/$this->level/data-item-jual/detail/$action->id_item_jual").'">
                            <button class="btn btn-info"> Detail </button>
                       </a>
                       <form action="'.url("/$this->level/data-item-jual/delete/$action->id_item_jual").'" method="POST">
                            <input type="hidden" name="_token" value="'.csrf_token().'">
                            <input type="hidden" name="_method" value="DELETE">
                            <button class="btn btn-danger" onclick="return confirm(\'Delete ?\');"> Delete </button>
                       </form>
    				';
    		return $column;
    	})->editColumn('harga_item',function($edit){
    		return format_rupiah($edit->harga_item);
    	})->editColumn('foto_item',function($edit){
    		return '<img src="'.asset("assets/foto_item/$edit->foto_item").'" class="img-fluid">';
    	})->editColumn('status_item',function($edit){
    		if ($edit->status_item == 'tersedia') 
    		{
    			return '<span class="badge badge-success"> Tersedia </span>';
    		}
    		else
    		{
    			return '<span class="badge badge-danger"> Kosong </span';
    		}
    	})->rawColumns(['action','foto_item','status_item'])->make(true);

        return $datatables;
    }

    public function dataJenisItem()
    {
        $jenis_item = JenisItem::where('status_delete',0)->get();
        $datatables = DataTables::of($jenis_item)->addColumn('action',function($action){
            $column = '<a href="'.url("/$this->level/data-jenis-item/edit/$action->id_jenis_item").'">
                          <button class="btn btn-warning"> Edit </button>
                       </a>
                       <form action="'.url("/$this->level/data-jenis-item/delete/$action->id_jenis_item").'" method="POST">
                            <input type="hidden" name="_token" value="'.csrf_token().'">
                            <input type="hidden" name="_method" value="DELETE">
                            <button class="btn btn-danger" onclick="return confirm(\'Delete ?\');"> Delete </button>
                       </form>
                    ';
            return $column;
        })->make(true);

        return $datatables;
    }

    public function dataJenisBarang()
    {
        $jenis_barang = JenisBarang::where('status_delete',0)->get();
        $datatables = DataTables::of($jenis_barang)->addColumn('action',function($action){
            $column = '<a href="'.url("/$this->level/data-jenis-barang/edit/$action->id_jenis_barang").'">
                          <button class="btn btn-warning"> Edit </button>
                       </a>
                       <form action="'.url("/$this->level/data-jenis-barang/delete/$action->id_jenis_barang").'" method="POST">
                            <input type="hidden" name="_token" value="'.csrf_token().'">
                            <input type="hidden" name="_method" value="DELETE">
                            <button class="btn btn-danger" onclick="return confirm(\'Delete ?\');"> Delete </button>
                       </form>
                    ';
            return $column;
        })->make(true);

        return $datatables;
    }

    public function dataBarang()
    {
        $barang = Barang::getData();
        $datatables = DataTables::of($barang)->addColumn('action',function($action){
            $column = '<a href="'.url("/$this->level/data-barang/edit/$action->id_barang").'">
                          <button class="btn btn-warning"> Edit </button>
                       </a>
                       <form action="'.url("/$this->level/data-barang/delete/$action->id_barang").'" method="POST">
                            <input type="hidden" name="_token" value="'.csrf_token().'">
                            <input type="hidden" name="_method" value="DELETE">
                            <button class="btn btn-danger" onclick="return confirm(\'Delete ?\');"> Delete </button>
                       </form>
                    ';
            return $column;
        })->editColumn('stok_barang',function($edit){
            $stok = '';
            if ($edit->stok_barang == 0) {
                $stok = '<span class="badge badge-danger">0 '.$edit->satuan_stok.'</span>';
            }
            else {
                $stok = '<span class="badge badge-success">'.$edit->stok_barang.' '.$edit->satuan_stok.'</span>';
            }

            return $stok;
        })->rawColumns(['action','stok_barang'])->make(true);

        return $datatables;
    }

    public function dataSupplier()
    {
        $supplier = Supplier::where('status_delete',0)->get();
        $datatables = DataTables::of($supplier)->addColumn('action',function($action){
            $column = '<a href="'.url("/admin/data-supplier/edit/$action->id_supplier").'">
                          <button class="btn btn-warning"> Edit </button>
                       </a>
                       <form action="'.url("/admin/data-supplier/delete/$action->id_supplier").'" method="POST">
                            <input type="hidden" name="_token" value="'.csrf_token().'">
                            <input type="hidden" name="_method" value="DELETE">
                            <button class="btn btn-danger" onclick="return confirm(\'Delete ?\');"> Delete </button>
                       </form>
                    ';
            return $column;
        })->make(true);

        return $datatables;
    }

    public function dataBarangMasuk()
    {
        $barang_masuk = BarangMasuk::getData();
        $datatables = DataTables::of($barang_masuk)->addColumn('action',function($action){
            $column = '<a href="'.url("/$this->level/data-barang-masuk/detail/$action->id_barang_masuk").'">
                          <button class="btn btn-info"> Detail </button>
                       </a>
                       <a href="'.url("/$this->level/data-barang-masuk/edit/$action->id_barang_masuk").'">
                          <button class="btn btn-warning"> Edit </button>
                       </a>
                        <form action="'.url("/$this->level/data-barang-masuk/delete/$action->id_barang_masuk").'" method="POST">
                            <input type="hidden" name="_token" value="'.csrf_token().'">
                            <input type="hidden" name="_method" value="DELETE">
                            <button class="btn btn-danger" onclick="return confirm(\'Delete ?\');"> Delete </button>
                       </form>';
            return $column;
        })->editColumn('tanggal_masuk',function($edit){
            return human_date($edit->tanggal_masuk);
        })->make(true);

        return $datatables;
    }

    public function dataBarangMasukDetail($id)
    {
        $barang_masuk_detail = BarangMasukDetail::getData($id);
        $datatables = DataTables::of($barang_masuk_detail)->addColumn('action',function($action){
            $column = '<a href="'.url("/$this->level/data-barang-masuk/detail/$action->id_barang_masuk/delete/$action->id_barang_masuk_detail").'">
                          <button class="btn btn-danger"> Delete </button>
                       </a>';
            return $column;
        })->editColumn('jumlah_masuk',function($edit){
            return $edit->jumlah_masuk.' '.$edit->satuan_stok;
        })->editColumn('harga_satuan',function($edit){
            return format_rupiah($edit->harga_satuan);
        })->editColumn('harga_total',function($edit){
            return format_rupiah($edit->harga_total);
        })->make(true);

        return $datatables;
    }

    public function dataBarangKeluar()
    {
        $barang_keluar = BarangKeluar::getData();
        $datatables = DataTables::of($barang_keluar)->addColumn('action',function($action){
            $column = '<a href="'.url("/$this->level/data-barang-keluar/detail/$action->id_barang_keluar").'">
                          <button class="btn btn-info"> Detail </button>
                       </a>
                        <form action="'.url("/$this->level/data-barang-keluar/delete/$action->id_barang_keluar").'" method="POST">
                            <input type="hidden" name="_token" value="'.csrf_token().'">
                            <input type="hidden" name="_method" value="DELETE">
                            <button class="btn btn-danger" onclick="return confirm(\'Delete ?\');"> Delete </button>
                       </form>';
            return $column;
        })->editColumn('tanggal_keluar',function($edit){
            return human_date($edit->tanggal_keluar);
        })->make(true);

        return $datatables;
    }

    public function dataBarangKeluarDetail($id)
    {
        $barang_keluar_detail = BarangKeluarDetail::getData($id);
        $datatables = DataTables::of($barang_keluar_detail)->addColumn('action',function($action){
            $column = '<a href="'.url("/$this->level/data-barang-keluar/detail/$action->id_barang_keluar/delete/$action->id_barang_keluar_detail").'">
                          <button class="btn btn-danger"> Delete </button>
                       </a>';
            return $column;
        })->editColumn('jumlah_barang',function($edit){
            return $edit->jumlah_barang.' '.$edit->satuan_stok;
        })->make(true);

        return $datatables;
    }

    public function dataTransaksi()
    {
        $transaksi = Transaksi::getData();
        $datatables = DataTables::of($transaksi)->addColumn('action',function($action){
            $column = '<a href="'.url("/$this->level/transaksi/detail/$action->id_transaksi").'">
                          <button class="btn btn-info"> Detail </button>
                       </a>';
            if ($this->level == 'admin') {
                $column .='
                        <form action="'.url("/admin/transaksi/delete/$action->id_transaksi").'" method="POST">
                            <input type="hidden" name="_token" value="'.csrf_token().'">
                            <input type="hidden" name="_method" value="DELETE">
                            <button class="btn btn-danger" onclick="return confirm(\'Delete ?\');"> Delete </button>
                       </form>';
            }
            return $column;
        })->editColumn('tanggal_transaksi',function($edit){
            return human_date($edit->tanggal_transaksi);
        })->editColumn('total_harga',function($edit){
            return format_rupiah($edit->total_harga);
        })->editColumn('total_bayar',function($edit){
            return format_rupiah($edit->total_bayar);
        })->make(true);

        return $datatables;
    }

    public function dataTransaksiDetail($id)
    {
        $tagihan_detail = TransaksiDetail::getData($id);
        $datatables = DataTables::of($tagihan_detail)->addColumn('action',function($action){
            $column = '<form action="'.url("/admin/tagihan/detail/$action->id_tagihan/delete/$action->id_tagihan_detail").'" method="POST">
                            <input type="hidden" name="_token" value="'.csrf_token().'">
                            <input type="hidden" name="_method" value="DELETE">
                            <button class="btn btn-danger" onclick="return confirm(\'Delete ?\');"> Delete </button>
                       </form>';
            return $column;
        })->editColumn('banyak_pesan',function($edit){
            return $edit->banyak_pesan.'x';
        })->editColumn('sub_total',function($edit){
            return format_rupiah($edit->sub_total);
        })->make(true);

        return $datatables;
    }

    public function dataTagihan()
    {
        $tagihan = Tagihan::getData();
        $datatables = DataTables::of($tagihan)->addColumn('action',function($action){
            $column = '<a href="'.url("/$this->level/tagihan/detail/$action->id_tagihan").'">
                          <button class="btn btn-info"> Detail </button>
                       </a>';
            if ($this->level == 'admin') {
                $column .='
                        <form action="'.url("/admin/tagihan/delete/$action->id_tagihan").'" method="POST">
                            <input type="hidden" name="_token" value="'.csrf_token().'">
                            <input type="hidden" name="_method" value="DELETE">
                            <button class="btn btn-danger" onclick="return confirm(\'Delete ?\');"> Delete </button>
                       </form>';
            }
            return $column;
        })->editColumn('total_tagihan',function($edit){
            return format_rupiah($edit->total_tagihan);
        })->editColumn('status_tagihan',function($edit){
            $class = ['belum-lunas' => ['class' => 'badge-danger','text' => 'Belum Lunas'], 'sudah-lunas' => ['class' => 'btn-success', 'text' => 'Sudah Lunas']];

            return '<span class="badge '.$class[$edit->status_tagihan]['class'].'">'.$class[$edit->status_tagihan]['text'].'</span>';
        })->rawColumns(['action','status_tagihan'])->make(true);

        return $datatables;
    }

    public function dataTagihanDetail($id)
    {
        $tagihan_detail = TagihanDetail::getData($id);
        $datatables = DataTables::of($tagihan_detail)->addColumn('action',function($action){
            $column = '<form action="'.url("/admin/tagihan/detail/$action->id_tagihan/delete/$action->id_tagihan_detail").'" method="POST">
                            <input type="hidden" name="_token" value="'.csrf_token().'">
                            <input type="hidden" name="_method" value="DELETE">
                            <button class="btn btn-danger" onclick="return confirm(\'Delete ?\');"> Delete </button>
                       </form>';
            return $column;
        })->editColumn('banyak_pesan',function($edit){
            return $edit->banyak_pesan.'x';
        })->editColumn('sub_total',function($edit){
            return format_rupiah($edit->sub_total);
        })->editColumn('status_tagihan_detail',function($edit){
            $class = ['belum-dibayar' => ['class' => 'badge-danger','text' => 'Belum Lunas'], 'sudah-dibayar' => ['class' => 'btn-success', 'text' => 'Sudah Lunas']];

            return '<span class="badge '.$class[$edit->status_tagihan_detail]['class'].'">'.$class[$edit->status_tagihan_detail]['text'].'</span>';
        })->rawColumns(['action','status_tagihan_detail'])->make(true);

        return $datatables;
    }

    public function dataUsers()
    {
        $users = User::whereNotIn('level_user',[2])->where('status_delete',0)->get();
        $datatables = DataTables::of($users)->addColumn('action',function($action){
            $class = [0 => ['class' => 'btn-success','text' => 'Aktifkan'], 1 => ['class' => 'btn-danger', 'text' => 'Non Aktifkan']];

            $column = '<a href="'.url("/admin/users/status-akun/$action->id_users").'">
                          <button class="btn '.$class[$action->status_akun]['class'].'"> '.$class[$action->status_akun]['text'].' </button>
                       </a>
                       <form action="'.url("/admin/users/delete/$action->id_users").'" method="POST">
                            <input type="hidden" name="_token" value="'.csrf_token().'">
                            <input type="hidden" name="_method" value="DELETE">
                            <button class="btn btn-danger" onclick="return confirm(\'Delete ?\');"> Delete </button>
                       </form>';
            return $column;
        })->editColumn('status_akun',function($edit){
            $class = [0 => ['class' => 'badge-danger','text' => 'Non Aktif'], 1 => ['class' => 'badge-success', 'text' => 'Aktif']];
            return '<span class="badge '.$class[$edit->status_akun]['class'].'">'.$class[$edit->status_akun]['text'].'</span>';
        })->editColumn('level_user',function($edit){
            $level = [2 => 'Admin', 1 => 'Gudang', 0 => 'Kasir'];

            return $level[$edit->level_user];
        })->rawColumns(['status_akun','action'])->make(true);

        return $datatables;
    }
}
