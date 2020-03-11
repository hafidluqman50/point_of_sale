<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\UuidInsert;

class Barang extends Model
{
	use UuidInsert;

	protected $table      = 'barang';
	protected $primaryKey = 'id_barang';
	protected $guarded    = [];
	public $timestamps    = false;

	public static function getData()
	{
		$db = self::join('jenis_barang','barang.id_jenis_barang','=','jenis_barang.id_jenis_barang')
					->get();

		return $db;
	}
}
