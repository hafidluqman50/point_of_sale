<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TagihanDetail extends Model
{
	protected $table      = 'tagihan_detail';
	protected $primaryKey = 'id_tagihan_detail';
    protected $keyType    = 'string';
    protected $guarded    = [];
    public $incrementing  = false;
}
