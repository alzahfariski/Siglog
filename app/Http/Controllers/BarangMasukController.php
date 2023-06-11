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
            $masuk = BarangMasuk::join('barang', 'barang.id_barang', '=', 'barang_masuk.id_barang')
                ->select('barang_masuk.*', 'barang.nama_barang')
                ->where('barang.nama_barang', 'like', '%' . $search . '%')
                ->orWhere('barang_masuk.pemasok', 'like', '%' . $search . '%')
                ->latest()->paginate(5)->fragment('masuk');
        } else {
            $masuk = BarangMasuk::latest()->paginate(5)->fragment('masuk');
        }
        $barang = Barang::all();

        $nama_pemasok = BarangMasuk::all()->groupBy('pemasok');
        $nama_barang = Barang::all()->groupBy('nama_barang');

        return view(
            'barang.masuk',
            compact(['masuk', 'barang', 'search', 'nama_pemasok', 'nama_barang']),
            [
                'page_title' => 'Data Barang Diterima'
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
                'page_title' => 'Detail Barang Diterima'
            ]
        );
    }
    public function cetak()
    {
        $masuk = BarangMasuk::filter()->get();

        if ($masuk->count() === 0) {
            return back()->with('nope', 'Data Kosong !');
        };
        return view(
            'barang.cetakBMasuk',
            compact(['masuk']),
            [
                'page_title' => 'BARANG DITERIMA'
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
                'page_title' => 'BARANG DITERIMA'
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
    public function destroy($id_masuk, Request $request)
    {
        $stok_sebelum = Barang::where('id_barang',  $request->id_barang)->first();
        $barang_update = BarangMasuk::where('id_masuk', $id_masuk)->first();
        $stok_fresh = $stok_sebelum->jumlah - $barang_update->jumlah_masuk;

        $barang = Barang::where('id_barang', $request->id_barang)->first();
        $total_barang = $stok_fresh;
        if ($total_barang < 0) {
            return redirect()->route('barang.masuk')->with('failed', 'Gagal!');
        } else {
            $barang->update([
                'jumlah' => $total_barang
            ]);
            $masuk = BarangMasuk::find($id_masuk);
            $masuk->delete();
            return redirect()->route('barang.masuk')->with('delete', 'Berhasil!');
        }
    }
}
