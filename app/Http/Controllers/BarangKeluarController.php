<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\BarangKeluar;
use Illuminate\Http\Request;

class BarangKeluarController extends Controller
{
    public function index()
    {
        $keluar = BarangKeluar::all();
        return view(
            'barang.keluar',
            compact(['keluar']),
            [
                'page_title' => 'Data Barang Keluar'
            ]
        );
    }
}
