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
		Route::get('/pegawai/edit_cv/{id}', 'admin\PegawaiController@getEditCV');
		Route::post('/pegawai/edit_cv/{id}','admin\PegawaiController@postEditCV');
		Route::get('/pegawai/approve/{id}', 'admin\PegawaiController@getApprove');
		Route::post('/pegawai/approve/{id}', 'admin\PegawaiController@postApprove');
		Route::get('/pegawai/struktur', 'admin\PegawaiController@getStruktur');

		//pemecatan
		Route::get('/pegawai/pecat', 'admin\PegawaiController@getPecat');
		Route::get('/pegawai/pecat/create', 'admin\PegawaiController@getCreatePecat');
		Route::post('/pegawai/pecat/create', 'admin\PegawaiController@postCreatePecat');

		//resign
		Route::get('/pegawai/resign', 'admin\PegawaiController@getResign');

		
	});

	Route::group(['prefix' => '/user'], function () {
		Route::get('/pegawai', 'user\PegawaiController@index');
		Route::get('/pegawai/edit_cv/{nip}', 'user\PegawaiController@getEditCV');
		Route::post('/pegawai/edit_cv/{nip}','user\PegawaiController@postEditCV');
		Route::get('/pegawai/struktur', 'user\PegawaiController@getStruktur');
		Route::get('/pegawai/resign', 'user\PegawaiController@getResign');
		Route::get('/pegawai/resign/create', 'user\PegawaiController@getCreateResign');
		Route::post('/pegawai/resign/create', 'user\PegawaiController@postCreateResign');

		
	});

	Route::group(['prefix' => '/manager'], function () {
		Route::get('/pegawai', 'manager\PegawaiController@index');
		Route::get('/pegawai/approve/{id}', 'manager\PegawaiController@getApprove');
		Route::post('/pegawai/approve/{id}', 'manager\PegawaiController@postApprove');
		Route::get('/pegawai/struktur', 'manager\PegawaiController@getStruktur');

		Route::get('/pegawai/pecat', 'manager\PegawaiController@getPecat');
		Route::get('/pegawai/pecat/approve/{id}', 'manager\PegawaiController@getApprovePecat');
		Route::post('/pegawai/pecat/approve/{id}', 'manager\PegawaiController@postApprovePecat');
		Route::get('/pegawai/pecat/approve_sdm/{id}', 'manager\PegawaiController@getApprovePecatSDM');
		Route::post('/pegawai/pecat/approve_sdm/{id}', 'manager\PegawaiController@postApprovePecatSDM');

		Route::get('/pegawai/resign', 'manager\PegawaiController@getResign');
		Route::get('/pegawai/resign/approve/{id}', 'manager\PegawaiController@getApproveResign');
		Route::post('/pegawai/resign/approve/{id}', 'manager\PegawaiController@postApproveResign');
		Route::get('/pegawai/resign/approve_sdm/{id}', 'manager\PegawaiController@getApproveResignSDM');
		Route::post('/pegawai/resign/approve_sdm/{id}', 'manager\PegawaiController@postApproveResignSDM');
	});

	Route::group(['prefix' => '/pm'], function () {
		Route::get('/pegawai', 'pm\PegawaiController@index');
		Route::get('/pegawai/approve/{id}', 'pm\PegawaiController@getApprove');
		Route::post('/pegawai/approve/{id}', 'pm\PegawaiController@postApprove');
		Route::get('/pegawai/struktur', 'pm\PegawaiController@getStruktur');

		Route::get('/pegawai/pecat', 'pm\PegawaiController@getPecat');
		Route::get('/pegawai/pecat/approve/{id}', 'pm\PegawaiController@getApprovePecat');
		Route::post('/pegawai/pecat/approve/{id}', 'pm\PegawaiController@postApprovePecat');

		Route::get('/pegawai/resign', 'pm\PegawaiController@getResign');
		Route::get('/pegawai/resign/approve/{id}', 'pm\PegawaiController@getApproveResign');
		Route::post('/pegawai/resign/approve/{id}', 'pm\PegawaiController@postApproveResign');
	});


	

	Route::get('/pegawai/struktur', 'PegawaiController@getStruktur');

	Route::get('/pegawai/prod05', 'PegawaiController@getProd05');

	

	
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
