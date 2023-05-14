<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\BarangKeluarController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GudangController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\JenisController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LokasiController;
use App\Http\Controllers\PemasokController;
use App\Http\Controllers\PermintaanController;
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

Route::get('/login', [LoginController::class, 'index']);
Route::post('/login', [LoginController::class, 'authenticate'])->name('authenticate');

Route::prefix('administrator')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    Route::prefix('data')->group(function () {
        Route::get('/barang', [BarangController::class, 'index'])->name('barang.barang');
        Route::post('/barang/store', [BarangController::class, 'store'])->name('barang.store');
        Route::get('/jenis', [JenisController::class, 'index'])->name('barang.jenis');
        Route::post('/jenis/store', [JenisController::class, 'store'])->name('jenis.store');
        Route::get('/masuk', [BarangMasukController::class, 'index'])->name('barang.masuk');
        Route::get('/keluar', [BarangKeluarController::class, 'index'])->name('barang.keluar');
    });

    Route::get('/gudang', [GudangController::class, 'index'])->name('gudang.index');
    Route::post('/gudang', [GudangController::class, 'store'])->name('gudang.store');
    Route::get('/lokasi', [LokasiController::class, 'index'])->name('lokasi.index');
    Route::get('/pemasok', [PemasokController::class, 'index'])->name('pemasok.index');
    Route::post('/pemasok', [PemasokController::class, 'store'])->name('pemasok.store');
    Route::get('/permintaan', [PermintaanController::class, 'index'])->name('permintaan.index');
    Route::get('/jadwal', [JadwalController::class, 'index'])->name('jadwal.index');
    Route::post('/jadwal/store', [JadwalController::class, 'store'])->name('jadwal.store');
});
