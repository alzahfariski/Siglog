<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Imports\BarangImport;
use App\Models\Barang;
use App\Models\BarangKeluar;
use App\Models\BarangMasuk;
use App\Models\Jenis_barang;
use App\Models\Lokasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class BarangController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        if (!empty($search)) {
            $barang = Barang::join('jenis_barang', 'jenis_barang.id_jenis', '=', 'barang.id_jenis')
                ->join('lokasi', 'lokasi.id_lokasi', '=', 'barang.id_lokasi')
                ->select('barang.*', 'jenis_barang.nama_jenis', 'lokasi.nama_gudang')
                ->where('jenis_barang.nama_jenis', 'like', '%' . $search . '%')
                ->orWhere('barang.nama_barang', 'like', '%' . $search . '%')
                ->orWhere('lokasi.nama_gudang', 'like', '%' . $search . '%')
                ->paginate(5)->fragment('barang');
        } else {
            $barang = Barang::paginate(5)->fragment('barang');
        }
        $lokasi = Lokasi::all();
        $jenis = Jenis_barang::all();
        return view(
            'barang.barang',
            compact(['barang', 'lokasi', 'jenis', 'search']),
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
        $masuk = BarangMasuk::where('id_barang', $id_barang)->get();
        $keluar = BarangKeluar::where('id_barang', $id_barang)->get();
        $user = Auth::user()->id_user;
        $terima = BarangKeluar::where('id_user', $user)->where('id_barang', $id_barang)->get();
        return view(
            'barang.detailBarang',
            compact(['barang', 'masuk', 'keluar', 'terima']),
            [
                'page_title' => 'Detail Barang'
            ]
        );
    }
    public function cetakDetail($id_barang)
    {
        $barang = Barang::find($id_barang);
        $masuk = BarangMasuk::where('id_barang', $id_barang)->get();
        $keluar = BarangKeluar::where('id_barang', $id_barang)->get();
        return view(
            'barang.cetakDetail',
            compact(['barang', 'masuk', 'keluar']),
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
    public function import()
    {
        Excel::import(new BarangImport, request()->file('file'));

        return back();
    }
}
