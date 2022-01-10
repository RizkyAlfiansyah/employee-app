<?php

use App\Http\Controllers\CrudController;
use Illuminate\Support\Facades\Http;
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

Route::get('/', function () {
    return view('index');
});

Route::get('/gaji', function () {
    return view('salary');
});

Route::get('/test', function () {
    $client = Http::dd()->get("https://api.kawalcorona.com/indonesia");
});

Route::get('/pegawai', [CrudController::class, 'index']);

