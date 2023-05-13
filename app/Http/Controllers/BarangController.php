<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index()
    {
        $barang = Barang::all();
        return view(
            'barang.barang',
            compact(['barang']),
            [
                'page_title' => 'Data Barang'
            ]
        );
    }
}
