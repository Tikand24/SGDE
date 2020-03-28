<?php

use Illuminate\Http\Request;

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

///Bautizados 
Route::get('all-baptized', 'Administrativos\BautismosController@getAll');
Route::get('baptized-by-id/{id}', 'Administrativos\BautismosController@bautizadoById');
Route::get('search-baptized/{name}', 'Administrativos\BautismosController@search');
Route::post('save-baptized', 'Administrativos\BautismosController@store');
Route::post('edit-baptized', 'Administrativos\BautismosController@update');
