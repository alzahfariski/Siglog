<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BarangMasukController extends Controller
{
    public function index()
    {
        return view('barang.masuk',[
            'page_title' => 'Data Barang Masuk'
        ]);
    }
}
