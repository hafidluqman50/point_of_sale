<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\UuidInsert;

class Transaksi extends Model
{
    // use UuidInsert;

	protected $table      = 'transaksi';
	protected $primaryKey = 'id_transaksi';
	protected $keyType    = 'string';
	protected $guarded    = [];
	public $incrementing  = false;

   	public static function getData()
   	{
   		$db = self::join('users','transaksi.id_users','=','users.id_users')
   					->get();

   		return $db;
   	}	
}
