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

Route::get('/', function () {
    return redirect(route('login'));
});

Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/login', 'Auth\LoginController@login');
Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

Route::group(['middleware' => ['web','auth','change_password']], function(){
	Route::get('/beranda', 'BerandaController@index')->name('beranda');
	Route::get('/beranda/{id?}/edit_profile', 'BerandaController@edit_profile')->name('beranda.edit_profile');
	Route::put('/beranda/{id?}/update_profile', 'BerandaController@update_profile')->name('beranda.update_profile');

	// MODUL MASTER PTPN
	Route::get('ptpn/data', 'PtpnController@listData')->name('ptpn.data');
    Route::resource('ptpn', 'PtpnController')->names([
		'index' => 'ptpn.index',
		'create' => 'ptpn.create',
		'update' => 'ptpn.update'
	]);

	// MODUL MASTER SATUAN
	Route::get('satuan/data', 'SatuanController@listData')->name('satuan.data');
    Route::resource('satuan', 'SatuanController')->names([
		'index' => 'satuan.index',
		'create' => 'satuan.create',
		'update' => 'satuan.update'
	]);

    // MODUL MASTER DIVISI
	Route::get('divisi/data', 'DivisiController@listData')->name('divisi.data');
    Route::resource('divisi', 'DivisiController')->names([
		'index' => 'divisi.index',
		'create' => 'divisi.create',
		'update' => 'divisi.update'
	]);

	// MODUL MASTER JABATAN
	Route::get('jabatan/data', 'JabatanController@listData')->name('jabatan.data');
    Route::resource('jabatan', 'JabatanController')->names([
		'index' => 'jabatan.index',
		'create' => 'jabatan.create',
		'update' => 'jabatan.update'
	]);

	// MODUL MASTER KPI
	Route::get('kpi/data', 'KpiController@listData')->name('kpi.data');
    Route::resource('kpi', 'KpiController')->names([
		'index' => 'kpi.index',
		'create' => 'kpi.create',
		'update' => 'kpi.update'
	]);
	
	// MODUL MASTER PENILAIAN KARYA
	Route::get('penilaian_karya/data', 'PenilaianKaryaController@listData')->name('penilaian_karya.data');
    Route::resource('penilaian_karya', 'PenilaianKaryaController')->names([
		'index' => 'penilaian_karya.index',
		'create' => 'penilaian_karya.create',
		'update' => 'penilaian_karya.update'
	]);

	// MODUL MASTER KARYAWAN
	Route::get('/download_template', 'KaryawanController@download_template')->name('download_template');
	Route::post('karyawan/mass_store', 'KaryawanController@mass_store')->name('karyawan.mass_store');
	Route::post('karyawan/mass_delete','KaryawanController@mass_delete')->name('karyawan.mass_delete');
	Route::get('karyawan/data', 'KaryawanController@listData')->name('karyawan.data');
    Route::resource('karyawan', 'KaryawanController')->names([
		'index' => 'karyawan.index',
		'create' => 'karyawan.create',
		'update' => 'karyawan.update'
	]);

	// MODUL MASTER PERMISSIONS
	Route::get('permissions/data', 'PermissionsController@listData')->name('permissions.data');
    Route::resource('permissions', 'PermissionsController')->names([
		'index' => 'permissions.index',
		'create' => 'permissions.create',
		'update' => 'permissions.update'
	]);

	// MODUL MASTER ROLE
	Route::get('role/data', 'RoleController@listData')->name('role.data');
    Route::resource('role', 'RoleController')->names([
		'index' => 'role.index',
		'create' => 'role.create',
		'update' => 'role.update'
	]);

	// MODUL MASTER PENGGUNA
	Route::post('pengguna/dataBagian', 'PenggunaController@getBagian');
	Route::delete('pengguna/hapus_pengguna/{id?}','PenggunaController@hapus_pengguna')->name('pengguna.hapus');
	Route::post('/pengguna/{id?}/reset', 'PenggunaController@reset');
	Route::get('pengguna/data', 'PenggunaController@listData')->name('pengguna.data');
    Route::resource('pengguna', 'PenggunaController')->names([
		'index' => 'pengguna.index',
		'create' => 'pengguna.create',
		'update' => 'pengguna.update'
	]);

	// MODUL MASTER KATEGORI
	Route::get('kategori/data', 'KategoriController@listData')->name('kategori.data');
    Route::resource('kategori', 'KategoriController')->names([
		'index' => 'kategori.index',
		'create' => 'kategori.create',
		'update' => 'kategori.update'
	]);

	// MODUL MASTER INDIKATOR
	Route::post('indikator/{id?}/store_indikator','IndikatorController@store_indikator')->name('indikator.store_indikator');
	Route::post('indikator/dataDivisi', 'IndikatorController@getDivisi');
	Route::get('indikator/data', 'IndikatorController@listData')->name('indikator.data');
    Route::resource('indikator', 'IndikatorController')->names([
		'index' => 'indikator.index',
		'create' => 'indikator.create',
		'update' => 'indikator.update'
	]);

	// MODUL DISTRIBUSI
	Route::post('distribusi/update_penilaian', 'DistribusiController@update_penilaian');
	Route::get('distribusi/dataKaryawan', 'DistribusiController@listKaryawan')->name('distribusi.dataKaryawan');
	Route::get('distribusi/data', 'DistribusiController@listData')->name('distribusi.data');
    Route::resource('distribusi', 'DistribusiController')->names([
		'index' => 'distribusi.index',
		'create' => 'distribusi.create',
		'update' => 'distribusi.update'
	]);

	// MODUL PENETAPAN/SIDANG KOMITE
	Route::get('penetapan/{id?}/cetak_sidang', 'PenetapanController@cetak_sidang')->name('penetapan.cetak_sidang');
	Route::post('penetapan/update_penilaian', 'PenetapanController@update_penilaian');
	Route::get('penetapan/data', 'PenetapanController@listData')->name('penetapan.data');
    Route::resource('penetapan', 'PenetapanController')->names([
		'index' => 'penetapan.index',
		'create' => 'penetapan.create',
		'update' => 'penetapan.update'
	]);
});

Route::get('/change_password', 'BerandaController@change_password')->name('change_password');
Route::post('/ganti_password/{id?}/update_password', 'BerandaController@update_password');
