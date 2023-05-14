<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gudang extends Model
{
    use HasFactory;

    protected $table = 'gudang';
    protected $primaryKey = 'id_gudang';
    protected $guarded = [];

    public function lokasi()
    {
        return $this->belongsTo(Lokasi::class, 'id_lokasi');
    }
    public function barang()
    {
        return $this->hasOne(Barang::class, 'id_barang');
    }
    public function keluar()
    {
        return $this->hasOne(BarangKeluar::class, 'id_keluar');
    }
}
