<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;

    protected $table = 'pegawai';

    // The primary key is not auto-incrementing
    public $incrementing = false;

    // The primary key is of type string
    protected $keyType = 'string';

    // Indicates if the model should be timestamped.
    public $timestamps = false;

    protected $fillable = [
        'nip',
        'nama_pegawai',
    ];

    // Relasi banyak ke satu
    function histori(){
        return $this->belongsTo(Histori::class,'nip','nip');
    }

    function perusahaan_survei(){
        return $this->belongsTo(PerusahaanSurvei::class,'nip','nip');
    }
}
