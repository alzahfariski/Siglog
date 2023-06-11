<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangMasuk extends Model
{
    use HasFactory;
    protected $table = 'barang_masuk';
    protected $primaryKey = 'id_masuk';
    protected $guarded = [];

    public function scopeFilter($query)
    {
        if (request('pemasok') ?? false) {
            $query->where('barang_masuk.pemasok', request('pemasok'));
        }
        if (request('id_barang') ?? false) {
            $query->join('barang', 'barang.id_barang', '=', 'barang_masuk.id_barang')
                ->select('barang_masuk.*', 'barang.nama_barang')
                ->where('barang.nama_barang', request('id_barang'));
        }

        return $query;
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang');
    }
}
