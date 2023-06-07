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

    public function scopeFilter($query)
    {
        if (request('id_jenisranmor') ?? false) {
            $query->join('jenis_ranmor', 'jenis_ranmor.id_jenisranmor', '=', 'ranmor.id_jenisranmor')
                ->select('ranmor.*', 'jenis_ranmor.roda')
                ->where('jenis_ranmor.roda', request('id_jenisranmor'));
        }

        return $query;
    }

    public function jenis()
    {
        return $this->belongsTo(JenisRanmor::class, 'id_jenisranmor');
    }
}
