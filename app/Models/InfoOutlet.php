<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\UuidInsert;

class InfoOutlet extends Model
{
	use UuidInsert;

	protected $table      = 'info_outlet';
	protected $primaryKey = 'id_info_outlet';
	protected $guarded    = [];
	public $timestamps    = false;
}
