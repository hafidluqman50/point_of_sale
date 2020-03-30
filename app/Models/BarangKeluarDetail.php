<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BarangKeluarDetail extends Model
{
	// use UuidInsert;

	protected $table      = 'barang_keluar_detail';
	protected $primaryKey = 'id_barang_keluar_detail';
	protected $guarded    = [];

	public static function getData($id)
	{
		$db = self::join('barang','barang_keluar_detail.id_barang','=','barang.id_barang')
					->where('id_barang_keluar',$id)
					->get();

		return $db;
	}
}
