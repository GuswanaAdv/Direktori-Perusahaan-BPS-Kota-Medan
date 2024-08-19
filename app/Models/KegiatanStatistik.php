<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KegiatanStatistik extends Model
{
    use HasFactory;

    protected $table = 'kegiatan_statistik';

    // The primary key is not auto-incrementing
    public $incrementing = false;

    // The primary key is of type string
    protected $keyType = 'string';

    // Indicates if the model should be timestamped.
    public $timestamps = false;

    protected $fillable = [
        'kode_kegiatan',
        'nip',
        'nama_kegiatan',
        'tanggal_mulai',
        'tanggal_selesai',
        'reverse_mulai',
        'reverse_selesai',
        'keterangan',
    ];

    // Relasi satu ke banyak
    function perusahaanKegiatan(){
        return $this->hasOne(PerusahaanKegiatan::class,'id_perusahaan_kegiatan','id_perusahaan_kegiatan');
    }

    function histori(){
        return $this->hasMany(Histori::class,'id_histori','id_histori');
    }

    // Relasi banyak ke satu
    function pegawai(){
        return $this->belongsTo(Pegawai::class,'nip','nip');
    }
}
