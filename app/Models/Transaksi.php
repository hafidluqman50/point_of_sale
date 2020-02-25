<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
	protected $table      = 'transaksi';
	protected $primaryKey = 'id_transaksi';
    public $incrementing  = false;
    protected $keyType    = 'string';	
}
