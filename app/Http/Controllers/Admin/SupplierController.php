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
}
