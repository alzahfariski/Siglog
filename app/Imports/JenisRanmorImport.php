<?php

namespace App\Imports;

use App\Models\JenisRanmor;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class JenisRanmorImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new JenisRanmor([
            'roda' => $row['roda'],
            'kendaraan' => $row['kendaraan'],
            'merek' => $row['merek'],
        ]);
    }
}
