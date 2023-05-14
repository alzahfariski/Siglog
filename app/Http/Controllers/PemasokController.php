<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Pemasok;
use Illuminate\Http\Request;

class PemasokController extends Controller
{
    public function index()
    {
        $pemasok = Pemasok::all();
        return view(
            'pemasok.index',
            compact(['pemasok']),
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
}
