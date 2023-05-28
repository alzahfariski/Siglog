<?php

namespace App\Imports;

use App\Models\Ranmor;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class RanmorImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Ranmor([
            'tahun' => $row['tahun'],
            'nosin' => $row['nosin'],
            'noka' => $row['noka'],
            'nopol' => $row['nopol'],
            'bagian' => $row['bagian'],
            'kondisi' => $row['kondisi'],
            'pemakai' => $row['pemakai'],
            'id_jenisranmor' => $row['id_jenisranmor'],
        ]);
    }
}
