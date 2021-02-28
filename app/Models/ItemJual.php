<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use App\Models\Traits\UuidInsert;

class ItemJual extends Model
{
	// use UuidInsert;

	protected $table      = 'item_jual';
	protected $primaryKey = 'id_item_jual';
	protected $keyType    = 'string';
	protected $guarded    = [];
	public $incrementing  = false;
}
