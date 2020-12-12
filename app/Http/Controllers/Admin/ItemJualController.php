<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\ItemJual;
use App\Models\ItemJualDetail;

class ItemJualController extends Controller
{
	public function index()
	{
		$title = 'Item Jual';
		$page  = 'item-jual';

		return view('Admin.item-jual.main',compact('title','page'));
	}

	public function tambah()
	{
		$title = 'Item Jual Tambah';
		$page  = 'item-jual';

		return view('Admin.item-jual.tambah',compact('title','page'));
	}

	public function save(Request $request)
	{
		$nama_item    = $request->nama_item;
		$harga_item   = $request->harga_item;
		$foto_item    = $request->foto_item;
		$fileName     = $foto_item != '' ? uniqid().'_foto_item_'.$foto_item->getClientOriginalName() : '-';
		$status_item  = $request->status_item;
		$nama_varian  = $request->nama_varian;
		$harga_varian = $request->harga_varian;

		$data_item = [
			'nama_item'     => $nama_item,
			'harga_item'    => $harga_item,
			'foto_item'     => $fileName,
			'status_item'   => $status_item
		];

		if ($foto_item != '') {
			Image::make($foto_item)->resize(250,250)->save('assets/foto_item/'.$fileName);
		}

		ItemJual::create($data_item);

		if (count($nama_varian) != 0) {
			// $data_item['id_item_jual'] = (string)Str::uuid();
			// $data_item['created_at']   = date('Y-m-d H:i:s');
			// $data_item['updated_at']   = date('Y-m-d H:i:s');
			unset($data_item['foto_item']);

			$id_item_jual       = ItemJual::firstOrCreate($data_item)->id_item_jual;
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

		return redirect('/admin/item-jual')->with('messages','Berhasil Input Menu');
	}

	public function edit($id)
	{
		$title = 'Item Jual Edit';
		$page  = 'item-jual';
		$row   = ItemJual::where('id_item_makan',$id)->firstOrFail();

		return view('Admin.item-jual.edit',compact('title','page','row','id'));
	}

	public function update($id,Request $request)
	{
		$nama_item    = $request->nama_item;
		$harga_item   = $request->harga_item;
		$foto_item    = $request->foto_item;
		$fileName     = $foto_item != '' ? uniqid().'_foto_item_'.$foto_item->getClientOriginalName() : '';
		$status_item  = $request->status_item;
		$menu_makan   = ItemJual::where('id_item_makan',$id)->firstOrFail();
		
		$nama_varian  = $request->nama_varian;
		$harga_varian = $request->harga_varian;

		$data_item = [
			'nama_item'     => $nama_item,
			'harga_item'    => $harga_item,
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

		return redirect('/admin/item-jual')->with('message','Berhasil Edit Item Jual');
	}

	public function delete($id)
	{
		$foto_item = ItemJual::where('id_item_jual',$id)->firstOrFail()->foto_item;	

		remove_file('assets/foto_item/',$foto_item);

		ItemJual::where('id_item_jual',$id)->update(['status_delete' => 1]);

		return redirect('/admin/item-jual')->with('message','Berhasil Hapus Item Jual');
	}
}
