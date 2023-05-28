<?php

namespace App\Imports;

use App\Models\Jenis_barang;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class JenisImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Jenis_barang([
            'nama_jenis' => $row['nama_jenis'],
            'nama_satuan' => $row['nama_satuan'],
        ]);
    }
}
