<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use App\Models\Traits\UuidInsert;

class ItemJualDetail extends Model
{
	// use UuidInsert;

	protected $table      = 'item_jual_detail';
	protected $primaryKey = 'id_item_jual_detail';
	protected $keyType    = 'string';
	protected $guarded    = [];
	public $incrementing  = false;
	public $timestamps    = false;
}
