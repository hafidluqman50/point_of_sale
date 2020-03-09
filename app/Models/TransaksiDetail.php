<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransaksiDetail extends Model
{
	protected $table      = 'transaksi';
	protected $primaryKey = 'id_transaksi';
    public $incrementing  = false;
    protected $keyType    = 'string';

    public function getData($id)
    {
    	$db = self::join('menu_makan','transaksi_detail.id_menu_makan','=','menu_makan.id_menu_makan')
    				->where('id_transaksi',$id)
    				->get();

    	return $db;
    }
}
