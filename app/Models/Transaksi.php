<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\UuidInsert;
use DB;

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
   					    ->orderBy('created_at','DESC')
                ->get();

   		return $db;
   	}

    public static function reportData($from,$to)
    {
        $get = self::join('users','transaksi.id_users','=','users.id_users')
                    ->whereBetween('tanggal_transaksi',[$from,$to])
                    ->orderBy('tanggal_transaksi','DESC')
                    ->get();

        return $get;
    }
}
