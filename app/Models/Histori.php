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
        'kode_kegiatan',
        'id_sbr',
        'id_petugas',
        'nip',
        'keterangan',
    ];

    // Relasi satu ke banyak
    function kegiatanStatistik(){
        return $this->belongsTo(KegiatanStatistik::class,'kode_kegiatan','kode_kegiatan');
    }

    function petugas(){
        return $this->belongsTo(Petugas::class,'id_petugas','id_petugas');
    }

    function perusahaan(){
        return $this->belongsTo(Perusahaan::class,'id_sbr','id_sbr');
    }

    function pegawai(){
        return $this->belongsTo(Pegawai::class,'nip','nip');
    }

    function perusahaanKegiatan(){
        return $this->belongsTo(PerusahaanKegiatan::class,'id_perusahaan_survei','id_perusahaan_survei');
    }
}
