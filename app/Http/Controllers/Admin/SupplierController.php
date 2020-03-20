<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Supplier;

class SupplierController extends Controller
{
    public function index()
    {
		$title    = 'Supplier';
		$page     = 'supplier';
		$treeview = 'inventory';

		return view('Admin.supplier.main',compact('title','page','treeview'));
    }

    public function tambah()
    {
		$title    = 'Supplier Tambah';
		$page     = 'supplier';
		$treeview = 'inventory';

		return view('Admin.supplier.tambah',compact('title','page','treeview'));
    }

    public function save(Request $request)
    {
        $nama_supplier   = $request->nama_supplier;
        $nomor_telepon   = $request->nomor_telepon;
        $alamat_supplier = $request->alamat_supplier;

        $data_supplier = [
            'nama_supplier'          => $nama_supplier,
            'nomor_telepon_supplier' => $nomor_telepon,
            'alamat_supplier'        => $alamat_supplier
        ];

        Supplier::create($data_supplier);

        return redirect('/admin/data-supplier')->with('message','Berhasil Input Supplier');
    }

    public function edit($id)
    {
		$title    = 'Supplier Edit';
		$page     = 'supplier';
		$treeview = 'inventory';
		$row      = Supplier::where('id_supplier',$id)->firstOrFail();

		return view('Admin.supplier.edit',compact('title','page','treeview','row','id'));
    }

    public function update($id,Request $request)
    {
        $nama_supplier   = $request->nama_supplier;
        $nomor_telepon   = $request->nomor_telepon;
        $alamat_supplier = $request->alamat_supplier;

        $data_supplier = [
            'nama_supplier'          => $nama_supplier,
            'nomor_telepon_supplier' => $nomor_telepon,
            'alamat_supplier'        => $alamat_supplier
        ];

        Supplier::where('id_supplier',$id)->update($data_supplier);

        return redirect('/admin/data-supplier')->with('message','Berhasil Update Supplier');
    }

    public function delete($id)
    {
    	Supplier::where('id_supplier',$id)->update(['status_delete' => 1]);

    	return redirect('/admin/data-supplier')->with('message','Berhasil Hapus Supplier');
    }
}
