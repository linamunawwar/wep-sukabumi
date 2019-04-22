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

	Route::group(['prefix' => '/admin'], function () {
		// Route::get('/', ['as' => 'users.countdown', 'uses' => 'HomeController@countdown']);
		Route::get('/pegawai', 'admin\PegawaiController@index');
		Route::get('/pegawai/create','admin\PegawaiController@getCreate');
		Route::post('/pegawai/create','admin\PegawaiController@postCreate');
		Route::get('/pegawai/edit/{id}','admin\PegawaiController@getEdit');
		Route::post('/pegawai/edit/{id}','admin\PegawaiController@postEdit');
		Route::get('/pegawai/approve_admin', 'admin\PegawaiController@getApproveAdmin');
		Route::get('/pegawai/struktur', 'admin\PegawaiController@getStruktur');

		
	});

	Route::group(['prefix' => '/user'], function () {
		// Route::get('/', ['as' => 'users.countdown', 'uses' => 'HomeController@countdown']);
		Route::get('/pegawai', 'user\PegawaiController@index');
		Route::get('/pegawai/edit_cv/{nip}', 'user\PegawaiController@getEditCV');
		Route::post('/pegawai/edit_cv/{nip}','user\PegawaiController@postEditCV');
		Route::get('/pegawai/struktur', 'user\PegawaiController@getStruktur');
		
	});
	Route::get('/pegawai', 'PegawaiController@index');
	Route::get('/pegawai/manager', 'PegawaiController@indexManager');
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

	//---------------SURAT KELUAR-----------------------
	Route::get('/surat_keluar', 'SuratKeluarController@index');
	Route::get('/surat_keluar/create', 'SuratKeluarController@getCreate');

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

	//--------------------MANAGER-------------------------
	Route::get('/manager/cuti', 'CutiController@indexManager');
	Route::get('/manager/cuti/approve', 'CutiController@approveManager');

	Route::get('/manager/pecat', 'PegawaiController@pecatManager');
	Route::get('/manager/pecat/approve', 'PegawaiController@approvePecatManager');

	Route::get('/manager/resign', 'PegawaiController@resignManager');
	Route::get('/manager/resign/approve', 'PegawaiController@approveResignManager');

	Route::get('/manager/slip_gaji', 'GajiController@slipGajiManager');
	Route::get('/manager/slip_gaji/approve', 'GajiController@approveSlipGajiManager');

	Route::get('/manager/disposisi', 'DisposisiController@indexManager');
	Route::get('/manager/disposisi/proses', 'DisposisiController@prosesManager');

	Route::get('/manager/rkp', 'RkpController@indexManager');
	Route::get('/manager/rkp/create', 'RkpController@getCreate');

	//--------------------PROJECT MANAGER-------------------------
	Route::get('/pm/cuti', 'CutiController@indexPM');
	Route::get('/pm/cuti/approve', 'CutiController@approvePM');

	Route::get('/pm/disposisi', 'DisposisiController@indexPM');
	Route::get('/pm/disposisi/proses', 'DisposisiController@prosesPM');

	Route::get('/pm/rkp', 'RkpController@indexPM');
	Route::get('/pm/rkp/detail', 'RkpController@getDetail');
});
