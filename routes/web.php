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

Route::get('/register', 'AuthController@getRegister')->name('register')->middleware('guest');
Route::post('/register', 'AuthController@postRegister')->middleware('guest');

Route::get('/login', 'AuthController@getLogin')->middleware('guest')->name('login');
Route::post('/login', 'AuthController@postLogin')->middleware('guest');

Route::get('/home', 'HomeController@index')->middleware('auth')->name('home');

Route::resource('desa', 'HomeDesaController');
Route::get('/home/desa', 'HomeDesaController@showDesa')->middleware('auth')->name('homedesa');

Route::get('/logout', 'AuthController@logout')->middleware('auth')->name('logout');

Route::get('/user_table', 'UserController@index')->middleware('auth')->name('user_table');

Route::get('/tanlong_table', 'TanlongController@index')->middleware('auth')->name('tanlong_table');
Route::post('/tanlong_table/store', 'TanlongController@store');
Route::get('/get-kecamatan-list','TanlongController@getKecamatanList');
Route::get('/get-desa-list','TanlongController@getDesaList');
Route::get('/tanlong_table/edit/{id}','TanlongController@edit');
Route::post('/tanlong_table/update/{id}','TanlongController@update');
Route::get('/tanlong_table/hapus/{id}','TanlongController@hapus');

Route::get('/graph', function (){
    return view('graph');
})->middleware('auth')->name('graph');

Route::resource('/graph', 'GraphController');

