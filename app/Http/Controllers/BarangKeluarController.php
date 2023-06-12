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
            $keluar = BarangKeluar::join('barang', 'barang.id_barang', '=', 'barang_keluar.id_barang')
                ->join('users', 'users.id_user', '=', 'barang_keluar.id_user')
                ->select('barang_keluar.*', 'barang.nama_barang', 'users.nama')
                ->where('barang.nama_barang', 'like', '%' . $search . '%')
                ->orWhere('users.nama', 'like', '%' . $search . '%')
                ->latest()->paginate(10)->fragment('keluar');
        } else {
            $keluar = BarangKeluar::latest()->paginate(10)->fragment('keluar');
        }
        $user = User::all();
        $barang = Barang::all();

        $nama_barang = Barang::all()->groupBy('nama_barang');
        $nama_penerima = User::all()->groupBy('nama');

        $startYear = 2020;
        $endYear = date('Y');
        $years = range($startYear, $endYear);
        $bulan = ['Semua Data', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'November', 'Oktober', 'Desember'];

        return view(
            'barang.keluar',
            compact(['keluar', 'barang', 'user', 'search', 'nama_barang', 'nama_penerima', 'bulan', 'years']),
            [
                'page_title' => 'Data Penyerahann Barang'
            ]
        );
    }
    public function store(Request $request)
    {
        // dd($request->except('_token','submit'));
        $barang = Barang::where('id_barang', $request->id_barang)->get()->first();

        $stok_lama = $barang->jumlah;
        $stok_keluar = $request->jumlah_keluar;

        if ($stok_lama >= $stok_keluar) {
            $barang->update([
                'jumlah' => $stok_lama - $stok_keluar
            ]);

            BarangKeluar::create($request->except('_token', 'submit'));
            return redirect()->route('barang.keluar')->with('success', 'Berhasil!');
        }
        return redirect()->route('barang.keluar')->with('failed', 'Gagal!');
    }
    public function view($id_keluar)
    {
        $keluar = BarangKeluar::find($id_keluar);
        return view(
            'barang.detailKeluar',
            compact(['keluar']),
            [
                'page_title' => 'Detail Penyerahan Barang'
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
                'page_title' => 'PENYERAHAN BARANG'
            ]
        );
    }
    public function cetak()
    {
        $keluar = BarangKeluar::filter()->get();

        if ($keluar->count() === 0) {
            return back()->with('nope', 'Data Kosong !');
        };
        return view(
            'barang.cetakBKeluar',
            compact(['keluar']),
            [
                'page_title' => 'PENYERAHAN BARANG'
            ]
        );
    }
    public function update($id_keluar, Request $request)
    {
        $stok_sebelum = Barang::where('id_barang',  $request->id_barang)->first();
        $barang_update = BarangKeluar::where('id_keluar', $id_keluar)->first();
        $stok_fresh = $stok_sebelum->jumlah + $barang_update->jumlah_keluar;

        $stok_keluar = $request->jumlah_keluar;
        $barang = Barang::where('id_barang', $request->id_barang)->first();

        $total_barang = $stok_fresh;

        if ($total_barang >= $stok_keluar) {
            $keluar = BarangKeluar::where('id_keluar', $id_keluar)->first();
            $keluar->update($request->all());
            $total_keluar = $keluar->jumlah_keluar;
            $total = $total_barang - $total_keluar;

            $barang->update([
                'jumlah' => $total
            ]);
            return redirect()->route('barang.keluar')->with('update', 'Berhasil!');
        }

        return redirect()->route('barang.keluar')->with('failed', 'Gagal!');
    }
    public function destroy($id_keluar, Request $request)
    {
        $stok_sebelum = Barang::where('id_barang',  $request->id_barang)->first();
        $barang_update = BarangKeluar::where('id_keluar', $id_keluar)->first();
        $stok_fresh = $stok_sebelum->jumlah + $barang_update->jumlah_keluar;
        $barang = Barang::where('id_barang', $request->id_barang)->first();

        $total_barang = $stok_fresh;
        $barang->update([
            'jumlah' => $total_barang
        ]);

        $keluar = BarangKeluar::find($id_keluar);
        $keluar->delete();
        return redirect()->route('barang.keluar')->with('delete', 'Berhasil!');
    }
}
