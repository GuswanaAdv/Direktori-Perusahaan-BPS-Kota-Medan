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
        'nama_kegiatan',
        'tanggal_mulai',
        'tanggal_selesai',
        'keterangan',
    ];

    // Relasi banyak ke satu
    function perusahaanKegiatan(){
        return $this->belongsTo(PerusahaanKegiatan::class,'kode_kegiatan','kode_kegiatan');
    }

    function histori(){
        return $this->belongsTo(Histori::class,'kode_kegiatan','kode_kegiatan');
    }
}
