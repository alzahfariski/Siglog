<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GudangController extends Controller
{
    public function index()
    {
        return view('gudang.index',[
            'page_title' => 'Data Gudang'
        ]);
    }
}
