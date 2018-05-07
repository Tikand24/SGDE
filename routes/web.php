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
Route::get('/horario-eucaristias/{dia}', 'HomeController@horarioSemanal');
Route::post('/registrar-feligres','HomeController@guardarFeligres');
Route::post('/registrar-mensaje-feligres','HomeController@guardarMensajeFeligres');

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
			Route::post('eliminar-anotacion', 'BautismosController@eliminarAnotacion');
		});
	Route::prefix('administracion/cenizarios/')
		->namespace('Administrativos')
		->group(function () {
			Route::get('', 'CenizariosController@index');
			Route::get('crear-cenizario', 'CenizariosController@create');
			Route::post('guardar-cenizario', 'CenizariosController@guardar');
			Route::post('validar-numero-cenizario', 'CenizariosController@validarNumeroCenizario');
			Route::post('guardar-cenizario', 'CenizariosController@guardar');
			Route::post('editar', 'CenizariosController@edit');
			Route::post('cenizario-editar', 'CenizariosController@datosCenizario');
			Route::post('actualizar-cenizario', 'CenizariosController@actualizarCenizario');
			Route::get('titulo/{id}/{firma}', 'CenizariosController@generarTitulo');
		});
	Route::prefix('administracion/osarios/')
		->namespace('Administrativos')
		->group(function () {
			Route::get('', 'OsariosController@index');
			Route::get('crear-osario', 'OsariosController@create');
			Route::get('complementos', 'OsariosController@complementos');
			Route::get('titulo/{id}/{firma}', 'OsariosController@generarTitulo');
			Route::post('guardar-osario', 'OsariosController@guardar');
			Route::post('validar-numero-osario', 'OsariosController@validarNumeroOsario');
			Route::post('editar', 'OsariosController@edit');
			Route::post('osario-editar', 'OsariosController@datosOsario');
			Route::post('actualizar-osario', 'OsariosController@actualizarOsario');
			
		});
	Route::prefix('administracion/matrimonios/')
		->namespace('Administrativos')
		->group(function () {
			Route::get('', 'MatrimoniosController@index');
			Route::get('crear-matrimonio', 'MatrimoniosController@create');
			Route::get('complementos-create', 'MatrimoniosController@complementosCreate');
			Route::post('editar', 'MatrimoniosController@edit');
			Route::post('guardar-matrimonio', 'MatrimoniosController@guardar');
			Route::post('matrimonio-editar', 'MatrimoniosController@datosEditar');
			Route::post('actualizar-matrimonio', 'MatrimoniosController@actualizarMatrimonio');		
			Route::post('eliminar-anotacion', 'MatrimoniosController@eliminarAnotacion');
			Route::get('partida/{id}/{firma}', 'MatrimoniosController@reportePartida');	
		});
	Route::prefix('administracion/confirmaciones/')
		->namespace('Administrativos')
		->group(function () {
			Route::get('', 'ConfirmacionesController@index');
			Route::get('crear-confirmacion', 'ConfirmacionesController@create');
			Route::get('complementos', 'ConfirmacionesController@complementosCreate');
			Route::post('buscar-grupo-confirmacion', 'ConfirmacionesController@buscarGrupoConfirmacion');
			Route::post('guardar-confirmacion', 'ConfirmacionesController@guardar');
			Route::post('editar', 'ConfirmacionesController@edit');
			Route::post('confirmado-editar', 'ConfirmacionesController@confirmadoEditar');
			Route::post('actualizar-confirmacion', 'ConfirmacionesController@updated');
			Route::post('eliminar-anotacion', 'ConfirmacionesController@eliminarAnotacion');
			Route::get('partida/{id}/{firma}', 'ConfirmacionesController@reportePartida');
		});
});
