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
	return view('welcome');
});

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
	Route::get('/home', 'HomeController@index')->name('home');
	Route::prefix('administracion/bautismos/')
		->namespace('Administrativos')
		->group(function () {
			Route::get('', 'BautismosController@index');
			Route::get('crear-bautismo', 'BautismosController@create');
			Route::get('partida/{id}/{firma}', 'BautismosController@reportePartida');
			Route::get('borrador/{id}/{firma}', 'BautismosController@reporteBorrador');
			Route::post('guardar-bautismo', 'BautismosController@guardar');
			Route::get('celebrantes-parroquia', 'BautismosController@celebrantesParroquia');
			Route::post('editar', 'BautismosController@edit');
			Route::post('buscar-bautizado', 'BautismosController@bautizadoPorId');
			Route::post('actualizar-bautismo-decreto', 'BautismosController@actualizarPorDecreto');
			Route::post('actualizar-bautismo-sistema', 'BautismosController@actualizarPorSistema');
		});
	Route::prefix('administracion/cenizarios/')
		->namespace('Administrativos')
		->group(function () {
			Route::get('cenizarios', 'CenizariosController@index');
			Route::get('crear-cenizario', 'CenizariosController@create');
			Route::post('guardar-cenizario', 'CenizariosController@guardar');
		});
	Route::prefix('administracion/osarios/')
		->namespace('Administrativos')
		->group(function () {
			Route::get('', 'OsariosController@index');
			Route::get('crear-osario', 'OsariosController@create');
			Route::post('guardar-osario', 'OsariosController@guardar');
		});
	Route::prefix('administracion/matrimonios/')
		->namespace('Administrativos')
		->group(function () {
			Route::get('', 'MatrimoniosController@index');
			Route::get('crear-matrimonio', 'MatrimoniosController@create');
			Route::post('guardar-matrimonio', 'MatrimoniosController@guardar');
		});
	Route::prefix('administracion/confirmaciones/')
		->namespace('Administrativos')
		->group(function () {
			Route::get('', 'ConfirmacionesController@index');
			Route::get('crear-confirmacion', 'ConfirmacionesController@create');
		});
});
