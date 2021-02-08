<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TagihanDetail;

class TagihanDetailController extends Controller
{
	public function index($id)
	{
		$title = 'Tagihan Detail';
		$page  = 'tagihan';

		return view('Admin.tagihan.detail',compact('title','page'));
	}

	public function delete($id,$id_detail)
	{
		TagihanDetail::where('id_tagihan',$id)
						->where('id_tagihan_detail',$id_detail)
						->delete();

		return redirect('/admin/tagihan/detail/'.$id)->with('message','Berhasil Hapus Data');
	}
}
