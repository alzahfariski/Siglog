<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\BarangKeluar;
use App\Models\BarangMasuk;
use App\Models\Ranmor;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // admin
        $jumlah_masuk_bar = [];
        for ($i = 1; $i < 13; $i++) {
            $jumlah_masuk_bar[] = BarangMasuk::whereMonth('created_at', $i)->sum('jumlah_masuk');
        }
        $jumlah_keluar_bar = [];
        for ($i = 1; $i < 13; $i++) {
            $jumlah_keluar_bar[] = BarangKeluar::whereMonth('created_at', $i)->sum('jumlah_keluar');
        }
        $jumlah_baik = Ranmor::where('kondisi', 'B')->count();
        $jumlah_rusak = Ranmor::where('kondisi', 'RR')->count();
        $jumlah_berat = Ranmor::where('kondisi', 'RB')->count();
        $kondisi = [$jumlah_baik, $jumlah_rusak, $jumlah_berat];

        // user
        $userId = Auth::id();
        $user = User::find($userId);

        return view('dashboard.index', [
            'page_title' => 'Dashboard',
            'jumlah_barang' => Barang::all()->sum('jumlah'),
            'jumlah_masuk' => BarangMasuk::all()->sum("jumlah_masuk"),
            'jumlah_keluar' => BarangKeluar::all()->sum('jumlah_keluar'),
            'jumlah_ranmor' => Ranmor::all()->count(),
            'jumlah_masuk_bar' => $jumlah_masuk_bar,
            'jumlah_keluar_bar' => $jumlah_keluar_bar,
            'kondisi' => $kondisi,
            'user' => $user,
        ]);
    }
}
