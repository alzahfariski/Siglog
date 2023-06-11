<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Lokasi;
use Illuminate\Http\Request;

class LokasiController extends Controller
{
    public function index()
    {
        $lokasi = Lokasi::all();
        return view(
            'lokasi.index',
            compact(['lokasi']),
            [
                'page_title' => 'Data Gudang'
            ]
        );
    }
    public function daftar(Request $request)
    {
        $search = $request->query('search');
        if (!empty($search)) {
            $lokasi = Lokasi::where('nama_jalan', 'like', '%' . $search . '%')
                ->orWhere('nama_gudang', 'like', '%' . $search . '%')
                ->orwhere('kategori', 'like', '%' . $search . '%')
                ->orWhere('alamat', 'like', '%' . $search . '%')
                ->latest()->paginate()->fragment('lokasi');
        } else {
            $lokasi = Lokasi::latest()->paginate(5)->fragment('lokasi');
        }
        return view(
            'lokasi.daftar',
            compact(['lokasi', 'search']),
            [
                'page_title' => 'Daftar Gudang',
            ]
        );
    }
    public function view($id_lokasi)
    {
        $lokasi = Lokasi::find($id_lokasi);
        return view(
            'lokasi.detail',
            compact(['lokasi']),
            [
                'page_title' => 'Detail Gudang'
            ]
        );
    }
    public function create()
    {
        return view(
            'lokasi.create',
            [
                'page_title' => 'Tambah Gudang'
            ]
        );
    }
    public function store(Request $request)
    {
        Lokasi::create($request->except('_token', 'submit'));
        return redirect()->route('lokasi.daftar')->with('success', 'Berhasil!');
    }
    public function update($id_lokasi, Request $request)
    {
        $lokasi = Lokasi::find($id_lokasi);
        $lokasi->update($request->except('_token', 'submit'));
        return redirect()->route('lokasi.daftar')->with('update', 'Berhasil!');
    }
    public function edit($id_lokasi)
    {
        $lokasi = Lokasi::find($id_lokasi);
        return view(
            'lokasi.update',
            compact(['lokasi']),
            [
                'page_title' => 'Edit Gudang'
            ]
        );
    }
    public function destroy($id_lokasi)
    {
        $lokasi = Lokasi::find($id_lokasi);
        $lokasi->barang()->delete();
        $lokasi->delete();

        return redirect()->route('lokasi.daftar')->with('delete', 'Berhasil!');
    }
}
