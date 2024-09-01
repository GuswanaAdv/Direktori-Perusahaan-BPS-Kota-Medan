<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;

    protected $table = 'pegawai';

    protected $primaryKey = 'nip';

    // The primary key is not auto-incrementing
    public $incrementing = false;

    // The primary key is of type string
    protected $keyType = 'string';

    // Indicates if the model should be timestamped.
    public $timestamps = false;

    protected $fillable = [
        'nip',
        'id_pengguna',
        'nama_pegawai',
        'id_tim_kerja',
        'id_jabatan',
        'jenis_kelamin',
        'usia',
        'no_wa',
        'alamat'
    ];

    // Relasi satu ke banyak
    function histori(){
        return $this->hasMany(Histori::class,'nip','nip');
    }

    function perusahaanKegiatan(){
        return $this->hasMany(PerusahaanKegiatan::class,'nip','nip');
    }

    // Relasi satu ke satu
    function pengguna(){
        return $this->belongsTo(Pengguna::class,'id_pengguna','id_pengguna');
    }

    function user(){
        return $this->belongsTo(User::class,'id_pengguna','id_pengguna');
    }

    function timKerja(){
        return $this->belongsTo(TimKerja::class,'id_tim_kerja','id_tim_kerja');
    }

    function jabatan(){
        return $this->belongsTo(Jabatan::class,'id_jabatan','id_jabatan');
    }

    // Relasi satu ke banyak
    function perusahaan(){
        return $this->hasMany(Perusahaan::class,'nip','nip');
    }

    function perusahaanSementara(){
        return $this->hasMany(PerusahaanSementara::class,'nip','nip');
    }

    function pembaruan(){
        return $this->hasMany(Pembaruan::class,'nip','nip');
    }

    function kegiatanStatistik(){
        return $this->hasMany(KegiatanStatistik::class,'nip','nip');
    }
}
