<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\BarangKeluar;
use App\Models\BarangMasuk;
use App\Models\Permintaan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {

        return view(
            'dashboard.index',
            [
                'page_title' => 'Dashboard',
                'jumlah_barang' => Barang::all()->count(),
                'jumlah_masuk' => BarangMasuk::all()->count(),
                'jumlah_keluar' => BarangKeluar::all()->count(),
                'jumlah_permintaan' => Permintaan::all()->count()
            ]
        );
    }
}
