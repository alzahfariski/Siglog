<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    public function index()
    {
        $jadwal = Jadwal::all();
        return view(
            'jadwal.index',
            compact(['jadwal']),
            [
                'page_title' => 'Data jadwal'
            ]
        );
    }
    public function store(Request $request)
    {
        Jadwal::create($request->except('_token', 'submit'));
        return redirect('administrator/jadwal');
    }
    public function view($id_jadwal)
    {
        $jadwal = Jadwal::find($id_jadwal);
        return view(
            'jadwal.detail',
            compact(['jadwal']),
            [
                'page_title' => 'Detail jadwal'
            ]
        );
    }
    public function kalender()
    {
        return view(
            'jadwal.kalender',
            [
                'page_title' => 'kalender jadwal'
            ]
        );
    }
}
