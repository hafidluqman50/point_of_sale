<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\UuidInsert;

class JenisBarang extends Model
{
	use UuidInsert;
	
	protected $table      = 'jenis_barang';
	protected $primaryKey = 'id_jenis_barang';
	protected $guarded    = [];
	public $timestamps    = false;
}
