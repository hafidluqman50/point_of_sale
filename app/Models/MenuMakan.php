<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuMakan extends Model
{
	protected $table      = 'menu_makan';
	protected $primaryKey = 'id_menu_makan';
	public $timestamps    = false;
	public $incrementing  = false;
	protected $keyType    = 'string';
	protected $guarded    = [];
}
