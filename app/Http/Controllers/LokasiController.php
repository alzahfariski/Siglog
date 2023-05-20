<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Lokasi;
use Illuminate\Http\Request;

class LokasiController extends Controller
{
    public function index()
    {
        return view('lokasi.index', [
            'page_title' => 'Data lokasi'
        ]);
    }
    public function daftar()
    {
        $lokasi = Lokasi::all();
        return view(
            'lokasi.daftar',
            compact(['lokasi']),
            [
                'page_title' => 'Daftar lokasi'
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
                'page_title' => 'Detail Lokasi'
            ]
        );
    }
    public function create()
    {
        return view(
            'lokasi.create',
            [
                'page_title' => 'Tambah Lokasi'
            ]
        );
    }
    public function store(Request $request)
    {
        Lokasi::create($request->except('_token', 'submit'));
        return redirect('administrator/lokasi');
    }
    public function update($id_lokasi, Request $request)
    {
        $lokasi = Lokasi::find($id_lokasi);
        $lokasi->update($request->except('_token', 'submit'));
        return redirect('administrator/lokasi');
    }
    public function edit($id_lokasi)
    {
        $lokasi = Lokasi::find($id_lokasi);
        return view(
            'lokasi.update',
            compact(['lokasi']),
            [
                'page_title' => 'Edit Lokasi'
            ]
        );
    }
    public function destroy($id_lokasi)
    {
        $lokasi = Lokasi::find($id_lokasi);
        $lokasi->gudang()->delete();
        $lokasi->delete();

        return redirect('administrator/lokasi/daftar');
    }
}
