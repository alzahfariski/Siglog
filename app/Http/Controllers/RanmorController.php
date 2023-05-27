<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\JenisRanmor;
use App\Models\Ranmor;
use App\Models\User;
use Illuminate\Http\Request;

class RanmorController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        if (!empty($search)) {
            $ranmor = Ranmor::where('tahun', 'like', '%' . $search . '%')
                ->orWhere('nosin', 'LIKE', '%' . $search . '%')
                ->orWhere('bagian', 'LIKE', '%' . $search . '%')
                ->paginate(5)->fragment('ranmor');
        } else {
            $ranmor = Ranmor::paginate(5)->fragment('ranmor');
        }
        $jenis = JenisRanmor::all();
        $user = User::all();
        return view(
            'ranmor.index',
            compact(['ranmor', 'jenis', 'search', 'user']),
            [
                'page_title' => 'Data Ranmor'
            ]
        );
    }
    public function store(Request $request)
    {
        // dd($request->except('_token','submit'));
        Ranmor::create($request->except('_token', 'submit'));
        return redirect()->route('ranmor.index')->with('success', 'Berhasil!');
    }
    public function update($id_ranmor, Request $request)
    {
        $jenis = Ranmor::find($id_ranmor);
        $jenis->update($request->except('_token', 'submit'));
        return redirect()->route('ranmor.index')->with('update', 'Berhasil!');
    }
    public function destroy($id_ranmor)
    {
        $ranmor = Ranmor::find($id_ranmor);
        $ranmor->delete();

        return redirect()->route('ranmor.index')->with('delete', 'Berhasil!');
    }
    public function view($id_ranmor)
    {
        $ranmor = Ranmor::find($id_ranmor);
        return view(
            'ranmor.detail',
            compact(['ranmor']),
            [
                'page_title' => 'Detail Ramor'
            ]
        );
    }
    public function cetak()
    {
        $ranmor = Ranmor::all();

        $pj1 = null;
        $pj2 = null;

        if (request('pj_1')) {
            $pj1 = User::where('id_user', request('pj_1'))->first();
        }
        if (request('pj_2')) {
            $pj2 = User::where('id_user', request('pj_2'))->first();
        }

        return view(
            'ranmor.cetak',
            compact(['ranmor', 'pj1', 'pj2']),
            [
                'page_title' => 'Cetak'
            ]
        );
    }
    public function cetakdetail($id_ranmor)
    {
        $ranmor = Ranmor::find($id_ranmor);
        return view(
            'ranmor.cetakdetail',
            compact(['ranmor']),
            [
                'page_title' => 'cetak'
            ]
        );
    }
}
