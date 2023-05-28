<?php

namespace App\Imports;

use App\Models\Barang;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class BarangImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Barang([
            'nama_barang' => $row['nama_barang'],
            'jumlah' => $row['jumlah'],
            'id_jenis' => $row['id_jenis'],
            'id_gudang' => $row['id_gudang'],
        ]);
    }
}
