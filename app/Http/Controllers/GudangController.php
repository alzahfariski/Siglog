<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Gudang;
use App\Models\Lokasi;
use Illuminate\Http\Request;

class GudangController extends Controller
{
    public function index()
    {
        $gudang = Gudang::all();
        $lokasi = Lokasi::all();
        return view(
            'gudang.index',
            compact(['gudang', 'lokasi']),
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
}
