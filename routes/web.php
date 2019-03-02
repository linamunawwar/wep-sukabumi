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
Route::get('/', 'HomeController@index');

Route::get('/pegawai', 'PegawaiController@index');
Route::get('/pegawai/create', 'PegawaiController@getCreate');

Route::get('/pegawai/struktur', 'PegawaiController@getStruktur');

Route::get('/pegawai/pecat', 'PegawaiController@getPecat');
Route::get('/pegawai/pecat/create', 'PegawaiController@getCreatePecat');

Route::get('/pegawai/resign', 'PegawaiController@getResign');
Route::get('/pegawai/resign/create', 'PegawaiController@getCreateResign');

Route::get('/memo', 'MemoController@index');
