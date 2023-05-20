<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jenis_barang extends Model
{
    use HasFactory;
    protected $table = "jenis_barang";
    protected $primaryKey = 'id_jenis';
    protected $guarded = [];

    public function barang()
    {
        return $this->hasMany(Barang::class, 'id_barang');
    }
}
