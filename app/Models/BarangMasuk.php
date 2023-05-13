<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangMasuk extends Model
{
    use HasFactory;
    protected $table = 'barang_masuk';
    protected $primaryKey = 'id_masuk';

    public function barang()
    {
        return $this->hasOne(Barang::class, 'id_barang');
    }
    public function pemasok()
    {
        return $this->hasOne(Pemasok::class, 'id_pemasok');
    }
}
