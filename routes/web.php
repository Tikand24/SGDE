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
	Route::prefix('administracion')
		->namespace('Administrativos')
		->group(function () {
			Route::get('bautismos', 'BautismosController@index');
			Route::get('crear-bautismo', 'BautismosController@create');
			Route::post('guardar-bautismo', 'BautismosController@guardar');
			Route::get('cenizarios', 'CenizariosController@index');
			Route::get('osarios', 'OsariosController@index');
			Route::get('matrimonios', 'MatrimoniosController@index');
			Route::get('confirmaciones', 'MatrimoniosController@index');
		});
});
