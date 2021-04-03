<?php

namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\ItemJual;
use App\Models\ItemJualDetail;
use App\Models\JenisItem;

class ItemJualController extends Controller
{
	public function index()
	{
		$title    = 'Item Jual';
		$page     = 'data-item-jual';
		$treeview = 'item-jual';

		return view('Kasir.item-jual.main',compact('title','page','treeview'));
	}

	public function tambah()
	{
		$title      = 'Item Jual Tambah';
		$page       = 'data-item-jual';
		$treeview   = 'item-jual';
		$jenis_item = JenisItem::where('status_delete',0)->get();

		return view('Kasir.item-jual.tambah',compact('title','page','treeview','jenis_item'));
	}

	public function save(Request $request)
	{
		$id_item_jual = (string)Str::uuid();
		$nama_item    = $request->nama_item;
		$harga_item   = $request->harga_item;
		$foto_item    = $request->foto_item;
		$jenis_item	  = $request->jenis_item;
		$fileName     = $foto_item != '' ? uniqid().'_foto_item_'.$foto_item->getClientOriginalName() : '-';
		$status_item  = $request->status_item;
		$nama_varian  = $request->nama_varian;
		$harga_varian = $request->harga_varian;

		$data_item = [
			'id_item_jual'	=> $id_item_jual,
			'nama_item'     => $nama_item,
			'harga_item'    => $harga_item,
			'id_jenis_item' => $jenis_item,
			'foto_item'     => $fileName,
			'status_item'   => $status_item
		];

		if ($foto_item != '') {
			Image::make($foto_item)->resize(250,250)->save('assets/foto_item/'.$fileName);
		}

		if ($nama_varian != null) {
			// $data_item['id_item_jual'] = (string)Str::uuid();
			// $data_item['created_at']   = date('Y-m-d H:i:s');
			// $data_item['updated_at']   = date('Y-m-d H:i:s');
			unset($data_item['foto_item']);

			$item_jual_detail[] = [];

			for ($i=0; $i < count($nama_varian); $i++) {
				$item_jual_detail[$i] = [
					'id_item_jual_detail' => (string)Str::uuid(),
					'id_item_jual'        => $id_item_jual,
					'nama_varian'         => $nama_varian[$i],
					'harga_varian'        => $harga_varian[$i]
				];
			}

			ItemJualDetail::insert($item_jual_detail);
		}
		else {
			ItemJual::create($data_item);
		}

		return redirect('/kasir/data-item-jual')->with('message','Berhasil Input Menu');
	}

	public function edit($id)
	{
		$title      = 'Item Jual Edit';
		$page       = 'data-item-jual';
		$treeview   = 'item-jual';
		$row        = ItemJual::where('id_item_jual',$id)->firstOrFail();
		$jenis_item = JenisItem::where('status_delete',0)->get();

		return view('Kasir.item-jual.edit',compact('title','page','treeview','row','id','jenis_item'));
	}

	public function update($id,Request $request)
	{
		$nama_item    = $request->nama_item;
		$harga_item   = $request->harga_item;
		$foto_item    = $request->foto_item;
		$jenis_item	  = $request->jenis_item;
		$fileName     = $foto_item != '' ? uniqid().'_foto_item_'.$foto_item->getClientOriginalName() : '';
		$status_item  = $request->status_item;
		$menu_makan   = ItemJual::where('id_item_jual',$id)->firstOrFail();
		
		$nama_varian  = $request->nama_varian;
		$harga_varian = $request->harga_varian;

		$data_item = [
			'nama_item'     => $nama_item,
			'harga_item'    => $harga_item,
			'id_jenis_item' => $jenis_item,
			'foto_item'     => $fileName,
			'status_item'   => $status_item
		];

		if ($fileName == '') {
			unset($data_item['foto_item']);
		}
		else {
			remove_file('assets/foto_item/',$menu_makan->foto_item);
			Image::make($foto_item)->resize(250,250)->save('assets/foto_item/'.$fileName);
		}

		ItemJual::where('id_item_jual',$id)->update($data_item);

		return redirect('/kasir/data-item-jual')->with('message','Berhasil Edit Item Jual');
	}

	public function delete($id)
	{
		$foto_item = ItemJual::where('id_item_jual',$id)->firstOrFail()->foto_item;	

		remove_file('assets/foto_item/',$foto_item);

		ItemJual::where('id_item_jual',$id)->update(['status_delete' => 1]);

		return redirect('/kasir/data-item-jual')->with('message','Berhasil Hapus Item Jual');
	}
}
