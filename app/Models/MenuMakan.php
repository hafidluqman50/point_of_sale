<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\UuidInsert;

class MenuMakan extends Model
{
	use UuidInsert;

	protected $table      = 'menu_makan';
	protected $primaryKey = 'id_menu_makan';
	protected $guarded    = [];
	public $timestamps    = false;
}
