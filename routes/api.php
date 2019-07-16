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
Route::post('/login', 'AuthController@apiLogin');

Route::get('/showArea', 'HomeDesaController@showDesa')->name('homedesa');
Route::get('/showPoint', 'HomeController@showPoint')->name('home');

Route::get('/getDisasterData', 'GraphController@getData')->name('getDisasterData');
Route::get('/getMapDisasterData/{id}', 'GraphController@getPemetaan');
Route::get('/getMapDesaData', 'GraphController@getDesa');

Route::get('/tanlong_table', 'TanlongController@index');
Route::get('/get-kecamatan-list','TanlongController@getKecamatanList');
Route::get('/get-desa-list','TanlongController@getDesaList');
Route::post('/get-tanlong-desa-list','TanlongController@showDesa');
Route::get('/get-tanlong-kecamatan-list','TanlongController@showKecamatan');
Route::get('/tanlong_table/edit/{id}','TanlongController@edit');




