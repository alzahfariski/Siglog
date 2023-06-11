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
                ->latest()->paginate(5)->fragment('barang');
        } else {
            $barang = Barang::latest()->paginate(5)->fragment('barang');
        }
        $bulan = ['Semua Data', 'januari', 'februari', 'maret', 'april', 'mei', 'juni', 'juli', 'agustus', 'september', 'november', 'oktober', 'desember'];
        $lokasi = Lokasi::all();
        $jenis = Jenis_barang::all();
        $nama_jenis = Jenis_barang::pluck('nama_jenis', 'id_jenis');
        $nama_gudang = Lokasi::pluck('nama_gudang', 'id_lokasi');
        return view(
            'barang.barang',
            compact(['barang', 'lokasi', 'jenis', 'search', 'nama_gudang', 'bulan', 'nama_jenis']),
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
        $barang = Barang::filter()->get();

        if ($barang->count() === 0) {
            return redirect()->back()->with('nope', 'Data Kosong !');
        }

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
