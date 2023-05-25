<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisRanmor extends Model
{
    use HasFactory;
    protected $table = "jenis_ranmor";
    protected $primaryKey = 'id_jenisranmor';
    protected $guarded = [];

    public function ranmor()
    {
        return $this->hasMany(Ranmor::class, 'id_ranmor');
    }
}
