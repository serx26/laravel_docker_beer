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

Route::get('/', '\App\Http\Controllers\Controller@index');
Route::get('/manufacturer', '\App\Http\Controllers\Controller@manufacturer_index');
Route::get('/beer', '\App\Http\Controllers\Controller@beer_index');
Route::get('/type', '\App\Http\Controllers\Controller@type_index');
Route::get('/beer_f', '\App\Http\Controllers\Controller@beer_f_index');
Route::get('/manufacturer_f', '\App\Http\Controllers\Controller@manufacturer_f_index');

Route::post('/manufacturer_e/save', '\App\Http\Controllers\Controller@updateManufacturer');
Route::post('/manufacturer_e/create', '\App\Http\Controllers\Controller@createManufacturer');
Route::post('/manufacturer_e/delete', '\App\Http\Controllers\Controller@deleteManufacturer');

Route::post('/beer_e/save', '\App\Http\Controllers\Controller@updateBeer');
Route::post('/beer_e/create', '\App\Http\Controllers\Controller@createBeer');
Route::post('/beer_e/delete', '\App\Http\Controllers\Controller@deleteBeer');

Route::post('/type_e/save', '\App\Http\Controllers\Controller@updateType');
Route::post('/type_e/create', '\App\Http\Controllers\Controller@createType');
Route::post('/type_e/delete', '\App\Http\Controllers\Controller@deleteType');

Route::get('/manufacturer/filter', '\App\Http\Controllers\Controller@filterManufacturer');



