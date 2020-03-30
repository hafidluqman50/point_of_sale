<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\UuidInsert;

class TransaksiDetail extends Model
{
    // use UuidInsert;

	protected $table      = 'transaksi_detail';
	protected $primaryKey = 'id_transaksi_detail';
    protected $keyType    = 'string';
    protected $guarded    = [];
    public $incrementing  = false;

    public static function getData($id)
    {
    	$db = self::join('menu_makan','transaksi_detail.id_menu_makan','=','menu_makan.id_menu_makan')
    				->where('id_transaksi',$id)
    				->get();

    	return $db;
    }
}
