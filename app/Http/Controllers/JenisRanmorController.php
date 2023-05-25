<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\JenisRanmor;
use Illuminate\Http\Request;

class JenisRanmorController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        if (!empty($search)) {
            $jenis = JenisRanmor::where('jenis_ranmor.roda', 'like', '%' . $search . '%')
                ->paginate(5)->fragment('jenisranmor');
        } else {
            $jenis = JenisRanmor::paginate(5)->fragment('jenisranor');
        }
        return view(
            'ranmor.jenis',
            compact(['jenis', 'search']),
            [
                'page_title' => 'Data jenis ranmor'
            ]
        );
    }
    public function store(Request $request)
    {
        // dd($request->except('_token','submit'));
        JenisRanmor::create($request->except('_token', 'submit'));
        return redirect('administrator/ranmor/jenis');
    }
    public function update($id_jenisranmor, Request $request)
    {
        $jenis = JenisRanmor::find($id_jenisranmor);
        $jenis->update($request->except('_token', 'submit'));
        return redirect('administrator/ranmor/jenis');
    }
    public function destroy($id_jenisranmor)
    {
        $jenis = JenisRanmor::find($id_jenisranmor);
        $jenis->ranmor()->delete();
        $jenis->delete();

        return redirect('administrator/ranmor/jenis');
    }
}
