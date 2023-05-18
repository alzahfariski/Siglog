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
use App\Http\Controllers\UserController;
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

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'authenticate'])->name('authenticate');
});

// Route::middleware('auth')->group(function () {
Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
Route::prefix('administrator')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    Route::prefix('data')->group(function () {
        Route::get('/barang', [BarangController::class, 'index'])->name('barang.barang');
        Route::get('/barang/{id_barang}/view', [BarangController::class, 'view'])->name('barang.view');
        Route::get('/barang/{id_barang}/view/cetak', [BarangController::class, 'cetakDetail'])->name('barang.cetakDetail');
        Route::post('/barang/store', [BarangController::class, 'store'])->name('barang.store');
        Route::put('/barang/{id_barang}', [BarangController::class, 'update'])->name('barang.update');
        Route::get('/jenis', [JenisController::class, 'index'])->name('barang.jenis');
        Route::put('/jenis/{id_jenis}', [JenisController::class, 'update'])->name('jenis.update');
        Route::post('/jenis/store', [JenisController::class, 'store'])->name('jenis.store');
        Route::get('/masuk', [BarangMasukController::class, 'index'])->name('barang.masuk');
        Route::get('/masuk/{id_masuk}/view', [BarangMasukController::class, 'view'])->name('masuk.view');
        Route::get('/masuk/{id_masuk}/view/cetak', [BarangMasukController::class, 'cetakMasuk'])->name('masuk.cetakMasuk');
        Route::post('/masuk/store', [BarangMasukController::class, 'store'])->name('masuk.store');
        Route::get('/keluar', [BarangKeluarController::class, 'index'])->name('barang.keluar');
        Route::get('/keluar/{id_keluar}/view', [BarangKeluarController::class, 'view'])->name('keluar.view');
        Route::get('/keluar/{id_keluar}/view/cetak', [BarangKeluarController::class, 'cetakKeluar'])->name('keluar.cetakKeluar');
        Route::post('/keluar/store', [BarangKeluarController::class, 'store'])->name('keluar.store');
    });

    Route::get('/gudang', [GudangController::class, 'index'])->name('gudang.index');
    Route::post('/gudang', [GudangController::class, 'store'])->name('gudang.store');
    Route::get('/gudang/{id_gudang}/view', [GudangController::class, 'view'])->name('gudang.view');
    Route::get('/lokasi', [LokasiController::class, 'index'])->name('lokasi.index');
    Route::get('/lokasi/tambah', [LokasiController::class, 'create'])->name('lokasi.create');
    Route::post('/lokasi/tambah/store', [LokasiController::class, 'store'])->name('lokasi.store');
    Route::get('/lokasi/{id_lokasi}/view', [LokasiController::class, 'view'])->name('lokasi.view');
    Route::get('/lokasi/daftar', [LokasiController::class, 'daftar'])->name('lokasi.daftar');
    Route::get('/pemasok', [PemasokController::class, 'index'])->name('pemasok.index');
    Route::post('/pemasok', [PemasokController::class, 'store'])->name('pemasok.store');
    Route::get('/permintaan', [PermintaanController::class, 'index'])->name('permintaan.index');
    Route::get('/jadwal', [JadwalController::class, 'index'])->name('jadwal.index');
    Route::get('/jadwal/kalender', [JadwalController::class, 'kalender'])->name('jadwal.kalender');
    Route::get('/jadwal/{id_jadwal}/view', [JadwalController::class, 'view'])->name('jadwal.view');
    Route::get('/jadwal/{id_jadwal}/view/cetak', [JadwalController::class, 'cetak'])->name('jadwal.cetak');
    Route::post('/jadwal/store', [JadwalController::class, 'store'])->name('jadwal.store');
    Route::get('/user', [UserController::class, 'index'])->name('user.index');
});
// });
