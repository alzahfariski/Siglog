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
        $barang = Barang::where('id_barang', $request->id_barang)->first();

        $stok_lama = $barang->jumlah;
        $stok_masuk = $request->jumlah_masuk;

        $barang->update([
            'jumlah' => $stok_lama + $stok_masuk
        ]);

        BarangMasuk::create($request->except('_token', 'submit'));
        return redirect('administrator/data/masuk');
    }
    public function view($id_masuk)
    {
        $masuk = BarangMasuk::find($id_masuk);
        return view(
            'barang.detailMasuk',
            compact(['masuk']),
            [
                'page_title' => 'Detail Barang Masuk'
            ]
        );
    }
    public function cetak()
    {
        $masuk = BarangMasuk::all();
        return view(
            'barang.cetakBMasuk',
            compact(['masuk']),
            [
                'page_title' => 'BARANG MASUK'
            ]
        );
    }
    public function cetakMasuk($id_masuk)
    {
        $masuk = BarangMasuk::find($id_masuk);
        return view(
            'barang.cetakMasuk',
            compact(['masuk']),
            [
                'page_title' => 'BARANG MASUK'
            ]
        );
    }
    public function update($id_masuk, Request $request)
    {

        $barang_update = BarangMasuk::where('id_masuk', $id_masuk)->first();
        $barang_update->update($request->all());

        $masuk = BarangMasuk::where('id_barang', $request->id_barang)->get();
        $barang = Barang::where('id_barang', $request->id_barang)->first();

        $filtered = $masuk->map(function ($barang) {
            return $barang->jumlah_masuk;
        });

        $total_barang = 0;

        foreach ($filtered as $barang_masuk) {
            $total_barang += $barang_masuk;
        }

        $barang->update([
            'jumlah' => $total_barang
        ]);

        return redirect('administrator/data/masuk');
    }
    public function destroy($id_masuk)
    {
        $masuk = BarangMasuk::find($id_masuk);
        $masuk->delete();
        return redirect('administrator/data/masuk');
    }
}
