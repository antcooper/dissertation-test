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

Route::get('/', function () {
    $oWatermark = new Watermark();

    $result = $oWatermark->insert(public_path('samples/source/original_coledale.gpx'));

    return view('index', ['result' => $result]);
});

Route::get('/extract', function () {
    $oWatermark = new Watermark();

    $result = $oWatermark->extract(public_path('samples/source/original_coledale.gpx'), public_path('samples/output/gpsbabel_coledale.gpx'));

    return view('index', ['result' => $result]);
});
