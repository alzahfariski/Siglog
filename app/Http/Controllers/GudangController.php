<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Gudang;
use App\Models\Lokasi;
use Illuminate\Http\Request;

class GudangController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        if (!empty($search)) {
            $gudang = Gudang::where('gudang.nama_gudang', 'like', '%' . $search . '%')
                ->paginate(5)->fragment('gudang');
        } else {
            $gudang = Gudang::paginate(5)->fragment('gudang');
        }
        $lokasi = Lokasi::all();
        return view(
            'gudang.index',
            compact(['gudang', 'lokasi', 'search']),
            [
                'page_title' => 'Data Gudang'
            ]
        );
    }
    public function store(Request $request)
    {
        // dd($request->except('_token','submit'));
        Gudang::create($request->except('_token', 'submit'));
        return redirect('administrator/gudang');
    }
    public function view($id_gudang)
    {
        $gudang = Gudang::find($id_gudang);
        return view(
            'gudang.detail',
            compact(['gudang']),
            [
                'page_title' => 'Detail gudang'
            ]
        );
    }
    public function update($id_gudang, Request $request)
    {
        $gudang = Gudang::find($id_gudang);
        $gudang->update($request->except('_token', 'submit'));
        return redirect('administrator/gudang');
    }
    public function destroy($id_gudang)
    {
        $gudang = Gudang::find($id_gudang);
        $gudang->barang()->delete();
        $gudang->delete();

        return redirect('administrator/gudang');
    }
}
