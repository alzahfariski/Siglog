<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\BarangMasuk;
use Illuminate\Http\Request;

class BarangMasukController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        if (!empty($search)) {
            $masuk = BarangMasuk::where('barang_masuk.id_masuk', 'like', '%' . $search . '%')
                ->paginate(5)->fragment('masuk');
        } else {
            $masuk = BarangMasuk::paginate(5)->fragment('masuk');
        }
        $barang = Barang::all();
        return view(
            'barang.masuk',
            compact(['masuk', 'barang', 'search']),
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
        return redirect()->route('barang.masuk')->with('success', 'Berhasil!');
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

        $stok_sebelum = Barang::where('id_barang',  $request->id_barang)->first();
        $barang_update = BarangMasuk::where('id_masuk', $id_masuk)->first();
        $stok_fresh = $stok_sebelum->jumlah - $barang_update->jumlah_masuk;

        $masuk = BarangMasuk::where('id_masuk', $id_masuk)->first();
        $masuk->update($request->all());
        $barang = Barang::where('id_barang', $request->id_barang)->first();

        $total_barang = $stok_fresh + $masuk->jumlah_masuk;

        $barang->update([
            'jumlah' => $total_barang
        ]);

        return redirect()->route('barang.masuk')->with('update', 'Berhasil!');
    }
    public function destroy($id_masuk)
    {
        $masuk = BarangMasuk::find($id_masuk);
        $masuk->delete();
        return redirect()->route('barang.masuk')->with('delete', 'Berhasil!');
    }
}
