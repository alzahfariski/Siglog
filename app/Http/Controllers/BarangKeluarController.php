<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BarangKeluarController extends Controller
{
    public function index()
    {
        return view('barang.keluar',[
            'page_title' => 'Data Barang Keluar'
        ]);
    }
}
