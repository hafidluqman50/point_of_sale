<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MenuMakan;

class ApiController extends Controller
{
    public function dataMenu()
    {
    	$menu_makan = MenuMakan::all();

    	return response()->json($menu_makan);
    }
}
