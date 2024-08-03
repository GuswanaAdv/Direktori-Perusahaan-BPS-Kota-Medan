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
        'tanggal_kegiatan',
        'tanggal_penginputan',
        'reverse_kegiatan',
        'reverse_penginputan',
        'keterangan',
    ];

    // Relasi banyak ke satu
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

    // Relasi satu ke banyak
    function histori(){
        return $this->hasMany(Histori::class,'id_histori','id_histori');
    }
}
