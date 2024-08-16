<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Petugas extends Model
{
    use HasFactory;

    protected $table = 'petugas';
    protected $primaryKey = 'id_petugas';

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
        'kode_kegiatan',
        'jenis_kelamin',
        'usia',
        'no_wa',
        'alamat'
    ];

    // Relasi satu ke banyak
    function perusahaanKegiatan(){
        return $this->hasMany(PerusahaanKegiatan::class,'id_petugas','id_petugas');
    }

    function histori(){
        return $this->hasMany(Histori::class,'id_petugas','id_petugas');
    }

    function perusahaanSementara(){
        return $this->hasMany(PerusahaanSementara::class,'id_petugas','id_petugas');
    }

    // Relasi satu ke satu
    function pengguna(){
        return $this->belongsTo(Pengguna::class,'id_pengguna','id_pengguna');
    }

    function user(){
        return $this->belongsTo(User::class,'id_pengguna','id_pengguna');
    }

    function kegiatanStatistik(){
        return $this->belongsTo(KegiatanStatistik::class,'kode_kegiatan','kode_kegiatan');
    }
}
