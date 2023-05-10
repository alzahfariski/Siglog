<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index()
    {
        return view('barang.barang',[
            'page_title' => 'Data Barang'
        ]);
    }
}
