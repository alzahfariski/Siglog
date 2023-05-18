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
}
