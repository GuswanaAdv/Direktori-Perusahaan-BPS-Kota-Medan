<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerusahaanKegiatan extends Model
{
    use HasFactory;

    protected $table = 'perusahaan_kegiatan';

    // The primary key is not auto-incrementing
    public $incrementing = true;

    // The primary key is of type string
    // protected $keyType = 'string';

    // Indicates if the model should be timestamped.
    public $timestamps = false;

    protected $fillable = [
        'id_perusahaan_kegiatan',
        'kode_kegiatan',
        'id_sbr',
        'id_petugas',
        'nip',
        'aktivitas',
        'hari_tanggal',
        'keterangan',
    ];

    // Relasi satu ke banyak
    function kegiatanStatistik(){
        return $this->hasMany(KegiatanStatistik::class,'kode_kegiatan','kode_kegiatan');
    }

    function petugas(){
        return $this->hasMany(Petugas::class,'id_petugas','id_petugas');
    }

    function perusahaan(){
        return $this->hasMany(Perusahaan::class,'id_sbr','id_sbr');
    }

    function pegawai(){
        return $this->hasMany(Pegawai::class,'nip','nip');
    }

    // Relasi banyak ke satu
    function histori(){
        return $this->belongsTo(Histori::class,'id_perusahaan_kegiatan','id_perusahaan_kegiatan');
    }
}
