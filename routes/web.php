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
	Route::get('/Logistik', 'Logistik\HomeController@index');

	Route::group(['prefix' => '/admin'], function () {
		// Route::get('/', ['as' => 'users.countdown', 'uses' => 'HomeController@countdown']);
		Route::get('/pegawai', 'admin\PegawaiController@index');
		Route::get('/pegawai/create','admin\PegawaiController@getCreate');
		Route::post('/pegawai/create','admin\PegawaiController@postCreate');
		Route::get('/pegawai/posisi/{kode}','admin\PegawaiController@getPosisi');
		Route::get('/pegawai/edit/{id}','admin\PegawaiController@getEdit');
		Route::post('/pegawai/edit/{id}','admin\PegawaiController@postEdit');
		Route::delete('/pegawai/delete','admin\PegawaiController@postDelete');
		Route::get('/pegawai/edit_cv/{id}', 'admin\PegawaiController@getEditCV');
		Route::post('/pegawai/edit_cv/{id}','admin\PegawaiController@postEditCV');
		Route::get('/pegawai/unduh_cv/{id}','admin\PegawaiController@getUnduhCV');
		Route::get('/pegawai/unduh_mcu/{id}','admin\PegawaiController@getUnduhMCU');
		Route::get('/pegawai/unduh_pkwt/{id}','admin\PegawaiController@getUnduhPKWT');
		Route::get('/pegawai/approve/{id}', 'admin\PegawaiController@getApprove');
		Route::post('/pegawai/approve/{id}', 'admin\PegawaiController@postApprove');
		Route::get('/pegawai/reject/{id}', 'admin\PegawaiController@getReject');
		Route::get('/pegawai/editrole/{id}', 'admin\PegawaiController@getEditRole');
		Route::post('/pegawai/editrole/{id}', 'admin\PegawaiController@postEditRole');
		Route::get('/pegawai/struktur', 'admin\PegawaiController@getStruktur');
		Route::get('/pegawai/prod05', 'admin\PegawaiController@getProd05');
		Route::get('/pegawai/prod05/unduh', 'admin\PegawaiController@getProd05Unduh');

		Route::get('/pegawai_non_aktif', 'admin\PegawaiController@indexNonAktif');
		Route::delete('/pegawai_non_aktif/delete', 'admin\PegawaiController@deleteNonAktif');

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
		Route::get('/izin/surat_izin/{id}', 'admin\IzinController@getSuratIzin');
		Route::delete('/izin/delete', 'admin\IzinController@getDelete');

		//cuti
		Route::get('/cuti', 'admin\CutiController@index');
		Route::get('/cuti/create', 'admin\CutiController@getCreate');
		Route::post('/cuti/create', 'admin\CutiController@postCreate');
		Route::delete('/cuti/delete', 'admin\CutiController@deletePengajuan');
		Route::get('/cuti/surat_cuti/{id}', 'admin\CutiController@getSuratCuti');
		Route::get('/pengajuan_cuti', 'admin\CutiController@getPengajuanCuti');
		Route::get('/pengajuan_cuti/create', 'admin\CutiController@getPengajuanCutiCreate');
		Route::post('/pengajuan_cuti/create', 'admin\CutiController@postPengajuanCuticCreate');

		//gaji
		Route::get('/gaji', 'admin\GajiController@index');
		Route::get('/gaji/create', 'admin\GajiController@getCreate');
		Route::get('/gaji/list_transfer', 'admin\GajiController@getListTransfer');
		Route::get('/gaji/list_transfer/unduh', 'admin\GajiController@getUnduhListTransfer');
		Route::get('/gaji/edit/{id}', 'admin\GajiController@getEdit');
		Route::post('/gaji/edit/{id}', 'admin\GajiController@postEdit');
		Route::get('/gaji/slip_gaji', 'admin\GajiController@slipGaji');
		Route::get('/gaji/slip_gaji/create', 'admin\GajiController@getSlipGajiCreate');
		Route::post('/gaji/slip_gaji/create', 'admin\GajiController@postSlipGajiCreate');
		Route::get('/gaji/slip_gaji/unduh/{id}', 'admin\GajiController@getSlipGajiUnduh');
		Route::get('/gaji/slip_gaji/preview_admin/{id}', 'admin\GajiController@getSlipGajiUnduhAdmin');

		//memo
		Route::get('/memo', 'admin\MemoController@index');
		Route::get('/memo/create', 'admin\MemoController@getCreate');
		Route::post('/memo/create', 'admin\MemoController@postCreate');
		Route::get('/memo/detail/{id}', 'admin\MemoController@getDetail');
		Route::get('/memo/edit/{id}', 'admin\MemoController@getEdit');
		Route::post('/memo/edit/{id}', 'admin\MemoController@postEdit');
		Route::delete('/memo/delete', 'admin\MemoController@getDelete');

		//spj
		Route::get('/spj', 'admin\SpjController@index');
		Route::get('/spj/create', 'admin\SpjController@getCreate');
		Route::post('/spj/create', 'admin\SpjController@postCreate');
		Route::get('/spj/edit/{id}', 'user\SpjController@getEdit');
		Route::post('/spj/edit/{id}', 'user\SpjController@postEdit');
		Route::get('/spj/approve/{id}', 'admin\SpjController@getApprove');
		Route::post('/spj/approve/{id}', 'admin\SpjController@postApprove');
		Route::get('/spj/unduh/{id}', 'admin\SpjController@getUnduh');
		Route::delete('/spj/delete', 'admin\SpjController@getDelete');

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
		Route::get('/surat_keluar/unduh/{id}', 'admin\SuratKeluarController@getUnduh');

		//rkp
		Route::get('/rkp', 'admin\RkpController@index');
		Route::get('/rkp/detail/{id}', 'admin\RkpController@getDetail');
		Route::get('/rkp/form1/{id}', 'manager\RkpController@getForm1');
		Route::get('/rkp/form2/{id}', 'manager\RkpController@getForm2');

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
		Route::delete('/cuti/delete', 'user\CutiController@deletePengajuan');
		Route::get('/cuti/serah_tugas', 'user\CutiController@getSerahTugas');
		Route::get('/cuti/approve/{id}', 'user\CutiController@approveSerahTugas');

		Route::get('/izin', 'user\IzinController@index');
		Route::get('/izin/create', 'user\IzinController@getCreate');
		Route::post('/izin/create', 'user\IzinController@postCreate');
		Route::get('/izin/surat_izin/{id}', 'admin\IzinController@getSuratIzin');

		//gaji
		Route::get('/gaji', 'user\GajiController@index');
		Route::get('/gaji/slip_gaji', 'user\GajiController@slipGaji');
		Route::get('/gaji/slip_gaji/create', 'user\GajiController@getSlipGajiCreate');
		Route::post('/gaji/slip_gaji/create', 'user\GajiController@postSlipGajiCreate');
		Route::get('/gaji/slip_gaji/unduh/{id}', 'admin\GajiController@getSlipGajiUnduh');

		//memo
		Route::get('/memo', 'user\MemoController@index');
		Route::get('/memo/detail/{id}', 'user\MemoController@getDetail');

		//spj
		Route::get('/spj', 'user\SpjController@index');
		Route::get('/spj/create', 'user\SpjController@getCreate');
		Route::post('/spj/create', 'user\SpjController@postCreate');
		Route::get('/spj/edit/{id}', 'user\SpjController@getEdit');
		Route::post('/spj/edit/{id}', 'user\SpjController@postEdit');
		Route::post('/spj/hitung', 'user\SpjController@hitungNominal');

		
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
		Route::delete('/pengajuan_cuti/delete', 'user\CutiController@deletePengajuan');

		Route::get('/izin', 'manager\IzinController@index');
		Route::get('/izin/approve/{id}', 'manager\IzinController@approve');
		Route::get('/izin/approve_sdm/{id}', 'manager\IzinController@approveSDM');
		Route::get('/pengajuan_izin', 'user\IzinController@index');
		Route::get('/pengajuan_izin/create', 'user\IzinController@getCreate');
		Route::post('/pengajuan_izin/create', 'user\IzinController@postCreate');
		Route::get('/izin/surat_izin/{id}', 'admin\IzinController@getSuratIzin');

		//gaji
		Route::get('/gaji', 'manager\GajiController@index');
		Route::get('/gaji/slip_gaji', 'manager\GajiController@slipGaji');
		Route::get('/gaji/slip_gaji/approve/{id}', 'manager\GajiController@approveSlipGaji');
		Route::get('/gaji/slip_gaji/unduh/{id}', 'admin\GajiController@getSlipGajiUnduh');

		//memo
		Route::get('/memo', 'manager\MemoController@index');
		Route::get('/memo/detail/{id}', 'manager\MemoController@getDetail');

		//spj
		Route::get('/spj', 'manager\SpjController@index');
		Route::get('/spj/create', 'manager\SpjController@getCreate');
		Route::post('/spj/create', 'manager\SpjController@postCreate');
		Route::get('/spj/approve/{id}', 'manager\SpjController@getApprove');
		Route::post('/spj/approve/{id}', 'manager\SpjController@postApprove');
		Route::get('/spj/pengajuan', 'manager\SpjController@getListPengajuan');

		//disposisi
		Route::get('/surat_masuk', 'manager\DisposisiController@indexSuratMasuk');
		Route::get('/surat_masuk/unduh/{id}', 'manager\DisposisiController@getUnduhSuratMasuk');

		Route::get('/disposisi', 'manager\DisposisiController@index');
		Route::get('/disposisi/proses/{id}', 'manager\DisposisiController@proses');
		Route::post('/disposisi/proses/{id}', 'manager\DisposisiController@postProses');
		Route::get('/disposisi/monitoring/{id}', 'manager\DisposisiController@monitoring');
		Route::get('/disposisi/unduh/{id}', 'admin\DisposisiController@getUnduhDisposisi');
		Route::get('/disposisi/setPage/{page}', 'admin\DisposisiController@setPage');
		Route::get('/disposisi/setSessionProses', 'admin\DisposisiController@setSessionProses');

		//surat keluar
		Route::get('/surat_keluar', 'manager\SuratKeluarController@index');
		Route::get('/surat_keluar/unduh/{id}', 'manager\SuratKeluarController@getUnduh');

		//rkp
		Route::get('/rkp', 'manager\RkpController@index');
		Route::get('/rkp/create', 'manager\RkpController@getCreate');
		Route::post('/rkp/create', 'manager\RkpController@postCreate');
		Route::get('/rkp/form1/{id}', 'manager\RkpController@getForm1');
		Route::get('/rkp/form2/{id}', 'manager\RkpController@getForm2');

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
		Route::delete('/pengajuan_cuti/delete', 'user\CutiController@deletePengajuan');

		Route::get('/pengajuan_izin', 'user\IzinController@index');
		Route::get('/pengajuan_izin/create', 'user\IzinController@getCreate');
		Route::post('/pengajuan_izin/create', 'user\IzinController@postCreate');
		Route::get('/izin/surat_izin/{id}', 'admin\IzinController@getSuratIzin');

		Route::get('/gaji', 'pm\GajiController@index');

		Route::get('/memo', 'pm\MemoController@index');
		Route::get('/memo/detail/{id}', 'pm\MemoController@getDetail');

		//spj
		Route::get('/spj', 'pm\SpjController@index');
		Route::get('/spj/create', 'pm\SpjController@getCreate');
		Route::post('/spj/create', 'pm\SpjController@postCreate');

		//disposisi
		Route::get('/surat_masuk', 'pm\DisposisiController@indexSuratMasuk');
		Route::get('/surat_masuk/unduh/{id}', 'pm\DisposisiController@getUnduhSuratMasuk');

		Route::get('/disposisi', 'pm\DisposisiController@index');
		Route::get('/disposisi/proses/{id}', 'pm\DisposisiController@proses');
		Route::post('/disposisi/proses/{id}', 'pm\DisposisiController@postProses');
		Route::get('/disposisi/edit/{id}', 'pm\DisposisiController@getEdit');
		Route::post('/disposisi/edit/{id}', 'pm\DisposisiController@postEdit');
		Route::get('/disposisi/monitor/{id}', 'pm\DisposisiController@monitoring');
		Route::get('/disposisi/unduh/{id}', 'admin\DisposisiController@getUnduhDisposisi');

		//surat keluar
		Route::get('/surat_keluar', 'manager\SuratKeluarController@index');
		Route::get('/surat_keluar/unduh/{id}', 'manager\SuratKeluarController@getUnduh');

		//rkp
		Route::get('/rkp', 'pm\RkpController@index');
		Route::get('/rkp/approve/{id}', 'pm\RkpController@getApprove');
		Route::post('/rkp/approve/{id}', 'pm\RkpController@postApprove');
		Route::get('/rkp/form1/{id}', 'manager\RkpController@getForm1');

	});

	//Logistik Admin
	Route::group(['prefix' => '/Logistik/admin'], function () {
		//MASTER MATERIAL
		Route::get('/material', 'Logistik\Admin\MaterialController@index');
		Route::get('/material/create', 'Logistik\Admin\MaterialController@beforePostMaterial');
		Route::post('/material/create', 'Logistik\Admin\MaterialController@postMaterial');
		Route::get('/material/edit/{id}', 'Logistik\Admin\MaterialController@getMaterialById');
		Route::post('/material/edit/{id}', 'Logistik\Admin\MaterialController@updateMaterial');
		Route::delete('/material/delete', 'Logistik\Admin\MaterialController@deleteMaterial');

		//MASTER LOKASI PEKERJAAN
		Route::get('/lokasi', 'Logistik\Admin\LokasiController@index');
		Route::get('/lokasi/create', 'Logistik\Admin\LokasiController@beforePostLocation');
		Route::post('/lokasi/create', 'Logistik\Admin\LokasiController@postLocation');
		Route::get('/lokasi/edit/{id}', 'Logistik\Admin\LokasiController@getLocationById');
		Route::post('/lokasi/edit/{id}', 'Logistik\Admin\LokasiController@updateLocation');
		Route::delete('/lokasi/delete', 'Logistik\Admin\LokasiController@deleteLocation');

		//MASTER JENIS PEKERJAAN
		Route::get('/jenis_pekerjaan', 'Logistik\Admin\JenisPekerjaanController@index');
		Route::get('/jenis_pekerjaan/create', 'Logistik\Admin\JenisPekerjaanController@beforePostJenis');
		Route::post('/jenis_pekerjaan/create', 'Logistik\Admin\JenisPekerjaanController@postJenis');
		Route::get('/jenis_pekerjaan/edit/{id}', 'Logistik\Admin\JenisPekerjaanController@getJenisById');
		Route::post('/jenis_pekerjaan/edit/{id}', 'Logistik\Admin\JenisPekerjaanController@updateJenis');
		Route::delete('/jenis_pekerjaan/delete', 'Logistik\Admin\JenisPekerjaanController@deleteJenis');

		//PERMINTAAN MATERIAL
		Route::get('/permintaan', 'Logistik\Admin\PermintaanController@index');
		Route::get('/permintaan/create', 'Logistik\Admin\PermintaanController@beforePostPermintaan');
		Route::post('/permintaan/create', 'Logistik\Admin\PermintaanController@postPermintaan');
		Route::get('/permintaan/detail/{id}', 'Logistik\Admin\PermintaanController@getDetailByPermintaanId');
		Route::get('/permintaan/edit/{id}', 'Logistik\Admin\PermintaanController@getPermintaanById');
		Route::post('/permintaan/edit/{id}', 'Logistik\Admin\PermintaanController@updatePermintaan');
		Route::get('/permintaan/deleteDetail/{detailId}/{permintaanId}', 'Logistik\Admin\PermintaanController@deleteDetailPermintaanMaterial');
		Route::delete('/permintaan/delete', 'Logistik\Admin\PermintaanController@deletePermintaan');
		Route::get('/permintaan/unduh/{id}', 'Logistik\Admin\PermintaanController@getUnduhPermintaan');

		//Waste Material
		Route::get('/waste', 'Logistik\Admin\WasteMaterialController@index');
		Route::get('/waste/create', 'Logistik\Admin\WasteMaterialController@beforePostWaste');
		Route::post('/waste/cekData', 'Logistik\Admin\WasteMaterialController@cekData');
		Route::post('/waste/create', 'Logistik\Admin\WasteMaterialController@postWaste');
		Route::get('/waste/ajukan/{id}', 'Logistik\Admin\WasteMaterialController@getAjukan');
		Route::delete('/waste/delete', 'Logistik\Admin\WasteMaterialController@deleteWaste');
		Route::get('/waste/pengajuan', 'Logistik\Admin\WasteMaterialController@indexPengajuan');
		Route::delete('/waste/pengajuan/delete', 'Logistik\Admin\WasteMaterialController@deleteWastePengajuan');
		Route::get('/waste/unduh/{id}', 'Logistik\Manager\WasteMaterialController@getUnduh');

	});

	//Logistik Manager
	Route::group(['prefix' => '/Logistik/manager'], function () {
		//MASTER MATERIAL
		Route::get('/material', 'Logistik\Admin\MaterialController@index');
		Route::get('/material/create', 'Logistik\Admin\MaterialController@beforePostMaterial');
		Route::post('/material/create', 'Logistik\Admin\MaterialController@postMaterial');
		Route::get('/material/edit/{id}', 'Logistik\Admin\MaterialController@getMaterialById');
		Route::post('/material/edit/{id}', 'Logistik\Admin\MaterialController@updateMaterial');
		Route::get('/material/delete/{id}', 'Logistik\Admin\MaterialController@deleteMaterial');

		//MASTER LOKASI PEKERJAAN
		Route::get('/lokasi', 'Logistik\Admin\LokasiController@index');
		Route::get('/lokasi/create', 'Logistik\Admin\LokasiController@beforePostLocation');
		Route::post('/lokasi/create', 'Logistik\Admin\LokasiController@postLocation');
		Route::get('/lokasi/edit/{id}', 'Logistik\Admin\LokasiController@getLocationById');
		Route::post('/lokasi/edit/{id}', 'Logistik\Admin\LokasiController@updateLocation');
		Route::get('/lokasi/delete/{id}', 'Logistik\Admin\LokasiController@deleteLocation');

		//MASTER JENIS PEKERJAAN
		Route::get('/jenis_pekerjaan', 'Logistik\Admin\JenisPekerjaanController@index');
		Route::get('/jenis_pekerjaan/create', 'Logistik\Admin\JenisPekerjaanController@beforePostJenis');
		Route::post('/jenis_pekerjaan/create', 'Logistik\Admin\JenisPekerjaanController@postJenis');
		Route::get('/jenis_pekerjaan/edit/{id}', 'Logistik\Admin\JenisPekerjaanController@getJenisById');
		Route::post('/jenis_pekerjaan/edit/{id}', 'Logistik\Admin\JenisPekerjaanController@updateJenis');
		Route::delete('/jenis_pekerjaan/delete', 'Logistik\Admin\JenisPekerjaanController@deleteJenis');

		//PERMINTAAN MATERIAL
		Route::get('/permintaan', 'Logistik\Manager\PermintaanController@index');
		Route::get('/permintaan/create', 'Logistik\Manager\PermintaanController@beforePostPermintaan');
		Route::post('/permintaan/create', 'Logistik\Manager\PermintaanController@postPermintaan');
		Route::get('/permintaan/detail/{id}', 'Logistik\Manager\PermintaanController@getDetailByPermintaanId');
		Route::get('/permintaan/edit/{id}', 'Logistik\Manager\PermintaanController@getPermintaanById');
		Route::post('/permintaan/edit/{id}', 'Logistik\Manager\PermintaanController@updatePermintaan');
		Route::get('/permintaan/deleteDetail/{detailId}/{permintaanId}', 'Logistik\Manager\PermintaanController@deleteDetailPermintaanMaterial');
		Route::delete('/permintaan/delete', 'Logistik\Manager\PermintaanController@deletePermintaan');
		Route::get('/permintaan/unduh/{id}', 'Logistik\Admin\PermintaanController@getUnduhPermintaan');

		//Waste Material
		Route::get('/waste', 'Logistik\Manager\WasteMaterialController@index');
		Route::get('/waste/approve/{id}', 'Logistik\Manager\WasteMaterialController@getApprove');
		Route::post('/waste/approve/{id}', 'Logistik\Manager\WasteMaterialController@postApprove');
		Route::get('/waste/unduh/{id}', 'Logistik\Manager\WasteMaterialController@getUnduh');
	});

	//Logistik PM
	Route::group(['prefix' => '/Logistik/pm'], function () {
		//PERMINTAAN MATERIAL
		Route::get('/permintaan', 'Logistik\PM\PermintaanController@index');
		Route::get('/permintaan/create', 'Logistik\PM\PermintaanController@beforePostPermintaan');
		Route::post('/permintaan/create', 'Logistik\PM\PermintaanController@postPermintaan');
		Route::get('/permintaan/detail/{id}', 'Logistik\PM\PermintaanController@getDetailByPermintaanId');
		Route::get('/permintaan/edit/{id}', 'Logistik\PM\PermintaanController@getPermintaanById');
		Route::post('/permintaan/edit/{id}', 'Logistik\PM\PermintaanController@updatePermintaan');
		Route::get('/permintaan/deleteDetail/{detailId}/{permintaanId}', 'Logistik\PM\PermintaanController@deleteDetailPermintaanMaterial');
		Route::delete('/permintaan/delete', 'Logistik\PM\PermintaanController@deletePermintaan');
		Route::get('/permintaan/unduh/{id}', 'Logistik\Admin\PermintaanController@getUnduhPermintaan');

		//Waste Material
		Route::get('/waste', 'Logistik\PM\WasteMaterialController@index');
		Route::get('/waste/approve/{id}', 'Logistik\PM\WasteMaterialController@getApprove');
		Route::post('/waste/approve/{id}', 'Logistik\PM\WasteMaterialController@postApprove');
		Route::get('/waste/unduh/{id}', 'Logistik\Manager\WasteMaterialController@getUnduh');

	});

	//arsip
		Route::get('/arsip', 'ArsipController@index');
		Route::get('/arsip/unduh/{id}', 'ArsipController@getUnduh');	

	//-------------------FORM PELATIHAN----------------------
	Route::get('/pelatihan', 'PelatihanController@index');
	Route::get('/pelatihan/create_gap', 'PelatihanController@getCreateGap');
	Route::get('/pelatihan/create_usulan', 'PelatihanController@getCreateUsulan');
	Route::get('/pelatihan/edit_usulan', 'PelatihanController@getEditUsulan');

});
