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

Route::get('/embed', 'TestController@embed');



Route::get('/extract', function () {
    $oWatermark = new Watermark();

    $result = $oWatermark->extract(public_path('samples/source/original_coledale.gpx'), public_path('samples/output/route.gpx'));

    return view('index', ['result' => $result]);
});

Route::get('/blindextract', function () {
    $oWatermark = new Watermark();

    $result = $oWatermark->blindExtract(public_path('samples/output/route.gpx'));

    return view('index', ['result' => $result]);
});

// php comment