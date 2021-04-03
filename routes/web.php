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
Route::get('/hash',function(){
	dd(bcrypt('gudang'));
});

Route::group(['middleware' => 'has.auth'],function(){
	Route::get('/',['uses' => 'AuthController@index']);
	Route::post('/login',['uses' => 'AuthController@login']);
});
Route::get('/logout',['uses' => 'AuthController@logout']);

Route::group(['prefix' => 'datatables'],function(){
	Route::get('/item-jual',['uses' => 'DataTablesController@dataItemJual']);
	Route::get('/data-jenis-item',['uses' => 'DataTablesController@dataJenisItem']);
	Route::get('/data-barang',['uses' => 'DataTablesController@dataBarang']);
	Route::get('/data-jenis-barang',['uses' => 'DataTablesController@dataJenisBarang']);
	Route::get('/data-supplier',['uses' => 'DataTablesController@dataSupplier']);
	Route::get('/data-barang-masuk',['uses' => 'DataTablesController@dataBarangMasuk']);
	Route::get('/data-barang-masuk/detail/{id}',['uses' => 'DataTablesController@dataBarangMasukDetail']);
	Route::get('/data-barang-keluar',['uses' => 'DataTablesController@dataBarangKeluar']);
	Route::get('/data-barang-keluar/detail/{id}',['uses' => 'DataTablesController@dataBarangKeluarDetail']);
	Route::get('/data-transaksi',['uses' => 'DataTablesController@dataTransaksi']);
	Route::get('/data-transaksi/detail/{id}',['uses' => 'DataTablesController@dataTransaksiDetail']);
	Route::get('/data-tagihan',['uses' => 'DataTablesController@dataTagihan']);
	Route::get('/data-tagihan/detail/{id}',['uses' => 'DataTablesController@dataTagihanDetail']);
	Route::get('/data-users',['uses' => 'DataTablesController@dataUsers']);
});

Route::group(['middleware' => 'is.admin', 'prefix' => 'admin'],function(){
	Route::get('/dashboard',['uses' => 'Admin\DashboardController@index']);

	// ROUTE DATA ITEM JUAL //
	Route::get('/data-item-jual',['uses' => 'Admin\ItemJualController@index']);
	Route::get('/data-item-jual/tambah',['uses' => 'Admin\ItemJualController@tambah']);
	Route::post('/data-item-jual/save',['uses' => 'Admin\ItemJualController@save']);
	Route::get('/data-item-jual/edit/{id}',['uses' => 'Admin\ItemJualController@edit']);
	Route::put('/data-item-jual/update/{id}',['uses' => 'Admin\ItemJualController@update']);
	Route::delete('/data-item-jual/delete/{id}',['uses' => 'Admin\ItemJualController@delete']);
	// END ROUTE DATA ITEM JUAL //

	// ROUTE DATA JENIS ITEM //
	Route::get('/data-jenis-item',['uses' => 'Admin\JenisItemController@index']);
	Route::get('/data-jenis-item/tambah',['uses' => 'Admin\JenisItemController@tambah']);
	Route::post('/data-jenis-item/save',['uses' => 'Admin\JenisItemController@save']);
	Route::get('/data-jenis-item/edit/{id}',['uses' => 'Admin\JenisItemController@edit']);
	Route::put('/data-jenis-item/update/{id}',['uses' => 'Admin\JenisItemController@update']);
	Route::delete('/data-jenis-item/delete/{id}',['uses' => 'Admin\JenisItemController@delete']);
	// END ROUTE DATA JENIS ITEM //

	// ROUTE BARANG //
	Route::get('/data-jenis-barang',['uses' => 'Admin\JenisBarangController@index']);
	Route::get('/data-jenis-barang/tambah',['uses' => 'Admin\JenisBarangController@tambah']);
	Route::post('/data-jenis-barang/save',['uses' => 'Admin\JenisBarangController@save']);
	Route::get('/data-jenis-barang/edit/{id}',['uses' => 'Admin\JenisBarangController@edit']);
	Route::put('/data-jenis-barang/update/{id}',['uses' => 'Admin\JenisBarangController@update']);
	Route::delete('/data-jenis-barang/delete/{id}',['uses' => 'Admin\JenisBarangController@delete']);
	// END ROUTE BARANG //

	// ROUTE BARANG //
	Route::get('/data-barang',['uses' => 'Admin\BarangController@index']);
	Route::get('/data-barang/tambah',['uses' => 'Admin\BarangController@tambah']);
	Route::post('/data-barang/save',['uses' => 'Admin\BarangController@save']);
	Route::get('/data-barang/edit/{id}',['uses' => 'Admin\BarangController@edit']);
	Route::put('/data-barang/update/{id}',['uses' => 'Admin\BarangController@update']);
	Route::delete('/data-barang/delete/{id}',['uses' => 'Admin\BarangController@delete']);
	Route::get('/laporan-stok-barang',['uses' => 'Admin\LaporanInventoryController@laporanStokBarang']);
	Route::get('/laporan-mutasi-barang',['uses' => 'Admin\LaporanInventoryController@laporanMutasiBarang']);
	Route::get('/laporan-inventory/cetak-laporan-stok',['uses' => 'Admin\LaporanInventoryController@cetakLaporanStok']);
	Route::get('/laporan-inventory/cetak-laporan-mutasi',['uses' => 'Admin\LaporanInventoryController@cetakLaporanMutasi']);
	// END ROUTE BARANG //

	// ROUTE SUPPLIER //
	Route::get('/data-supplier',['uses' => 'Admin\SupplierController@index']);
	Route::get('/data-supplier/tambah',['uses' => 'Admin\SupplierController@tambah']);
	Route::post('/data-supplier/save',['uses' => 'Admin\SupplierController@save']);
	Route::get('/data-supplier/edit/{id}',['uses' => 'Admin\SupplierController@edit']);
	Route::put('/data-supplier/update/{id}',['uses' => 'Admin\SupplierController@update']);
	Route::delete('/data-supplier/delete/{id}',['uses' => 'Admin\SupplierController@delete']);
	// END ROUTE SUPPLIER //

	// ROUTE BARNAG MASUK //
	Route::get('/data-barang-masuk',['uses' => 'Admin\BarangMasukController@index']);
	Route::get('/data-barang-masuk/tambah',['uses' => 'Admin\BarangMasukController@tambah']);
	Route::post('/data-barang-masuk/save',['uses' => 'Admin\BarangMasukController@save']);
	Route::get('/data-barang-masuk/edit/{id}',['uses' => 'Admin\BarangMasukController@edit']);
	Route::put('/data-barang-masuk/update/{id}',['uses' => 'Admin\BarangMasukController@update']);
	Route::get('/data-barang-masuk/detail/{id}',['uses' => 'Admin\BarangMasukController@detail']);
	Route::delete('/data-barang-masuk/delete/{id}',['uses' => 'Admin\BarangMasukController@delete']);
	// END ROUTE BARANG MASUK //

	// ROUTE BARNAG MASUK //
	Route::get('/data-barang-keluar',['uses' => 'Admin\BarangKeluarController@index']);
	Route::get('/data-barang-keluar/tambah',['uses' => 'Admin\BarangKeluarController@tambah']);
	Route::post('/data-barang-keluar/save',['uses' => 'Admin\BarangKeluarController@save']);
	Route::get('/data-barang-keluar/edit/{id}',['uses' => 'Admin\BarangKeluarController@edit']);
	Route::put('/data-barang-keluar/update/{id}',['uses' => 'Admin\BarangKeluarController@update']);
	Route::get('/data-barang-keluar/detail/{id}',['uses' => 'Admin\BarangKeluarController@detail']);
	Route::delete('/data-barang-keluar/delete/{id}',['uses' => 'Admin\BarangKeluarController@delete']);
	// END ROUTE BARANG MASUK //
	
	// ROUTE TRANSAKSI //
	Route::get('/transaksi',['uses' => 'Admin\TransaksiController@index']);
	Route::delete('/transaksi/delete/{id}',['uses' => 'Admin\TransaksiController@delete']);
	Route::get('/transaksi/detail/{id}',['uses' => 'Admin\TransaksiDetailController@index']);
	Route::delete('/transaksi/detail/{id}/delete/{id_detail}',['uses' => 'Admin\TransaksiDetailController@delete']);
	Route::get('/transaksi/cetak-laporan',['uses' => 'Admin\TransaksiController@laporanTransaksi']);
	// END ROUTE TRANSAKSI //

	// ROUTE TAGIHAN //
	Route::get('/tagihan',['uses' => 'Admin\TagihanController@index']);
	Route::delete('/tagihan/delete/{id}',['uses' => 'Admin\TagihanController@delete']);
	Route::get('/tagihan/detail/{id}',['uses' => 'Admin\TagihanDetailController@index']);
	Route::delete('/tagihan/detail/{id}/delete/{id_detail}',['uses' => 'Admin\TransaksiDetailController@delete']);
	Route::get('/tagihan/cetak-laporan',['uses' => 'Admin\TagihanController@cetakLaporanTagihan']);
	// END ROUTE TAGIHAN //

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
	Route::any('/kasir/{any}',['uses' => 'Admin\KasirController@index'])->where('any','^(?!api\/)[\/\w\.-]*');
	// END ROUTE KASIR //

	Route::get('/settings-profile',['uses' => 'Admin\DashboardController@settingsProfile']);
	Route::get('/settings-profile/save',['uses' => 'Admin\DashboardController@save']);
});

Route::group(['middleware' => 'is.gudang','prefix' => 'gudang'],function(){
	Route::get('/dashboard',['uses' => 'Gudang\DashboardController@index']);

	// ROUTE BARANG //
	Route::get('/data-jenis-barang',['uses' => 'Gudang\JenisBarangController@index']);
	Route::get('/data-jenis-barang/tambah',['uses' => 'Gudang\JenisBarangController@tambah']);
	Route::post('/data-jenis-barang/save',['uses' => 'Gudang\JenisBarangController@save']);
	Route::get('/data-jenis-barang/edit/{id}',['uses' => 'Gudang\JenisBarangController@edit']);
	Route::put('/data-jenis-barang/update/{id}',['uses' => 'Gudang\JenisBarangController@update']);
	Route::delete('/data-jenis-barang/delete/{id}',['uses' => 'Gudang\JenisBarangController@delete']);
	// END ROUTE BARANG //

	// ROUTE BARANG //
	Route::get('/data-barang',['uses' => 'Gudang\BarangController@index']);
	Route::get('/data-barang/tambah',['uses' => 'Gudang\BarangController@tambah']);
	Route::post('/data-barang/save',['uses' => 'Gudang\BarangController@save']);
	Route::get('/data-barang/edit/{id}',['uses' => 'Gudang\BarangController@edit']);
	Route::put('/data-barang/update/{id}',['uses' => 'Gudang\BarangController@update']);
	Route::delete('/data-barang/delete/{id}',['uses' => 'Gudang\BarangController@delete']);
	Route::get('/laporan-stok-barang',['uses' => 'Gudang\LaporanInventoryController@laporanStokBarang']);
	Route::get('/laporan-mutasi-barang',['uses' => 'Gudang\LaporanInventoryController@laporanMutasiBarang']);
	Route::get('/laporan-inventory/cetak-laporan-stok',['uses' => 'Gudang\LaporanInventoryController@cetakLaporanStok']);
	Route::get('/laporan-inventory/cetak-laporan-mutasi',['uses' => 'Gudang\LaporanInventoryController@cetakLaporanMutasi']);
	// END ROUTE BARANG //

	// ROUTE SUPPLIER //
	Route::get('/data-supplier',['uses' => 'Gudang\SupplierController@index']);
	Route::get('/data-supplier/tambah',['uses' => 'Gudang\SupplierController@tambah']);
	Route::post('/data-supplier/save',['uses' => 'Gudang\SupplierController@save']);
	Route::get('/data-supplier/edit/{id}',['uses' => 'Gudang\SupplierController@edit']);
	Route::put('/data-supplier/update/{id}',['uses' => 'Gudang\SupplierController@update']);
	Route::delete('/data-supplier/delete/{id}',['uses' => 'Gudang\SupplierController@delete']);
	// END ROUTE SUPPLIER //

	// ROUTE BARNAG MASUK //
	Route::get('/data-barang-masuk',['uses' => 'Gudang\BarangMasukController@index']);
	Route::get('/data-barang-masuk/tambah',['uses' => 'Gudang\BarangMasukController@tambah']);
	Route::post('/data-barang-masuk/save',['uses' => 'Gudang\BarangMasukController@save']);
	Route::get('/data-barang-masuk/edit/{id}',['uses' => 'Gudang\BarangMasukController@edit']);
	Route::put('/data-barang-masuk/update/{id}',['uses' => 'Gudang\BarangMasukController@update']);
	Route::get('/data-barang-masuk/detail/{id}',['uses' => 'Gudang\BarangMasukController@detail']);
	Route::delete('/data-barang-masuk/delete/{id}',['uses' => 'Gudang\BarangMasukController@delete']);
	// END ROUTE BARANG MASUK //

	// ROUTE BARNAG MASUK //
	Route::get('/data-barang-keluar',['uses' => 'Gudang\BarangKeluarController@index']);
	Route::get('/data-barang-keluar/tambah',['uses' => 'Gudang\BarangKeluarController@tambah']);
	Route::post('/data-barang-keluar/save',['uses' => 'Gudang\BarangKeluarController@save']);
	Route::get('/data-barang-keluar/edit/{id}',['uses' => 'Gudang\BarangKeluarController@edit']);
	Route::put('/data-barang-keluar/update/{id}',['uses' => 'Gudang\BarangKeluarController@update']);
	Route::get('/data-barang-keluar/detail/{id}',['uses' => 'Gudang\BarangKeluarController@detail']);
	Route::delete('/data-barang-keluar/delete/{id}',['uses' => 'Gudang\BarangKeluarController@delete']);
	// END ROUTE BARANG MASUK //

	Route::get('/settings-profile',['uses' => 'Gudang\DashboardController@settingsProfile']);
	Route::get('/settings-profile/save',['uses' => 'Gudang\DashboardController@save']);
});

Route::group(['middleware' => 'is.kasir', 'prefix' => 'kasir'],function(){
	Route::get('/dashboard',['uses' => 'Kasir\DashboardController@index']);

	// ROUTE DATA ITEM JUAL //
	Route::get('/data-item-jual',['uses' => 'Kasir\ItemJualController@index']);
	Route::get('/data-item-jual/tambah',['uses' => 'Kasir\ItemJualController@tambah']);
	Route::post('/data-item-jual/save',['uses' => 'Kasir\ItemJualController@save']);
	Route::get('/data-item-jual/edit/{id}',['uses' => 'Kasir\ItemJualController@edit']);
	Route::put('/data-item-jual/update/{id}',['uses' => 'Kasir\ItemJualController@update']);
	Route::delete('/data-item-jual/delete/{id}',['uses' => 'Kasir\ItemJualController@delete']);
	// END ROUTE DATA ITEM JUAL //

	// ROUTE DATA JENIS ITEM //
	Route::get('/data-jenis-item',['uses' => 'Kasir\JenisItemController@index']);
	Route::get('/data-jenis-item/tambah',['uses' => 'Kasir\JenisItemController@tambah']);
	Route::post('/data-jenis-item/save',['uses' => 'Kasir\JenisItemController@save']);
	Route::get('/data-jenis-item/edit/{id}',['uses' => 'Kasir\JenisItemController@edit']);
	Route::put('/data-jenis-item/update/{id}',['uses' => 'Kasir\JenisItemController@update']);
	Route::delete('/data-jenis-item/delete/{id}',['uses' => 'Kasir\JenisItemController@delete']);
	// END ROUTE DATA JENIS ITEM //
	
	// ROUTE TRANSAKSI //
	Route::get('/transaksi',['uses' => 'Kasir\TransaksiController@index']);
	Route::get('/transaksi/detail/{id}',['uses' => 'Kasir\TransaksiDetailController@index']);
	Route::get('/transaksi/cetak-laporan',['uses' => 'Kasir\TransaksiController@laporanTransaksi']);
	// END ROUTE TRANSAKSI //

	// ROUTE TAGIHAN //
	Route::get('/tagihan',['uses' => 'Kasir\TagihanController@index']);
	Route::get('/tagihan/detail/{id}',['uses' => 'Kasir\TagihanDetailController@index']);
	Route::get('/tagihan/cetak-laporan',['uses' => 'Kasir\TagihanController@cetakLaporanTagihan']);
	// END ROUTE TAGIHAN //
	Route::get('/',['uses' => 'Kasir\KasirController@index']);
	Route::any('/{any}',['uses' => 'Kasir\KasirController@index'])->where('any','^(?!api\/)[\/\w\.-]*');

	Route::get('/settings-profile',['uses' => 'Kasir\DashboardController@settingsProfile']);
	Route::get('/settings-profile/save',['uses' => 'Kasir\DashboardController@save']);
});

Route::get('/load-jenis-item',['uses' => 'ApiController@loadJenisItem']);

Route::get('/data-item-jual',['uses' => 'ApiController@dataItemJual']);
Route::get('/data-item-jual/cari',['uses' => 'ApiController@dataItemJualCari']);
Route::post('/data-item-jual/checkout',['uses' => 'ApiController@dataItemJualCheckout']);
Route::get('/data-item-jual/list-tagihan',['uses' => 'ApiController@listTagihan']);
Route::get('/data-item-jual/list-tagihan/cari',['uses' => 'ApiController@cariTagihan']);
Route::get('/data-item-jual/list-tagihan/detail/{id}',['uses' => 'ApiController@tagihanDetail']);
Route::get('/data-item-jual/list-tagihan/detail/{id}/cari',['uses' => 'ApiController@cariTagihanDetail']);
Route::post('/data-item-jual/tagihan-proses',['uses' => 'ApiController@tagihanProses']);
Route::get('/data-item-jual/hapus-tagihan',['uses' => 'ApiController@hapusTagihan']);
Route::get('/data-item-jual/hapus-detail-tagihan',['uses' => 'ApiController@hapusDetailTagihan']);

Route::get('/list-item',['uses' => 'ApiController@listItem']);
Route::get('/tambah-list-menu',['uses' => 'ApiController@tambahListMenu']);
Route::get('/update-list-menu',['uses' => 'ApiController@updateListMenu']);
Route::get('/hapus-list-menu',['uses' => 'ApiController@hapusListMenu']);
Route::get('/destroy-list-menu',['uses' => 'ApiController@destroyListMenu']);
Route::get('/bayar-tagihan',['uses' => 'ApiController@bayarTagihan']);
Route::get('/bayar-semua-tagihan',['uses' => 'ApiController@bayarSemuaTagihan']);
Route::get('/data-pembayaran',['uses' => 'ApiController@dataPembayaran']);
Route::get('/ajax/data-barang/{id}',['uses' => 'ApiController@ajaxDataBarang']);
