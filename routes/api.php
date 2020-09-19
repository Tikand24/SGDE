<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::prefix('basics/')
    ->namespace('Basicos')
    ->group(function () {
        Route::get('cities', 'BasicosController@ciudades');
        Route::get('celebrant', 'BasicosController@celebrantes');
    });

Route::get('all-complements', 'Basicos\BasicosController@obtenerTodos');

Route::resource('bautismo', 'BautismosController');
Route::get('bautismo/search/pagination/{name}/{numberItems}', 'BautismosController@search');
Route::get('bautismo/pagination/{numberItems}', 'BautismosController@index');
Route::resource('confirmacion', 'ConfirmacionController');
Route::get('confirmacion/search/pagination/{name}/{numberItems}', 'ConfirmacionController@search');
Route::get('confirmacion/pagination/{numberItems}', 'ConfirmacionController@index');
Route::resource('matrimonio', 'MatrimonioController');
Route::get('matrimonio/search/pagination/{name}/{numberItems}', 'MatrimonioController@search');
Route::get('matrimonio/pagination/{numberItems}', 'MatrimonioController@index');
Route::resource('osario', 'OsarioController');
Route::get('osario/search/pagination/{name}/{numberItems}', 'OsarioController@search');
Route::get('osario/pagination/{numberItems}', 'OsarioController@index');
Route::resource('cenizario', 'CenizarioController');
Route::get('cenizario/search/pagination/{name}/{numberItems}', 'CenizarioController@search');
Route::get('cenizario/pagination/{numberItems}', 'CenizarioController@index');
