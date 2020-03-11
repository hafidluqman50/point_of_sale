<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MenuMakan;
use App\Models\JenisBarang;
use App\Models\Barang;
use App\Models\Supplier;
use App\Models\BarangMasuk;
use App\Models\BarangKeluar;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use DataTables;

class DatatablesController extends Controller
{
    public function dataMenuMakan()
    {
    	$menu_makan = MenuMakan::all();
    	$datatables = DataTables::of($menu_makan)->addColumn('action',function($action){
    		$column = '<a href="'.url("/admin/menu-makan/edit/$action->id_menu_makan").'">
    					  <button class="btn btn-warning"> Edit </button>
					   </a>
                       <form action="'.url("/admin/menu-makan/delete/$action->id_menu_makan").'" method="POST">
                            <input type="hidden" name="_token" value="'.csrf_token().'">
                            <input type="hidden" name="_method" value="DELETE">
                            <button class="btn btn-danger" onclick="return confirm(\'Delete ?\');"> Delete </button>
                       </form>
    				';
    		return $column;
    	})->editColumn('harga_menu',function($edit){
    		return format_rupiah($edit->harga_menu);
    	})->editColumn('foto_menu',function($edit){
    		return '<img src="'.asset("assets/foto_menu/$edit->foto_menu").'" class="img-fluid">';
    	})->editColumn('status_menu',function($edit){
    		if ($edit->status_menu == 'tersedia') 
    		{
    			return '<span class="badge badge-success"> Tersedia </span>';
    		}
    		else
    		{
    			return '<span class="badge badge-danger"> Kosong </span';
    		}
    	})->rawColumns(['action','foto_menu','status_menu'])->make(true);

        return $datatables;
    }

    public function dataJenisBarang()
    {
        $jenis_barang = JenisBarang::where('status_delete',0)->get();
        $datatables = DataTables::of($jenis_barang)->addColumn('action',function($action){
            $column = '<a href="'.url("/admin/data-jenis-barang/edit/$action->id_jenis_barang").'">
                          <button class="btn btn-warning"> Edit </button>
                       </a>
                       <form action="'.url("/admin/data-jenis-barang/delete/$action->id_jenis_barang").'" method="POST">
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
            $column = '<a href="'.url("/admin/data-barang/edit/$action->id_barang").'">
                          <button class="btn btn-warning"> Edit </button>
                       </a>
                       <form action="'.url("/admin/data-jenis-barang/delete/$action->id_barang").'" method="POST">
                            <input type="hidden" name="_token" value="'.csrf_token().'">
                            <input type="hidden" name="_method" value="DELETE">
                            <button class="btn btn-danger" onclick="return confirm(\'Delete ?\');"> Delete </button>
                       </form>
                    ';
            return $column;
        })->editColumn('stok_barang',function($edit){
            $stok = '';
            if ($edit->stok_barang == 0) {
                $stok = '<span class="badges badges-danger">0</span>';
            }
            else {
                $stok = '<span class="badges badges-success">'.$edit->stok_barang.'</span>';
            }

            return $stok;
        })->rawColumns(['action','stok_barang'])->make(true);

        return $datatables;
    }

    public function dataSupplier()
    {

    }

    public function dataBarangMasuk()
    {

    }

    public function dataBarangKeluar()
    {

    }

    public function dataTransaksi()
    {
        $transaksi = Transaksi::getData();
        $datatables = DataTables::of($transaksi)->addColumn('action',function($action){
            $column = '<a href="'.url("/admin/menu-makan/edit/$action->id_menu_makan").'">
                          <button class="btn btn-warning"> Edit </button>
                       </a>
                       <a href="'.url("/admin/menu-makan/delete/$action->id_menu_makan").'">
                           <button class="btn btn-danger" onclick="return confirm(\'Yakin Hapus ?\');"> Hapus </button>
                       </a>
                    ';
            return $column;
        })->make(true);

        return $datatables;
    }
}
