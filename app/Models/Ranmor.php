<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ranmor extends Model
{
    use HasFactory;
    protected $table = "ranmor";
    protected $primaryKey = 'id_ranmor';
    protected $guarded = [];

    public function jenis()
    {
        return $this->belongsTo(JenisRanmor::class, 'id_jenisranmor');
    }
}
