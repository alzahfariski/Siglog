<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Jenis_barang;
use Illuminate\Http\Request;

class JenisController extends Controller
{
    public function index()
    {
        $jenis = Jenis_barang::all();
        return view(
            'barang.jenis',
            compact(['jenis']),
            [
                'page_title' => 'Data jenis'
            ]
        );
    }
    public function store(Request $request)
    {
        // dd($request->except('_token','submit'));
        Jenis_barang::create($request->except('_token', 'submit'));
        return redirect('administrator/data/jenis');
    }
    public function update($id_jenis, Request $request)
    {
        $jenis = Jenis_barang::find($id_jenis);
        $jenis->update($request->except('_token', 'submit'));
        return redirect('administrator/data/jenis');
    }
    public function destroy($id_jenis)
    {
        $jenis = Jenis_barang::find($id_jenis);
        $jenis->barang()->delete();
        $jenis->delete();

        return redirect('administrator/data/jenis');
    }
}
