<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Imports\JenisRanmorImport;
use App\Models\JenisRanmor;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class JenisRanmorController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        if (!empty($search)) {
            $jenis = JenisRanmor::where('roda', 'like', '%' . $search . '%')
                ->orWhere('kendaraan', 'like', '%' . $search . '%')
                ->orWhere('merek', 'like', '%' . $search . '%')
                ->latest()->paginate(10)->fragment('jenisranmor');
        } else {
            $jenis = JenisRanmor::latest()->paginate(10)->fragment('jenisranor');
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
        $request->validate([
            'merek' => 'required|unique:jenis_ranmor'
        ]);
        // dd($request->except('_token','submit'));
        JenisRanmor::create($request->except('_token', 'submit'));
        return redirect()->route('ranmor.jenis')->with('success', 'Berhasil!');
    }
    public function update($id_jenisranmor, Request $request)
    {
        $jenis = JenisRanmor::find($id_jenisranmor);
        $jenis->update($request->except('_token', 'submit'));
        return redirect()->route('ranmor.jenis')->with('update', 'Berhasil!');
    }
    public function destroy($id_jenisranmor)
    {
        $jenis = JenisRanmor::find($id_jenisranmor);
        $jenis->ranmor()->delete();
        $jenis->delete();

        return redirect()->route('ranmor.jenis')->with('delete', 'Berhasil!');
    }
    public function import()
    {
        Excel::import(new JenisRanmorImport, request()->file('file'));

        return back();
    }
}
