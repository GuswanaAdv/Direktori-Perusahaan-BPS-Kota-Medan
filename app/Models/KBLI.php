<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KBLI extends Model
{
    use HasFactory;

    protected $table = 'kbli';

    // The primary key is not auto-incrementing
    public $incrementing = false;

    // The primary key is of type string
    protected $keyType = 'string';

    // Indicates if the model should be timestamped.
    public $timestamps = false;

    protected $fillable = [
        'kode_kbli',
        'nama_kbli',
    ];

    // Relasi banyak ke satu ke tabel Perusahaan
    function perusahaan(){
        return $this->hasOne(Perusahaan::class,'kode_kbli','kode_kbli');
    }

    function perusahaanSementara(){
        return $this->hasOne(PerusahaanSementara::class,'kode_kbli','kode_kbli');
    }
}
