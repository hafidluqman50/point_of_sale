<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\UuidInsert;

class JenisItem extends Model
{
	use UuidInsert;
	
	protected $table      = 'jenis_item';
	protected $primaryKey = 'id_jenis_item';
	protected $guarded    = [];
	public $timestamps    = false;
}
