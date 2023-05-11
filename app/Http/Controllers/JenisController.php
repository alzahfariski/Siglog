<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class JenisController extends Controller
{
    public function index()
    {
        return view('barang.jenis',[
            'page_title' => 'Data jenis'
        ]); 
    }
}
