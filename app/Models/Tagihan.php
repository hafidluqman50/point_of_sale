<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tagihan extends Model
{
	protected $table      = 'tagihan';
	protected $primaryKey = 'id_tagihan';
	protected $keyType    = 'string';
	protected $guarded    = [];
	public $incrementing  = false;

	public static function getData()
	{
		$get = self::join('users','tagihan.id_users','=','users.id_users')
					->orderBy('created_at','desc')
					->get();

		return $get;
	}
}
