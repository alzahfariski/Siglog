<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Pemasok;
use Illuminate\Http\Request;

class PemasokController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        if (!empty($search)) {
            $pemasok = Pemasok::where('pemasok.nama_pemasok', 'like', '%' . $search . '%')
                ->paginate(5)->fragment('pemasok');
        } else {
            $pemasok = Pemasok::paginate(5)->fragment('pemasok');
        }
        return view(
            'pemasok.index',
            compact(['pemasok', 'search']),
            [
                'page_title' => 'Data pemasok'
            ]
        );
    }
    public function store(Request $request)
    {
        // dd($request->except('_token','submit'));
        Pemasok::create($request->except('_token', 'submit'));
        return redirect('administrator/pemasok');
    }
    public function update($id_pemasok, Request $request)
    {
        $pemasok = Pemasok::find($id_pemasok);
        $pemasok->update($request->except('_token', 'submit'));
        return redirect('administrator/pemasok');
    }
    public function destroy($id_pemasok)
    {
        $pemasok = Pemasok::find($id_pemasok);
        $pemasok->masuk()->delete();
        $pemasok->delete();

        return redirect('administrator/pemasok');
    }
}
