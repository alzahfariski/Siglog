<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Gudang;
use App\Models\Jenis_barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index()
    {
        $barang = Barang::all();
        $gudang = Gudang::all();
        $jenis = Jenis_barang::all();
        return view(
            'barang.barang',
            compact(['barang', 'gudang', 'jenis']),
            [
                'page_title' => 'Data Barang'
            ]
        );
    }
    public function store(Request $request)
    {
        // dd($request->except('_token','submit'));
        Barang::create($request->except('_token', 'submit'));
        return redirect('administrator/data/barang');
    }
}
