<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\BarangKeluar;
use App\Models\BarangMasuk;
use App\Models\Ranmor;

class DashboardController extends Controller
{
    public function index()
    {
        $jumlah_masuk_bar = [];
        for ($i = 1; $i < 13; $i++) {
            $jumlah_masuk_bar[] = BarangMasuk::whereMonth('created_at', $i)->sum('jumlah_masuk');
        }
        $jumlah_keluar_bar = [];
        for ($i = 1; $i < 13; $i++) {
            $jumlah_keluar_bar[] = BarangKeluar::whereMonth('created_at', $i)->sum('jumlah_keluar');
        }


        return view('dashboard.index', [
            'page_title' => 'Dashboard',
            'jumlah_barang' => Barang::all()->sum('jumlah'),
            'jumlah_masuk' => BarangMasuk::all()->sum("jumlah_masuk"),
            'jumlah_keluar' => BarangKeluar::all()->sum('jumlah_keluar'),
            'jumlah_ranmor' => Ranmor::all()->count(),
            'jumlah_masuk_bar' => $jumlah_masuk_bar,
            'jumlah_keluar_bar' => $jumlah_keluar_bar
        ]);
    }
}