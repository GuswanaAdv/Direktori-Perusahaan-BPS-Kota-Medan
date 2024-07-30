<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Petugas extends Model
{
    use HasFactory;

    protected $table = 'petugas';

    // The primary key is not auto-incrementing
    public $incrementing = false;

    // The primary key is of type string
    protected $keyType = 'string';

    // Indicates if the model should be timestamped.
    public $timestamps = false;

    protected $fillable = [
        'id_petugas',
        'nama_petugas',
    ];

    // Relasi banyak ke satu
    function perusahaanSurvei(){
        return $this->belongsTo(PerusahaanSurvei::class,'id_petugas','id_petugas');
    }

    function histori(){
        return $this->belongsTo(Histori::class,'id_petugas','id_petugas');
    }
}
