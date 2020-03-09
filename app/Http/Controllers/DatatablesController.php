<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MenuMakan;
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
					   <a href="'.url("/admin/menu-makan/delete/$action->id_menu_makan").'">
					   	   <button class="btn btn-danger" onclick="return confirm(\'Yakin Hapus ?\');"> Hapus </button>
					   </a>
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
