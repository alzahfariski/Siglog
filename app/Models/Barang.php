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

    public function scopeFilter($query)
    {
        if (request('id_lokasi') ?? false) {
            $query->where('id_lokasi', request('id_lokasi'));
        }

        if (request('bulan') ?? false) {
            $query->whereMonth('created_at', request('bulan'));
        }
        if (request('id_jenis') ?? false) {
            $query->where('id_jenis', request('id_jenis'));
        }
        if (request('tahun') ?? false) {
            $query->whereYear('created_at', request('tahun'));
        }

        return $query;
    }

    public function jenis()
    {
        return $this->belongsTo(Jenis_barang::class, 'id_jenis');
    }
    public function lokasi()
    {
        return $this->belongsTo(Lokasi::class, 'id_lokasi');
    }
    public function masuk()
    {
        return $this->hasMany(BarangMasuk::class, 'id_masuk');
    }
    public function keluar()
    {
        return $this->hasMany(BarangKeluar::class, 'id_keluar');
    }
}
