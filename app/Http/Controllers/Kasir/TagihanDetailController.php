<?php

namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TagihanDetail;

class TagihanDetailController extends Controller
{
	public function index($id)
	{
		$title = 'Tagihan Detail';
		$page  = 'tagihan';

		return view('Kasir.tagihan.detail',compact('title','page'));
	}
}
