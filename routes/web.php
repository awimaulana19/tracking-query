<?php

use App\Http\Controllers\WilayahController;
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

Route::get('/', [WilayahController::class, 'index']);
Route::post('/tambah', [WilayahController::class, 'store']);
Route::post('/edit/{kode}', [WilayahController::class, 'update']);
Route::get('/hapus/{kode}', [WilayahController::class, 'hapus']);
Route::get('/sesibaru', [WilayahController::class, 'sesibaru']);
Route::post('/editmultiple', [WilayahController::class, 'editMultiple']);
