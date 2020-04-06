<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\UuidInsert;

class BarangMasukDetail extends Model
{
	protected $table      = 'barang_masuk_detail';
	protected $primaryKey = 'id_barang_masuk_detail';
	protected $keyType    = 'string';
	protected $guarded    = [];
	public $incrementing  = false;

	public static function getData($id)
	{
		$db = self::join('barang','barang_masuk_detail.id_barang','=','barang.id_barang')
					->join('jenis_barang','barang.id_jenis_barang','=','jenis_barang.id_jenis_barang')
					->where('id_barang_masuk',$id)
					->get();

		return $db;
	}
}
