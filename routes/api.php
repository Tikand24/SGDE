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

Route::resource('bautismo', 'Administrativos\Bautismos\BautismosController');
Route::get('bautismo/search/pagination/{name}/{numberItems}', 'Administrativos\Bautismos\BautismosController@search');
Route::get('bautismo/pagination/{numberItems}', 'Administrativos\Bautismos\BautismosController@index');
Route::resource('confirmacion', 'Administrativos\Confirmacion\ConfirmacionController');
Route::get('confirmacion/search/pagination/{name}/{numberItems}', 'Administrativos\Confirmacion\ConfirmacionController@search');
Route::get('confirmacion/pagination/{numberItems}', 'Administrativos\Confirmacion\ConfirmacionController@index');
Route::resource('matrimonio', 'Administrativos\Matrimonios\MatrimonioController');
Route::get('matrimonio/search/pagination/{name}/{numberItems}', 'Administrativos\Matrimonios\MatrimonioController@search');
Route::get('matrimonio/pagination/{numberItems}', 'Administrativos\Matrimonios\MatrimonioController@index');
Route::resource('osario', 'Administrativos\Osarios\OsarioController');
Route::get('osario/search/pagination/{name}/{numberItems}', 'Administrativos\Osarios\OsarioController@search');
Route::get('osario/pagination/{numberItems}', 'Administrativos\Osarios\OsarioController@index');
Route::resource('cenizario', 'Administrativos\Cenizarios\CenizarioController');
Route::get('cenizario/search/pagination/{name}/{numberItems}', 'Administrativos\Cenizarios\CenizarioController@search');
Route::get('cenizario/pagination/{numberItems}', 'Administrativos\Cenizarios\CenizarioController@index');
