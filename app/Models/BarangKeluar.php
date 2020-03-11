<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\UuidInsert;

class BarangKeluar extends Model
{
	use UuidInsert;

	protected $table      = 'barang_keluar';
	protected $primaryKey = 'id_barang_keluar';
	protected $guarded    = [];
}
