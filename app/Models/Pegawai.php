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
        'id_pengguna',
        'nama_pegawai',
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
}
