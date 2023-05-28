<?php

namespace App\Exports;

use App\Models\JenisRanmor;
use Maatwebsite\Excel\Concerns\FromCollection;

class JenisRanmorExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return JenisRanmor::all();
    }
}
