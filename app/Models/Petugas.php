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
        'id_pengguna',
        'nama_petugas',
    ];

    // Relasi satu ke banyak
    function perusahaanKegiatan(){
        return $this->hasMany(PerusahaanKegiatan::class,'id_perusahaan_kegiatan','id_perusahaan_kegiatan');
    }

    function histori(){
        return $this->hasMany(Histori::class,'id_histori','id_histori');
    }

    // Relasi satu ke satu
    function pengguna(){
        return $this->hasOne(Pengguna::class,'id_pengguna','id_pengguna');
    }
}
