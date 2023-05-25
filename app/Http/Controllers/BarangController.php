<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Gudang;
use App\Models\Jenis_barang;
use App\Models\Lokasi;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        if (!empty($search)) {
            $barang = Barang::where('barang.nama_barang', 'like', '%' . $search . '%')
                ->paginate(5)->fragment('barang');
        } else {
            $barang = Barang::paginate(5)->fragment('barang');
        }
        $gudang = Gudang::all();
        $jenis = Jenis_barang::all();
        return view(
            'barang.barang',
            compact(['barang', 'gudang', 'jenis', 'search']),
            [
                'page_title' => 'Data Barang'
            ]
        );
    }
    public function store(Request $request)
    {
        // dd($request->except('_token','submit'));
        Barang::create($request->except('_token', 'submit'));
        return redirect()->route('barang.barang')->with('success', 'Berhasil!');
    }
    public function view($id_barang)
    {
        $barang = Barang::find($id_barang);
        return view(
            'barang.detailBarang',
            compact(['barang']),
            [
                'page_title' => 'Detail Barang'
            ]
        );
    }
    public function cetakDetail($id_barang)
    {
        $barang = Barang::find($id_barang);
        return view(
            'barang.cetakDetail',
            compact(['barang']),
            [
                'page_title' => 'STOK BARANG'
            ]
        );
    }
    public function cetak()
    {
        $barang = Barang::all();
        return view(
            'barang.cetakBarang',
            compact(['barang']),
            [
                'page_title' => 'DATA BARANG'
            ]
        );
    }
    public function update($id_barang, Request $request)
    {
        $barang = Barang::find($id_barang);
        $barang->update($request->except('_token', 'submit'));

        return redirect()->route('barang.barang')->with('update', 'Berhasil!');
    }
    public function destroy($id_barang)
    {
        $barang = Barang::find($id_barang);
        $barang->masuk()->delete();
        $barang->keluar()->delete();
        $barang->delete();

        return redirect()->route('barang.barang')->with('delete', 'Berhasil!');
    }
}
