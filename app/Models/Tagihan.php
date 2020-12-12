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
}
