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

	//-----------------------PEGAWAI USER-------------------------
	Route::get('/pegawai/user', 'PegawaiController@indexUser');

	Route::get('/pegawai/user/struktur', 'PegawaiController@getStrukturUser');

	Route::get('/pegawai/user/resign', 'PegawaiController@getResignUser');

	//---------------------end of Pegawai User----------------------

	Route::get('/cuti', 'CutiController@index');
	Route::get('/cuti/create', 'CutiController@getCreate');

	//----------------------Cuti User ------------------
	Route::get('/user/cuti', 'CutiController@indexUser');
	Route::get('/user/cuti/create', 'CutiController@getCreateUser');
	Route::get('/user/serah_tugas', 'CutiController@getSerahTugas');
	//----------------------------end of cuti user---------------

	Route::get('/izin', 'IzinController@index');
	Route::get('/izin/create', 'IzinController@getCreate');

	//----------------------Cuti User ------------------
	Route::get('/user/izin', 'IzinController@indexUser');
	Route::get('/user/izin/create', 'IzinController@getCreateUser');
	//----------------------------end of cuti user---------------

	Route::get('/gaji', 'GajiController@index');
	Route::get('/gaji/create', 'GajiController@getCreate');
	Route::get('/gaji/list_transfer', 'GajiController@getListTransfer');

	//------------------------------GAJI USER-----------------------------------
	Route::get('/user/gaji', 'GajiController@indexUser');
	Route::get('/user/gaji/slip_gaji', 'GajiController@slipGaji');
	Route::get('/user/gaji/slip_gaji/create', 'GajiController@slipGajiCreate');

	//-------------------------------END OF GAJI USER---------------------------

	Route::get('/memo', 'MemoController@index');
});
