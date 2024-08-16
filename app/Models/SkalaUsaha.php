<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SkalaUsaha extends Model
{
    use HasFactory;
    protected $table = 'skala_usaha';

    // The primary key is not auto-incrementing
    public $incrementing = false;

    // The primary key is of type string
    protected $keyType = 'string';

    // Indicates if the model should be timestamped.
    public $timestamps = false;

    protected $fillable = [
        'kode_skala_usaha',
        'nama_skala_usaha',
    ];

    // Relasi banyak ke satu ke tabel Perusahaan
    function perusahaan(){
        return $this->hasOne(Perusahaan::class,'kode_skala_usaha','kode_skala_usaha');
    }

    function perusahaanSementara(){
        return $this->hasOne(PerusahaanSementara::class,'kode_skala_usaha','kode_skala_usaha');
    }
}
