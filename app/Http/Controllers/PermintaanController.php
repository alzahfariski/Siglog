<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PermintaanController extends Controller
{
    public function index()
    {
        return view('permintaan.index',[
            'page_title' => 'Data permintaan'
        ]); 
    }
}
