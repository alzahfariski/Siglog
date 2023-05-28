<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\BarangKeluarController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GudangController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\JenisController;
use App\Http\Controllers\JenisRanmorController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LokasiController;
use App\Http\Controllers\RanmorController;
use App\Http\Controllers\TerimaController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\IsAdmin;
use App\Models\Ranmor;
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
    Route::get('/forgotpw', [LoginController::class, 'forgotpw'])->name('forgotpw');
    Route::post('/forgotpw/send', [LoginController::class, 'sendResetLink'])->name('forgot.password.link');
    Route::get('/forgotpw/send/{token}', [LoginController::class, 'showResetForm'])->name('reset.password.form');
    Route::post('/forgotpw/reset', [LoginController::class, 'resetPassword'])->name('reset.password');
});

Route::middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::prefix('administrator')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

        Route::prefix('data')->group(function () {
            Route::get('/barang', [BarangController::class, 'index'])->name('barang.barang');
            Route::get('/barang/cetak', [BarangController::class, 'cetak'])->name('barang.cetak');
            Route::get('/barang/{id_barang}/view', [BarangController::class, 'view'])->name('barang.view');
            Route::get('/barang/{id_barang}/view/cetak', [BarangController::class, 'cetakDetail'])->name('barang.cetakDetail');

            Route::middleware('personel')->group(function () {
                Route::get('/terima', [TerimaController::class, 'index'])->name('barang.terima');
                Route::get('/terima/{id_keluar}/view', [TerimaController::class, 'view'])->name('terima.view');
                Route::get('/terima/{id_keluar}/view/cetak', [TerimaController::class, 'cetakTerima'])->name('terima.cetakTerima');
                Route::get('/terima/cetak', [TerimaController::class, 'cetak'])->name('terima.cetak');
            });

            Route::middleware('admin')->group(function () {
                Route::post('/barang/store', [BarangController::class, 'store'])->name('barang.store');
                Route::put('/barang/{id_barang}', [BarangController::class, 'update'])->name('barang.update');
                Route::delete('/barang/{id_barang}', [BarangController::class, 'destroy'])->name('barang.destroy');
                Route::get('/jenis', [JenisController::class, 'index'])->name('barang.jenis');
                Route::put('/jenis/{id_jenis}', [JenisController::class, 'update'])->name('jenis.update');
                Route::delete('/jenis/{id_jenis}', [JenisController::class, 'destroy'])->name('jenis.destroy');
                Route::post('/jenis/store', [JenisController::class, 'store'])->name('jenis.store');
                Route::get('/masuk', [BarangMasukController::class, 'index'])->name('barang.masuk');
                Route::get('/masuk/cetak', [BarangMasukController::class, 'cetak'])->name('masuk.cetak');
                Route::put('/masuk/{id_masuk}', [BarangMasukController::class, 'update'])->name('masuk.update');
                Route::delete('/masuk/{id_masuk}', [BarangMasukController::class, 'destroy'])->name('masuk.destroy');
                Route::get('/masuk/{id_masuk}/view', [BarangMasukController::class, 'view'])->name('masuk.view');
                Route::get('/masuk/{id_masuk}/view/cetak', [BarangMasukController::class, 'cetakMasuk'])->name('masuk.cetakMasuk');
                Route::post('/masuk/store', [BarangMasukController::class, 'store'])->name('masuk.store');
                Route::get('/keluar', [BarangKeluarController::class, 'index'])->name('barang.keluar');
                Route::get('/keluar/cetak', [BarangKeluarController::class, 'cetak'])->name('keluar.cetak');
                Route::put('/keluar/{id_keluar}', [BarangKeluarController::class, 'update'])->name('keluar.update');
                Route::delete('/keluar/{id_keluar}', [BarangKeluarController::class, 'destroy'])->name('keluar.destroy');
                Route::get('/keluar/{id_keluar}/view', [BarangKeluarController::class, 'view'])->name('keluar.view');
                Route::post('/keluar/store', [BarangKeluarController::class, 'store'])->name('keluar.store');
                Route::get('/keluar/{id_keluar}/view/cetak', [BarangKeluarController::class, 'cetakKeluar'])->name('keluar.cetakKeluar');
            });
        });
        Route::middleware('admin')->group(function () {
            Route::get('/user', [UserController::class, 'index'])->name('user.index');
            Route::post('/user', [UserController::class, 'store'])->name('user.store');
            Route::put('/user/{id_user}', [UserController::class, 'update'])->name('user.update');
            Route::delete('/user/{id_user}', [UserController::class, 'destroy'])->name('user.destroy');
            Route::post('/gudang', [GudangController::class, 'store'])->name('gudang.store');
            Route::put('/gudang/{id_gudang}', [GudangController::class, 'update'])->name('gudang.update');
            Route::delete('/gudang/{id_gudang}', [GudangController::class, 'destroy'])->name('gudang.destroy');
            Route::delete('/lokasi/daftar/{id_lokasi}', [LokasiController::class, 'destroy'])->name('lokasi.destroy');
            Route::get('/lokasi/tambah', [LokasiController::class, 'create'])->name('lokasi.create');
            Route::post('/lokasi/tambah/store', [LokasiController::class, 'store'])->name('lokasi.store');
            Route::get('/lokasi/daftar/{id_lokasi}/edit', [LokasiController::class, 'edit'])->name('lokasi.edit');
            Route::put('/lokasi/daftar/{id_lokasi}', [LokasiController::class, 'update'])->name('lokasi.update');
            Route::get('/ranmor/jenis', [JenisRanmorController::class, 'index'])->name('ranmor.jenis');
            Route::post('/ranmor/jenis/store', [JenisRanmorController::class, 'store'])->name('jenisranmor.store');
            Route::put('/ranmor/jenis/{id_jenisranmor}', [JenisRanmorController::class, 'update'])->name('jenisranmor.update');
            Route::delete('/ranmor/jenis/{id_jenisranmor}', [JenisRanmorController::class, 'destroy'])->name('jenisranmor.destroy');
        });

        Route::get('/ranmor/data/{id_ranmor}/view', [RanmorController::class, 'view'])->name('ranmor.view');
        Route::get('/ranmor/data/', [RanmorController::class, 'index'])->name('ranmor.index');
        Route::post('/ranmor/data/store', [RanmorController::class, 'store'])->name('ranmor.store');
        Route::put('/ranmor/data/{id_ranmor}', [RanmorController::class, 'update'])->name('ranmor.update');
        Route::delete('/ranmor/data/{id_ranmor}', [RanmorController::class, 'destroy'])->name('ranmor.destroy');
        Route::get('/ranmor/data/cetak', [RanmorController::class, 'cetak'])->name('ranmor.cetak');
        Route::get('/ranmor/data/{id_barang}/view/cetak', [RanmorController::class, 'cetakdetail'])->name('ranmor.cetakdetail');

        Route::post('jenisranmor-import', [JenisRanmorController::class, 'import'])->name('jenisranmor.import');

        Route::get('/gudang', [GudangController::class, 'index'])->name('gudang.index');
        Route::get('/gudang/{id_gudang}/view', [GudangController::class, 'view'])->name('gudang.view');
        Route::get('/lokasi', [LokasiController::class, 'index'])->name('lokasi.index');
        Route::get('/lokasi/{id_lokasi}/view', [LokasiController::class, 'view'])->name('lokasi.view');
        Route::get('/lokasi/daftar', [LokasiController::class, 'daftar'])->name('lokasi.daftar');
    });
});
