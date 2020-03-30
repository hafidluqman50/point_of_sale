<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\UuidInsert;

class BarangMasukDetail extends Model
{
	// use UuidInsert;

	protected $table      = 'barang_masuk_detail';
	protected $primaryKey = 'id_barang_masuk_detail';
	protected $guarded    = [];

	public static function getData($id)
	{
		$db = self::join('barang','barang_masuk_detail.id_barang','=','barang.id_barang')
					->where('id_barang_masuk',$id)
					->get();

		return $db;
	}
}
