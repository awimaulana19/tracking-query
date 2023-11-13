<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\WilayahController;

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

Route::get('/', [WilayahController::class, 'home']);
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'login_action']);
Route::get('/provinsi/{k1}', [WilayahController::class, 'provinsi']);
Route::get('/kabkota/{k2}', [WilayahController::class, 'kabkota']);
Route::get('/kecamatan/{k3}', [WilayahController::class, 'kecamatan']);
Route::get('/cari', [WilayahController::class, 'searchGuest']);

Route::group(['middleware' => ['auth']], function () {
    Route::get('/logout', [AuthController::class, 'logout']);
    Route::get('/wilayah', [WilayahController::class, 'index']);
    Route::get('/wilayah/{search}', [WilayahController::class, 'search'])->name('wilayah.search');
    Route::post('/tambah', [WilayahController::class, 'store']);
    Route::post('/edit/{kode}', [WilayahController::class, 'update']);
    Route::get('/hapus/{kode}', [WilayahController::class, 'hapus']);
    Route::get('/sesibaru', [WilayahController::class, 'sesibaru']);
    Route::post('/editmultiple', [WilayahController::class, 'editMultiple']);
    Route::post('/editselect', [WilayahController::class, 'editSelect']);
});
