<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\BarangKeluar;
use App\Models\BarangMasuk;
use App\Models\User;
use Illuminate\Http\Request;

class BarangKeluarController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        if (!empty($search)) {
            $keluar = BarangKeluar::where('barang_keluar.id_keluar', 'like', '%' . $search . '%')
                ->paginate(5)->fragment('keluar');
        } else {
            $keluar = BarangKeluar::paginate(5)->fragment('keluar');
        }
        $user = User::all();
        $barang = Barang::all();
        return view(
            'barang.keluar',
            compact(['keluar', 'barang', 'user', 'search']),
            [
                'page_title' => 'Data Barang Keluar'
            ]
        );
    }
    public function store(Request $request)
    {
        // dd($request->except('_token','submit'));
        $barang = Barang::where('id_barang', $request->id_barang)->get()->first();

        $stok_lama = $barang->jumlah;
        $stok_keluar = $request->jumlah_keluar;

        $barang->update([
            'jumlah' => $stok_lama - $stok_keluar
        ]);

        BarangKeluar::create($request->except('_token', 'submit'));
        return redirect('administrator/data/keluar');
    }
    public function view($id_keluar)
    {
        $keluar = BarangKeluar::find($id_keluar);
        return view(
            'barang.detailKeluar',
            compact(['keluar']),
            [
                'page_title' => 'Detail Barang keluar'
            ]
        );
    }
    public function cetakKeluar($id_keluar)
    {
        $keluar = BarangKeluar::find($id_keluar);
        return view(
            'barang.cetakKeluar',
            compact(['keluar']),
            [
                'page_title' => 'BARANG KELUAR'
            ]
        );
    }
    public function cetak()
    {
        $keluar = BarangKeluar::all();
        return view(
            'barang.cetakBKeluar',
            compact(['keluar']),
            [
                'page_title' => 'BARANG KELUAR'
            ]
        );
    }
    public function update($id_keluar, Request $request)
    {
        $barang_update = BarangKeluar::where('id_keluar', $id_keluar)->first();
        $barang_update->update($request->all());

        $masuk = BarangMasuk::where('id_barang', $request->id_barang)->get();
        $keluar = BarangKeluar::where('id_barang', $request->id_barang)->get();
        $barang = Barang::where('id_barang', $request->id_barang)->first();

        $filtered = $masuk->map(function ($barang) {
            return $barang->jumlah_masuk;
        });
        $total_barang = 0;
        foreach ($filtered as $barang_masuk) {
            $total_barang += $barang_masuk;
        }

        $filtered = $keluar->map(function ($barang) {
            return $barang->jumlah_keluar;
        });
        $total_keluar = 0;
        foreach ($filtered as $barang_keluar) {
            $total_keluar += $barang_keluar;
        }

        $total = $total_barang - $total_keluar;

        $barang->update([
            'jumlah' => $total
        ]);
        return redirect('administrator/data/keluar');
    }
    public function destroy($id_keluar)
    {
        $keluar = BarangKeluar::find($id_keluar);
        $keluar->delete();
        return redirect('administrator/data/keluar');
    }
}
