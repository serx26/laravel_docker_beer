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
Route::post('/man/save', '\App\Http\Controllers\Controller@updateManufacturer');
Route::post('/man/create', '\App\Http\Controllers\Controller@createManufacturer');
Route::post('/man/delete', '\App\Http\Controllers\Controller@deleteManufacturer');




