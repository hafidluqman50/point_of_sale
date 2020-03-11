<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\UuidInsert;

class BarangMasuk extends Model
{
	use UuidInsert;

	protected $table      = 'barang_masuk';
	protected $primaryKey = 'id_barang_masuk';
	protected $guarded    = [];
}
