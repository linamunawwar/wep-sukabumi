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
Route::get('/password', 'PegawaiController@showResetForm');
Route::post('/password', 'PegawaiController@postReset');
Route::group(['middleware' => 'auth'], function () {
	Route::get('/', 'HomeController@index');

	Route::group(['prefix' => '/admin'], function () {
		// Route::get('/', ['as' => 'users.countdown', 'uses' => 'HomeController@countdown']);
		Route::get('/pegawai', 'admin\PegawaiController@index');
		Route::get('/pegawai/create','admin\PegawaiController@getCreate');
		Route::post('/pegawai/create','admin\PegawaiController@postCreate');
		Route::get('/pegawai/posisi/{kode}','admin\PegawaiController@getPosisi');
		Route::get('/pegawai/edit/{id}','admin\PegawaiController@getEdit');
		Route::post('/pegawai/edit/{id}','admin\PegawaiController@postEdit');
		Route::get('/pegawai/edit_cv/{id}', 'admin\PegawaiController@getEditCV');
		Route::post('/pegawai/edit_cv/{id}','admin\PegawaiController@postEditCV');
		Route::get('/pegawai/unduh_cv/{id}','admin\PegawaiController@getUnduhCV');
		Route::get('/pegawai/unduh_mcu/{id}','admin\PegawaiController@getUnduhMCU');
		Route::get('/pegawai/unduh_pkwt/{id}','admin\PegawaiController@getUnduhPKWT');
		Route::get('/pegawai/approve/{id}', 'admin\PegawaiController@getApprove');
		Route::post('/pegawai/approve/{id}', 'admin\PegawaiController@postApprove');
		Route::get('/pegawai/struktur', 'admin\PegawaiController@getStruktur');
		Route::get('/pegawai/prod05', 'admin\PegawaiController@getProd05');
		Route::get('/pegawai/prod05/unduh', 'admin\PegawaiController@getProd05Unduh');

		Route::get('/pegawai_non_aktif', 'admin\PegawaiController@indexNonAktif');

		//pemecatan
		Route::get('/pegawai/pecat', 'admin\PegawaiController@getPecat');
		Route::get('/pegawai/pecat/create', 'admin\PegawaiController@getCreatePecat');
		Route::post('/pegawai/pecat/create', 'admin\PegawaiController@postCreatePecat');
		Route::get('/pegawai/pecat/spk/{id}', 'admin\PegawaiController@getUnduhSPK');

		//resign
		Route::get('/pegawai/resign', 'admin\PegawaiController@getResign');

		//pemecatan
		Route::get('/pegawai/pelatihan', 'admin\PegawaiController@getPelatihan');
		Route::get('/pegawai/pelatihan/create', 'admin\PegawaiController@getCreatePelatihan');
		Route::post('/pegawai/pelatihan/create', 'admin\PegawaiController@postCreatePelatihan');
		Route::post('/pegawai/pelatihan/unduh', 'admin\PegawaiController@postUnduhPelatihan');
		Route::get('/pegawai/pelatihan/edit/{id}', 'admin\PegawaiController@getEditPelatihan');
		Route::post('/pegawai/pelatihan/edit/{id}', 'admin\PegawaiController@postEditPelatihan');
		Route::get('/pegawai/pelatihan/delete/{id}', 'admin\PegawaiController@getDeletePelatihan');

		//izin
		Route::get('/izin', 'admin\IzinController@index');
		Route::get('/pengajuan_izin', 'admin\IzinController@getPengajuanIzin');
		Route::get('/pengajuan_izin/create', 'admin\IzinController@getPengajuanIzinCreate');
		Route::post('/pengajuan_izin/create', 'admin\IzinController@postPengajuanIzinCreate');

		//cuti
		Route::get('/cuti', 'admin\CutiController@index');
		Route::get('/cuti/create', 'admin\CutiController@getCreate');
		Route::post('/cuti/create', 'admin\CutiController@postCreate');
		Route::get('/cuti/surat_cuti/{id}', 'admin\CutiController@getSuratCuti');
		Route::get('/pengajuan_cuti', 'admin\CutiController@getPengajuanCuti');
		Route::get('/pengajuan_cuti/create', 'admin\CutiController@getPengajuanCutiCreate');
		Route::post('/pengajuan_cuti/create', 'admin\CutiController@postPengajuanCuticCreate');

		//gaji
		Route::get('/gaji', 'admin\GajiController@index');
		Route::get('/gaji/create', 'admin\GajiController@getCreate');
		Route::get('/gaji/list_transfer', 'admin\GajiController@getListTransfer');
		Route::get('/gaji/edit/{id}', 'admin\GajiController@getEdit');
		Route::post('/gaji/edit/{id}', 'admin\GajiController@postEdit');
		Route::get('/gaji/slip_gaji', 'admin\GajiController@slipGaji');
		Route::get('/gaji/slip_gaji/create', 'admin\GajiController@getSlipGajiCreate');
		Route::post('/gaji/slip_gaji/create', 'admin\GajiController@postSlipGajiCreate');
		Route::get('/gaji/slip_gaji/unduh/{id}', 'admin\GajiController@getSlipGajiUnduh');

		//memo
		Route::get('/memo', 'admin\MemoController@index');
		Route::get('/memo/create', 'admin\MemoController@getCreate');
		Route::post('/memo/create', 'admin\MemoController@postCreate');
		Route::get('/memo/detail/{id}', 'admin\MemoController@getDetail');
		Route::get('/memo/edit/{id}', 'admin\MemoController@getEdit');
		Route::post('/memo/edit/{id}', 'admin\MemoController@postEdit');
		Route::get('/memo/delete/{id}', 'admin\MemoController@getDelete');

		//spj
		Route::get('/spj', 'admin\SpjController@index');
		Route::get('/spj/create', 'admin\SpjController@getCreate');
		Route::post('/spj/create', 'admin\SpjController@postCreate');
		Route::get('/spj/approve/{id}', 'admin\SpjController@getApprove');
		Route::get('/spj/unduh/{id}', 'admin\SpjController@getUnduh');

		//disposisi
		Route::get('/surat_masuk', 'admin\DisposisiController@indexSuratMasuk');
		Route::get('/surat_masuk/create', 'admin\DisposisiController@getCreateSuratMasuk');
		Route::post('/surat_masuk/create', 'admin\DisposisiController@postCreateSuratMasuk');
		Route::get('/surat_masuk/edit/{id}', 'admin\DisposisiController@getEditSuratMasuk');
		Route::post('/surat_masuk/edit/{id}', 'admin\DisposisiController@postEditSuratMasuk');
		Route::get('/surat_masuk/delete/{id}', 'admin\DisposisiController@getDeleteSuratMasuk');
		Route::get('/surat_masuk/unduh/{id}', 'admin\DisposisiController@getUnduhSuratMasuk');

		Route::get('/disposisi', 'admin\DisposisiController@index');
		Route::get('/disposisi/create', 'admin\DisposisiController@getCreate');
		Route::post('/disposisi/create', 'admin\DisposisiController@postCreate');
		Route::get('/disposisi/edit/{id}', 'admin\DisposisiController@getEdit');
		Route::post('/disposisi/edit/{id}', 'admin\DisposisiController@postEdit');
		Route::get('/disposisi/delete/{id}', 'admin\DisposisiController@getDelete');
		Route::get('/disposisi/monitoring/{id}', 'admin\DisposisiController@monitoring');
		Route::get('/disposisi/unduh/{id}', 'admin\DisposisiController@getUnduhDisposisi');
		
		//surat keluar
		Route::get('/surat_keluar', 'admin\SuratKeluarController@index');
		Route::get('/surat_keluar/create', 'admin\SuratKeluarController@getCreate');
		Route::post('/surat_keluar/create', 'admin\SuratKeluarController@postCreate');
		Route::get('/surat_keluar/edit/{id}', 'admin\SuratKeluarController@getEdit');
		Route::post('/surat_keluar/edit/{id}', 'admin\SuratKeluarController@postEdit');
		Route::get('/surat_keluar/delete/{id}', 'admin\SuratKeluarController@getDelete');

		//rkp
		Route::get('/rkp', 'admin\RkpController@index');

		//peralatan
		Route::get('/peralatan/data', 'admin\PeralatanController@indexData');
		Route::get('/peralatan/data/create', 'admin\PeralatanController@getCreateData');
		Route::post('/peralatan/data/create', 'admin\PeralatanController@postCreateData');
		Route::get('/peralatan/data/edit/{id}', 'admin\PeralatanController@getEditData');
		Route::post('/peralatan/data/edit/{id}', 'admin\PeralatanController@postEditData');
		Route::get('/peralatan/data/delete/{id}', 'admin\PeralatanController@getDeleteData');
		Route::get('/peralatan', 'admin\PeralatanController@index');
		Route::get('/peralatan/create', 'admin\PeralatanController@getCreate');
		Route::post('/peralatan/create', 'admin\PeralatanController@postCreate');
		Route::get('/peralatan/edit/{id}', 'admin\PeralatanController@getEdit');
		Route::post('/peralatan/edit/{id}', 'admin\PeralatanController@postEdit');
		Route::get('/peralatan/delete/{id}', 'admin\PeralatanController@getDelete');
		Route::get('/peralatan/kembali/{id}', 'admin\PeralatanController@getKembali');

		Route::get('/arsip', 'admin\ArsipController@index');
		Route::get('/arsip/create', 'admin\ArsipController@getCreate');
		Route::post('/arsip/create', 'admin\ArsipController@postCreate');
		Route::get('/arsip/edit/{id}', 'admin\ArsipController@getEdit');
		Route::post('/arsip/edit/{id}', 'admin\ArsipController@postEdit');
		Route::get('/arsip/delete/{id}', 'admin\ArsipController@getDelete');
		Route::get('/arsip/unduh/{id}', 'admin\ArsipController@getUnduh');
	});

	Route::group(['prefix' => '/user'], function () {
		Route::get('/pegawai', 'user\PegawaiController@index');
		Route::get('/pegawai/edit_cv/{nip}', 'user\PegawaiController@getEditCV');
		Route::post('/pegawai/edit_cv/{nip}','user\PegawaiController@postEditCV');
		Route::get('/pegawai/unduh_cv/{id}','admin\PegawaiController@getUnduhCV');
		Route::get('/pegawai/unduh_mcu/{id}','admin\PegawaiController@getUnduhMCU');
		Route::get('/pegawai/unduh_pkwt/{id}','admin\PegawaiController@getUnduhPKWT');
		Route::get('/pegawai/struktur', 'user\PegawaiController@getStruktur');
		Route::get('/pegawai/resign', 'user\PegawaiController@getResign');
		Route::get('/pegawai/resign/create', 'user\PegawaiController@getCreateResign');
		Route::post('/pegawai/resign/create', 'user\PegawaiController@postCreateResign');
		Route::get('/pegawai/resign/spk/{id}', 'user\PegawaiController@getUnduhSPK');

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
		Route::get('/pegawai/unduh_cv/{id}','admin\PegawaiController@getUnduhCV');
		Route::get('/pegawai/unduh_mcu/{id}','admin\PegawaiController@getUnduhMCU');
		Route::get('/pegawai/unduh_pkwt/{id}','admin\PegawaiController@getUnduhPKWT');
		Route::get('/pegawai/struktur', 'manager\PegawaiController@getStruktur');

		Route::get('/pegawai_non_aktif', 'manager\PegawaiController@indexNonAktif');

		Route::get('/pegawai/pecat', 'manager\PegawaiController@getPecat');
		Route::get('/pegawai/pecat/create', 'manager\PegawaiController@getCreatePecat');
		Route::post('/pegawai/pecat/create', 'manager\PegawaiController@postCreatePecat');
		Route::get('/pegawai/pecat/tanggal_masuk/{nip}', 'manager\PegawaiController@getTanggalMasuk');
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
		Route::get('/pengajuan_cuti', 'user\CutiController@index');
		Route::get('/pengajuan_cuti/create', 'user\CutiController@getCreate');
		Route::post('/pengajuan_cuti/create', 'user\CutiController@postCreate');

		Route::get('/izin', 'manager\IzinController@index');
		Route::get('/izin/approve/{id}', 'manager\IzinController@approve');
		Route::get('/pengajuan_izin', 'user\IzinController@index');
		Route::get('/pengajuan_izin/create', 'user\IzinController@getCreate');
		Route::post('/pengajuan_izin/create', 'user\IzinController@postCreate');

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

		//disposisi
		Route::get('/disposisi', 'manager\DisposisiController@index');
		Route::get('/disposisi/proses/{id}', 'manager\DisposisiController@proses');
		Route::post('/disposisi/proses/{id}', 'manager\DisposisiController@postProses');
		Route::get('/disposisi/monitoring/{id}', 'manager\DisposisiController@monitoring');

		//rkp
		Route::get('/rkp', 'manager\RkpController@index');
		Route::get('/rkp/create', 'manager\RkpController@getCreate');
		Route::post('/rkp/create', 'manager\RkpController@postCreate');

		//peralatan
		Route::get('/peralatan', 'manager\PeralatanController@index');
		Route::get('/peralatan/approve/{id}', 'manager\PeralatanController@getApprove');


	});

	Route::group(['prefix' => '/pm'], function () {
		Route::get('/pegawai', 'pm\PegawaiController@index');
		Route::get('/pegawai/approve/{id}', 'pm\PegawaiController@getApprove');
		Route::post('/pegawai/approve/{id}', 'pm\PegawaiController@postApprove');
		Route::get('/pegawai/unduh_cv/{id}','admin\PegawaiController@getUnduhCV');
		Route::get('/pegawai/unduh_mcu/{id}','admin\PegawaiController@getUnduhMCU');
		Route::get('/pegawai/unduh_pkwt/{id}','admin\PegawaiController@getUnduhPKWT');
		Route::get('/pegawai/struktur', 'pm\PegawaiController@getStruktur');

		Route::get('/pegawai_non_aktif', 'pm\PegawaiController@indexNonAktif');

		Route::get('/pegawai/pecat', 'pm\PegawaiController@getPecat');
		Route::get('/pegawai/pecat/approve/{id}', 'pm\PegawaiController@getApprovePecat');
		Route::post('/pegawai/pecat/approve/{id}', 'pm\PegawaiController@postApprovePecat');

		Route::get('/pegawai/resign', 'pm\PegawaiController@getResign');
		Route::get('/pegawai/resign/approve/{id}', 'pm\PegawaiController@getApproveResign');
		Route::post('/pegawai/resign/approve/{id}', 'pm\PegawaiController@postApproveResign');

		Route::get('/cuti', 'pm\CutiController@index');
		Route::get('/cuti/approve/{id}', 'pm\CutiController@approve');
		Route::post('/cuti/approve/{id}', 'pm\CutiController@postApprove');
		Route::get('/pengajuan_cuti', 'user\CutiController@index');
		Route::get('/pengajuan_cuti/create', 'user\CutiController@getCreate');
		Route::post('/pengajuan_cuti/create', 'user\CutiController@postCreate');

		Route::get('/pengajuan_izin', 'user\IzinController@index');
		Route::get('/pengajuan_izin/create', 'user\IzinController@getCreate');
		Route::post('/pengajuan_izin/create', 'user\IzinController@postCreate');

		Route::get('/gaji', 'pm\GajiController@index');

		Route::get('/memo', 'pm\MemoController@index');
		Route::get('/memo/detail/{id}', 'pm\MemoController@getDetail');

		//spj
		Route::get('/spj', 'pm\SpjController@index');
		Route::get('/spj/create', 'pm\SpjController@getCreate');
		Route::post('/spj/create', 'pm\SpjController@postCreate');

		//disposisi
		Route::get('/disposisi', 'pm\DisposisiController@index');
		Route::get('/disposisi/proses/{id}', 'pm\DisposisiController@proses');
		Route::post('/disposisi/proses/{id}', 'pm\DisposisiController@postProses');
		Route::get('/disposisi/edit/{id}', 'pm\DisposisiController@getEdit');
		Route::post('/disposisi/edit/{id}', 'pm\DisposisiController@postEdit');
		Route::get('/disposisi/monitoring/{id}', 'pm\DisposisiController@monitoring');

		//rkp
		Route::get('/rkp', 'pm\RkpController@index');

	});


	

	//-------------------FORM PELATIHAN----------------------
	Route::get('/pelatihan', 'PelatihanController@index');
	Route::get('/pelatihan/create_gap', 'PelatihanController@getCreateGap');
	Route::get('/pelatihan/create_usulan', 'PelatihanController@getCreateUsulan');
	Route::get('/pelatihan/edit_usulan', 'PelatihanController@getEditUsulan');

});
