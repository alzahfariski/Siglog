<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\BarangKeluar;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TerimaController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user()->id_user;
        $search = $request->query('search');
        if (!empty($search)) {
            $terima = BarangKeluar::join('barang', 'barang.id_barang', '=', 'barang_keluar.id_barang')
                ->join('users', 'users.id_user', '=', 'barang_keluar.id_user')
                ->select('barang_keluar.*', 'barang.nama_barang', 'users.nama')
                ->where('users.id_user', $user)
                ->where(function ($query) use ($search) {
                    $query->where('barang.nama_barang', 'like', '%' . $search . '%')
                        ->orWhere('users.nama', 'like', '%' . $search . '%');
                })
                ->paginate(5)->fragment('keluar');
        } else {
            $terima = BarangKeluar::where('id_user', $user)->paginate(5)->fragment('keluar');
        }
        return view(
            'barang.terima',
            compact(['terima', 'search']),
            [
                'page_title' => 'Data Barang Diterima'
            ]
        );
    }
    public function view($id_keluar)
    {
        $terima = BarangKeluar::find($id_keluar);
        return view(
            'barang.detailTerima',
            compact(['terima']),
            [
                'page_title' => 'Detail Barang Diterima'
            ]
        );
    }
    public function cetakTerima($id_keluar)
    {
        $terima = BarangKeluar::find($id_keluar);
        return view(
            'barang.cetakTerima',
            compact(['terima']),
            [
                'page_title' => 'BARANG DITERIMA'
            ]
        );
    }
    public function cetak()
    {
        $user = Auth::user()->id_user;
        $terima = BarangKeluar::where('id_user', $user)->get();
        return view(
            'barang.cetakT',
            compact(['terima']),
            [
                'page_title' => 'BARANG DITERIMA'
            ]
        );
    }
}
