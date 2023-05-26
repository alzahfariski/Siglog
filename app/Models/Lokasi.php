<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lokasi extends Model
{
    use HasFactory;

    protected $table = 'lokasi';
    protected $primaryKey = 'id_lokasi';
    protected $guarded = [];

    public function gudang()
    {
        return $this->hasOne(Gudang::class, 'id_gudang');
    }
}