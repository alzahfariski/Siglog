<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\BarangMasuk;
use App\Models\Pemasok;
use Illuminate\Http\Request;

class BarangMasukController extends Controller
{
    public function index()
    {
        $masuk = BarangMasuk::all();
        $barang = Barang::all();
        $pemasok = Pemasok::all();
        return view(
            'barang.masuk',
            compact(['masuk', 'barang', 'pemasok']),
            [
                'page_title' => 'Data Barang Masuk'
            ]
        );
    }
    public function store(Request $request)
    {
        // dd($request->except('_token','submit'));
        $barang = Barang::where('id_barang', $request->id_barang)->get()->first();

        $stok_lama = $barang->jumlah;
        $stok_masuk = $request->jumlah_masuk;

        $barang->update([
            'jumlah' => $stok_lama + $stok_masuk
        ]);

        BarangMasuk::create($request->except('_token', 'submit'));
        return redirect('administrator/data/masuk');
    }
}
