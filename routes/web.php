<?php
use Illuminate\Support\Str;
use App\Models\User;

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

Route::get('/',['uses' => 'AuthController@index']);
Route::post('/login',['uses' => 'AuthController@login']);
Route::get('/logout',['uses' => 'AuthController@logout']);

Route::get('/insert-admin',function(){
	User::insert([[
		'id_users'	  => (string)Str::uuid(),
		'name'        => 'Administrator',
		'username'    => 'admin',
		'password'    => bcrypt('admin'),
		'level_user'  => 1,
		'status_akun' => 1
	],[
		'id_users'	  => (string)Str::uuid(),
		'name'        => 'Petugas',
		'username'    => 'petugas',
		'password'    => bcrypt('petugas'),
		'level_user'  => 0,
		'status_akun' => 1,
	]]);
});

Route::group(['prefix'=>'admin'],function(){
	Route::get('/dashboard',['uses' => 'Admin\DashboardController@index']);
});

Route::group(['prefix'=>'petugas'],function(){
	Route::get('/kasir',['uses' => 'Kasir\KasirController@index']);
});
