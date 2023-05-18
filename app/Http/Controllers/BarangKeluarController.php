<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\BarangKeluar;
use App\Models\User;
use Illuminate\Http\Request;

class BarangKeluarController extends Controller
{
    public function index()
    {
        $keluar = BarangKeluar::all();
        $user = User::all();
        $barang = Barang::all();
        return view(
            'barang.keluar',
            compact(['keluar', 'barang', 'user']),
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
}
