<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Jenis_barang;
use Illuminate\Http\Request;

class JenisController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        if (!empty($search)) {
            $jenis = Jenis_barang::where('jenis_barang.nama_jenis', 'like', '%' . $search . '%')
                ->paginate(5)->fragment('jenis');
        } else {
            $jenis = Jenis_barang::paginate(5)->fragment('jenis');
        }
        return view(
            'barang.jenis',
            compact(['jenis', 'search']),
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
