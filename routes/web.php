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

		//cuti
		Route::get('/cuti', 'admin\CutiController@index');
		Route::get('/cuti/create', 'admin\CutiController@getCreate');
		Route::post('/cuti/create', 'admin\CutiController@postCreate');

		//gaji
		Route::get('/gaji', 'admin\GajiController@index');
		Route::get('/gaji/create', 'admin\GajiController@getCreate');
		Route::get('/gaji/list_transfer', 'admin\GajiController@getListTransfer');
		Route::get('/gaji/edit/{id}', 'admin\GajiController@getEdit');
		Route::post('/gaji/edit/{id}', 'admin\GajiController@postEdit');
		Route::get('/gaji/slip_gaji', 'admin\GajiController@slipGaji');
		Route::get('/gaji/slip_gaji/create', 'admin\GajiController@getSlipGajiCreate');
		Route::post('/gaji/slip_gaji/create', 'admin\GajiController@postSlipGajiCreate');

		//memo
		Route::get('/memo', 'admin\MemoController@index');
		Route::get('/memo/create', 'admin\MemoController@getCreate');
		Route::post('/memo/create', 'admin\MemoController@postCreate');
		Route::get('/memo/detail/{id}', 'admin\MemoController@getDetail');
		Route::get('/memo/edit/{id}', 'admin\MemoController@getEdit');
		Route::post('/memo/edit/{id}', 'admin\MemoController@postEdit');
		Route::get('/memo/delete/{id}', 'admin\MemoController@getDelete');

		Route::get('/spj', 'admin\SpjController@index');
		Route::get('/spj/create', 'admin\SpjController@getCreate');
		Route::post('/spj/create', 'admin\SpjController@postCreate');
		Route::get('/spj/approve/{id}', 'admin\SpjController@getApprove');
		
	});

	Route::group(['prefix' => '/user'], function () {
		Route::get('/pegawai', 'user\PegawaiController@index');
		Route::get('/pegawai/edit_cv/{nip}', 'user\PegawaiController@getEditCV');
		Route::post('/pegawai/edit_cv/{nip}','user\PegawaiController@postEditCV');
		Route::get('/pegawai/struktur', 'user\PegawaiController@getStruktur');
		Route::get('/pegawai/resign', 'user\PegawaiController@getResign');
		Route::get('/pegawai/resign/create', 'user\PegawaiController@getCreateResign');
		Route::post('/pegawai/resign/create', 'user\PegawaiController@postCreateResign');

		//Cuti
		Route::get('/cuti', 'user\CutiController@index');
		Route::get('/cuti/create', 'user\CutiController@getCreate');
		Route::post('/cuti/create', 'user\CutiController@postCreate');
		Route::get('/cuti/serah_tugas', 'user\CutiController@getSerahTugas');
		Route::get('/cuti/approve/{id}', 'user\CutiController@approveSerahTugas');

		Route::get('/izin', 'user\IzinController@index');
		Route::get('/izin/create', 'user\IzinController@getCreate');
		Route::post('/izin/create', 'user\IzinController@postCreate');

		//gaji
		Route::get('/gaji', 'user\GajiController@index');
		Route::get('/gaji/slip_gaji', 'user\GajiController@slipGaji');
		Route::get('/gaji/slip_gaji/create', 'user\GajiController@getSlipGajiCreate');
		Route::post('/gaji/slip_gaji/create', 'user\GajiController@postSlipGajiCreate');

		//memo
		Route::get('/memo', 'user\MemoController@index');
		Route::get('/memo/detail/{id}', 'user\MemoController@getDetail');

		//spj
		Route::get('/spj', 'user\SpjController@index');
		Route::get('/spj/create', 'user\SpjController@getCreate');
		Route::post('/spj/create', 'user\SpjController@postCreate');

		
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

		Route::get('/cuti', 'manager\CutiController@index');
		Route::get('/cuti/approve/{id}', 'manager\CutiController@approve');
		Route::post('/cuti/approve/{id}', 'manager\CutiController@postApprove');
		Route::get('/cuti/approve_sdm/{id}', 'manager\CutiController@approveSDM');
		Route::post('/cuti/approve_sdm/{id}', 'manager\CutiController@postApproveSDM');

		Route::get('/izin', 'manager\IzinController@index');
		Route::get('/izin/approve/{id}', 'manager\IzinController@approve');

		//gaji
		Route::get('/gaji', 'manager\GajiController@index');
		Route::get('/gaji/slip_gaji', 'manager\GajiController@slipGaji');
		Route::get('/gaji/slip_gaji/approve/{id}', 'manager\GajiController@approveSlipGaji');

		//memo
		Route::get('/memo', 'manager\MemoController@index');
		Route::get('/memo/detail/{id}', 'manager\MemoController@getDetail');

		//spj
		Route::get('/spj', 'manager\SpjController@index');
		Route::get('/spj/create', 'manager\SpjController@getCreate');
		Route::post('/spj/create', 'manager\SpjController@postCreate');

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

		Route::get('/cuti', 'pm\CutiController@index');
		Route::get('/cuti/approve/{id}', 'pm\CutiController@approve');
		Route::post('/cuti/approve/{id}', 'pm\CutiController@postApprove');

		Route::get('/gaji', 'pm\GajiController@index');

		Route::get('/memo', 'pm\MemoController@index');
		Route::get('/memo/detail/{id}', 'pm\MemoController@getDetail');

		//spj
		Route::get('/spj', 'pm\SpjController@index');
		Route::get('/spj/create', 'pm\SpjController@getCreate');
		Route::post('/spj/create', 'pm\SpjController@postCreate');
	});


	

	Route::get('/pegawai/struktur', 'PegawaiController@getStruktur');

	Route::get('/pegawai/prod05', 'PegawaiController@getProd05');

	

	
	//--------------------CUTI----------------------
	
	//-------------------GAJI-----------------
	
	//---------------------SPJ----------------------------
	
	//----------------------MEMO-----------
	
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

	

	Route::get('/manager/disposisi', 'DisposisiController@indexManager');
	Route::get('/manager/disposisi/proses', 'DisposisiController@prosesManager');

	Route::get('/manager/rkp', 'RkpController@indexManager');
	Route::get('/manager/rkp/create', 'RkpController@getCreate');

	//--------------------PROJECT MANAGER-------------------------

	Route::get('/pm/disposisi', 'DisposisiController@indexPM');
	Route::get('/pm/disposisi/proses', 'DisposisiController@prosesPM');

	Route::get('/pm/rkp', 'RkpController@indexPM');
	Route::get('/pm/rkp/detail', 'RkpController@getDetail');
});
