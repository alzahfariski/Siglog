<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Gudang;
use Illuminate\Http\Request;

class GudangController extends Controller
{
    public function index()
    {
        $gudang = Gudang::all();
        return view('gudang.index',
        compact(['gudang']),
        [
            'page_title' => 'Data Gudang'
        ]);
    }
}
