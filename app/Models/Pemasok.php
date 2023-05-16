<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemasok extends Model
{
    use HasFactory;
    protected $table = 'pemasok';
    protected $primaryKey = 'id_pemasok';
    protected $guarded = [];

    public function masuk()
    {
        return $this->hasMany(BarangMasuk::class, 'id_masuk');
    }
}
