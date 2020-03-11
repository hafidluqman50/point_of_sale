<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\UuidInsert;

class Supplier extends Model
{
	use UuidInsert;

	protected $table      = 'supplier';
	protected $primaryKey = 'id_supplier';
	protected $guarded    = [];
	public $timestamps    = false;
}
