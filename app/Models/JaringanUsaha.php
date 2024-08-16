<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JaringanUsaha extends Model
{
    use HasFactory;
    protected $table = 'jaringan_usaha';

    // The primary key is not auto-incrementing
    public $incrementing = false;

    // The primary key is of type string
    protected $keyType = 'string';

    // Indicates if the model should be timestamped.
    public $timestamps = false;

    protected $fillable = [
        'kode_jaringan_usaha',
        'nama_jaringan_usaha',
    ];

    // Relasi banyak ke satu ke tabel Perusahaan
    function perusahaan(){
        return $this->hasOne(Perusahaan::class,'kode_jaringan_usaha','kode_jaringan_usaha');
    }

    function perusahaanSementara(){
        return $this->hasOne(PerusahaanSementara::class,'kode_jaringan_usaha','kode_jaringan_usaha');
    }
}
