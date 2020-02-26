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
	
});

Route::group(['middleware' => 'is.petugas', 'prefix' => 'petugas'],function(){
	Route::get('/kasir',['uses' => 'Kasir\KasirController@index']);
});
