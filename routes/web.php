<?php

use Illuminate\Support\Facades\Route;

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
use antcooper\gpxwatermark\Watermark;

Route::get('/', 'TestController@index');
Route::get('/map', 'TestController@map');

Route::get('/embed', 'TestController@embed');

Route::get('/blindExtract', 'TestController@blindExtract');

Route::get('/nonBlindExtract', 'TestController@nonBlindExtract');