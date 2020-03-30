<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\UuidInsert;

class BarangMasuk extends Model
{
	// use UuidInsert;

	protected $table      = 'barang_masuk';
	protected $primaryKey = 'id_barang_masuk';
	protected $guarded    = [];

	public static function getData()
	{
		$db = self::join('users','barang_masuk.id_users','=','users.id_users')
					->join('supplier','barang_masuk.id_supplier','=','supplier.id_supplier')
					->get();

		return $db;
	}
}
