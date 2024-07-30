<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Survei extends Model
{
    use HasFactory;

    protected $table = 'survei';

    // The primary key is not auto-incrementing
    public $incrementing = false;

    // The primary key is of type string
    protected $keyType = 'string';

    // Indicates if the model should be timestamped.
    public $timestamps = false;

    protected $fillable = [
        'kode_survei',
        'nama_survei',
    ];

    // Relasi banyak ke satu
    function perusahaanSurvei(){
        return $this->belongsTo(PerusahaanSurvei::class,'id_survei','id_survei');
    }

    function histori(){
        return $this->belongsTo(Histori::class,'id_survei','id_survei');
    }
}
