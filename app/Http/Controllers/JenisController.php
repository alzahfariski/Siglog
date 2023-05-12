<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Jenis_barang;
use Illuminate\Http\Request;

class JenisController extends Controller
{
    public function index()
    {
        $jenis = Jenis_barang::all();
        return view('barang.jenis',
        compact(['jenis']),[
            'page_title' => 'Data jenis'
        ]); 
    }
}
