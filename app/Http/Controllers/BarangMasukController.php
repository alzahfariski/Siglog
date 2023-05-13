<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\BarangMasuk;
use Illuminate\Http\Request;

class BarangMasukController extends Controller
{
    public function index()
    {
        $masuk = BarangMasuk::all();
        return view(
            'barang.masuk',
            compact(['masuk']),
            [
                'page_title' => 'Data Barang Masuk'
            ]
        );
    }
}
