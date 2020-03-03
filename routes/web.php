<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => 'has.auth'],function(){
	Route::get('/',['uses' => 'AuthController@index']);
	Route::post('/login',['uses' => 'AuthController@login']);
});
Route::get('/logout',['uses' => 'AuthController@logout']);

Route::group(['prefix' => 'datatables'],function(){
	Route::get('/menu-makan',['uses' => 'DatatablesController@dataMenuMakan']);
});

Route::group(['middleware' => 'is.admin', 'prefix' => 'admin'],function(){
	Route::get('/dashboard',['uses' => 'Admin\DashboardController@index']);

	// ROUTE MENU MAKAN //
	Route::get('/menu-makan',['uses' => 'Admin\MenuMakanController@index']);
	Route::get('/menu-makan/tambah',['uses' => 'Admin\MenuMakanController@tambah']);
	Route::post('/menu-makan/save',['uses' => 'Admin\MenuMakanController@save']);
	Route::get('/menu-makan/edit/{id}',['uses' => 'Admin\MenuMakanController@edit']);
	Route::put('/menu-makan/update/{id}',['uses' => 'Admin\MenuMakanController@update']);
	Route::delete('/menu-makan/delete/{id}',['uses' => 'Admin\MenuMakanController@delete']);
	// END ROUTE MENU MAKAN //
	
	// ROUTE TRANSAKSI //
	Route::get('/transaksi',['uses' => 'Admin\TransaksiController@index']);
	Route::delete('/transaksi/delete/{id}',['uses' => 'Admin\TransaksiController@delete']);
	Route::get('/transaksi/detail/{id}',['uses' => 'Admin\TransaksiDetailController@index']);
	Route::delete('/transaksi/detail/{id}/delete/{id_detail}',['uses' => 'Admin\TransaksiDetailController@delete']);
	Route::get('/transaksi/laporan-export',['uses' => 'Admin\TransaksiController@laporan']);
	// END ROUTE TRANSAKSI //

	// ROUTE USERS //
	Route::get('/users',['uses' => 'Admin\UsersController@index']);
	Route::get('/users/tambah',['uses' => 'Admin\UsersController@tambah']);
	Route::post('/users/save',['uses' => 'Admin\UsersController@save']);
	Route::get('/users/edit/{id}',['uses' => 'Admin\UsersController@edit']);
	Route::put('/users/update/{id}',['uses' => 'Admin\UsersController@update']);
	Route::delete('/users/delete/{id}',['uses' => 'Admin\UsersController@delete']);
	// END ROUTE USERS //

	// ROUTE KASIR //
	Route::get('/kasir',['uses' => 'Admin\KasirController@index']);
	// END ROUTE KASIR //
});

Route::group(['middleware' => 'is.petugas', 'prefix' => 'petugas'],function(){
	Route::get('/kasir',['uses' => 'Kasir\KasirController@index']);
});
