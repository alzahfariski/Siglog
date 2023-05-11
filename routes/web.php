<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\BarangKeluarController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\JenisController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::prefix('administrator')->group(function () {
    Route::get('/dashboard', function () {        
        return view('dashboard/index');
    })->name('dashboard.index');

    Route::prefix('data')->group(function () {
        Route::get('/barang', [BarangController::class, 'index'])->name('barang.barang');
        Route::get('/jenis', [JenisController::class, 'index'])->name('barang.jenis');
        Route::get('/masuk', [BarangMasukController::class, 'index'])->name('barang.masuk');
        Route::get('/keluar', [BarangKeluarController::class, 'index'])->name('barang.keluar');
    });
});