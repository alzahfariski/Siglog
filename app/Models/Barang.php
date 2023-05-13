<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barang';
    protected $primaryKey = 'id_barang';
    protected $guarded = [];


    public function jenis()
    {
        return $this->belongsTo(Jenis_barang::class, 'id_jenis');
    }
    public function gudang()
    {
        return $this->belongsTo(Gudang::class, 'id_gudang');
    }
    public function masuk()
    {
        return $this->belongsTo(BarangMasuk::class, 'id_masuk');
    }
    public function keluar()
    {
        return $this->belongsTo(BarangMasuk::class, 'id_keluar');
    }
}
