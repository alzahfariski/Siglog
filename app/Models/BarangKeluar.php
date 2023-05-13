<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangKeluar extends Model
{
    use HasFactory;
    protected $table = 'barang_keluar';
    protected $primaryKey = 'id_keluar';

    public function barang()
    {
        return $this->hasOne(Barang::class, 'id_barang');
    }
    public function gudang()
    {
        return $this->hasOne(Gudang::class, 'id_gudang');
    }
}
