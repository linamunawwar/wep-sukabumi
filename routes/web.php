<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Auth::routes();
Route::get('/logout', 'Auth\LoginController@logout');
Route::group(['middleware' => 'auth'], function () {
	Route::get('/', 'HomeController@index');

	Route::get('/pegawai', 'PegawaiController@index');
	Route::get('/pegawai/create', 'PegawaiController@getCreate');

	Route::get('/pegawai/struktur', 'PegawaiController@getStruktur');

	Route::get('/pegawai/prod05', 'PegawaiController@getProd05');

	Route::get('/pegawai/pecat', 'PegawaiController@getPecat');
	Route::get('/pegawai/pecat/create', 'PegawaiController@getCreatePecat');

	Route::get('/pegawai/resign', 'PegawaiController@getResign');
	Route::get('/pegawai/resign/create', 'PegawaiController@getCreateResign');

	//--------------------CUTI----------------------
	Route::get('/cuti', 'CutiController@index');
	Route::get('/cuti/create', 'CutiController@getCreate');
	//-------------------------IZIN--------------
	Route::get('/izin', 'IzinController@index');
	Route::get('/izin/create', 'IzinController@getCreate');
	//-------------------GAJI-----------------
	Route::get('/gaji', 'GajiController@index');
	Route::get('/gaji/create', 'GajiController@getCreate');
	Route::get('/gaji/list_transfer', 'GajiController@getListTransfer');
	//---------------------SPJ----------------------------
	Route::get('/spj', 'SpjController@index');
	Route::get('/spj/create', 'SpjController@getCreate');
	//----------------------MEMO-----------
	Route::get('/memo', 'MemoController@index');
	//-------------------------DISPOSISI----------------
	Route::get('/surat_masuk', 'DisposisiController@indexSuratMasuk');
	Route::get('/surat_masuk/create', 'DisposisiController@getCreateSuratMasuk');

	Route::get('/disposisi', 'DisposisiController@index');
	Route::get('/disposisi/create', 'DisposisiController@getCreate');
	Route::get('/disposisi/monitor', 'DisposisiController@getMonitor');

	//--------------------RENCANA KEBUTUHAN PEGAWAI--------------------
	Route::get('/rkp', 'RkpController@index');
	Route::get('/rkp/create', 'RkpController@getCreate');

	//-------------------FORM PELATIHAN----------------------
	Route::get('/pelatihan', 'PelatihanController@index');
	Route::get('/pelatihan/create_gap', 'PelatihanController@getCreateGap');
	Route::get('/pelatihan/create_usulan', 'PelatihanController@getCreateUsulan');
	Route::get('/pelatihan/edit_usulan', 'PelatihanController@getEditUsulan');

	//----------------ARSIP----------------
	Route::get('/arsip', 'ArsipController@index');
	Route::get('/arsip/create', 'ArsipController@getCreate');

	//----------------Peralatan----------------
	Route::get('/peralatan', 'PeralatanController@index');
	Route::get('/peralatan/create', 'PeralatanController@getCreate');



	//>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>USER<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<

	//-----------------------PEGAWAI USER-------------------------
	Route::get('/pegawai/user', 'PegawaiController@indexUser');

	Route::get('/pegawai/user/struktur', 'PegawaiController@getStrukturUser');

	Route::get('/pegawai/user/resign', 'PegawaiController@getResignUser');

	//----------------------Cuti User ------------------
	Route::get('/user/cuti', 'CutiController@indexUser');
	Route::get('/user/cuti/create', 'CutiController@getCreateUser');
	Route::get('/user/serah_tugas', 'CutiController@getSerahTugas');
	//----------------------izin User ------------------
	Route::get('/user/izin', 'IzinController@indexUser');
	Route::get('/user/izin/create', 'IzinController@getCreateUser');
	//------------------------------GAJI USER-----------------------------------
	Route::get('/user/gaji', 'GajiController@indexUser');
	Route::get('/user/gaji/slip_gaji', 'GajiController@slipGaji');
	Route::get('/user/gaji/slip_gaji/create', 'GajiController@slipGajiCreate');

	//----------------------Cuti User ------------------
	Route::get('/user/spj', 'SpjController@indexUser');
	Route::get('/user/spj/create', 'SpjController@getCreateUser');

	
});
