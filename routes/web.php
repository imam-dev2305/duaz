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
    return view('home');
});

Route::prefix('konsumen')->group(function () {
    Route::get('data', 'konsumen\KonsumenController@index');
    Route::get('dataSource', 'konsumen\KonsumenController@dataSource');
    Route::post('insert', 'konsumen\KonsumenController@insert');
    Route::get('get_konsumen_id/{id}', 'konsumen\KonsumenController@getID');
    Route::post('update', 'konsumen\KonsumenController@update');
});
