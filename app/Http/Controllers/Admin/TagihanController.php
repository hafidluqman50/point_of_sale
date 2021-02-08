<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tagihan;

class TagihanController extends Controller
{
    public function index()
    {
		$title = 'Tagihan';
		$page  = 'tagihan';

    	return view('Admin.tagihan.main',compact('title','page'));
    }

    public function delete($id)
    {
    	Tagihan::where('id_tagihan',$id)->delete();

    	return redirect('/admin/tagihan')->with('message','Berhasil Hapus Tagihan');
    }
}
