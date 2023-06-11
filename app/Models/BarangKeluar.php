<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangKeluar extends Model
{
    use HasFactory;
    protected $table = 'barang_keluar';
    protected $primaryKey = 'id_keluar';
    protected $guarded = [];

    public function scopeFilter($query)
    {
        if (request('id_user') ?? false) {
            $query->join('users', 'users.id_user', '=', 'barang_keluar.id_user')
                ->select('barang_keluar.*', 'users.nama')
                ->where('users.nama', request('id_user'));
        }
        if (request('id_barang') ?? false) {
            $query->join('barang', 'barang.id_barang', '=', 'barang_keluar.id_barang')
                ->select('barang_keluar.*', 'barang.nama_barang')
                ->where('barang.nama_barang', request('id_barang'));
        }

        return $query;
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
