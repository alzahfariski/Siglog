<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\JenisRanmor;
use App\Models\Ranmor;
use Illuminate\Http\Request;

class RanmorController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        if (!empty($search)) {
            $ranmor = Ranmor::where('ranmor.tahun', 'like', '%' . $search . '%')
                ->paginate(5)->fragment('ranmor');
        } else {
            $ranmor = Ranmor::paginate(5)->fragment('ranmor');
        }
        $jenis = JenisRanmor::all();
        return view(
            'ranmor.index',
            compact(['ranmor', 'jenis', 'search']),
            [
                'page_title' => 'Data Ranmor'
            ]
        );
    }
    public function store(Request $request)
    {
        // dd($request->except('_token','submit'));
        Ranmor::create($request->except('_token', 'submit'));
        return redirect('administrator/ranmor/data');
    }
    public function update($id_ranmor, Request $request)
    {
        $jenis = Ranmor::find($id_ranmor);
        $jenis->update($request->except('_token', 'submit'));
        return redirect('administrator/ranmor/data');
    }
    public function destroy($id_ranmor)
    {
        $ranmor = Ranmor::find($id_ranmor);
        $ranmor->delete();

        return redirect('administrator/ranmor/data');
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
}
