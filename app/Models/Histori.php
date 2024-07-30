<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Histori extends Model
{
    use HasFactory;

    protected $table = 'histori';

    // The primary key is not auto-incrementing
    public $incrementing = true;

    // The primary key is of type string
    // protected $keyType = 'string';

    // Indicates if the model should be timestamped.
    public $timestamps = true;

    protected $fillable = [
        'id_histori',
        'id_perusahaan_survei',
        'kode_survei',
        'id_brs',
        'id_petugas',
        'nip',
        'keterangan',
    ];

    // Relasi satu ke banyak
    function survei(){
        return $this->hasMany(Survei::class,'kode_survei','kode_survei');
    }

    function petugas(){
        return $this->hasMany(Petugas::class,'id_petugas','id_petugas');
    }

    function perusahaan(){
        return $this->hasMany(Perusahaan::class,'id_brs','id_brs');
    }

    function pegawai(){
        return $this->hasMany(Pegawai::class,'nip','nip');
    }

    function perusahaanSurvei(){
        return $this->hasMany(PerusahaanSurvei::class,'id_perusahaan_survei','id_perusahaan_survei');
    }
}
