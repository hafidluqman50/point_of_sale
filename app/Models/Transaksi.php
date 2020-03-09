<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
	protected $table      = 'transaksi';
	protected $primaryKey = 'id_transaksi';
    public $incrementing  = false;
    protected $keyType    = 'string';

   	public static function getData()
   	{
   		$db = self::join('users','transaksi.id_users','=','users.id_users')
   					->get();

   		return $db;
   	}	
}
