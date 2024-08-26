<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriUsaha extends Model
{
    use HasFactory;
    protected $table = 'kategori_usaha';

    // The primary key is not auto-incrementing
    public $incrementing = false;

    // The primary key is of type string
    protected $keyType = 'string';

    // Indicates if the model should be timestamped.
    public $timestamps = false;

    protected $fillable = [
        'kode_kategori',
        'nama_kategori',
    ];

    // Relasi banyak ke satu ke tabel Perusahaan
    function perusahaan(){
        return $this->hasOne(Perusahaan::class,'kode_kategori','kode_kategori');
    }

    function perusahaanSementara(){
        return $this->hasOne(Perusahaan::class,'kode_kategori','kode_kategori');
    }
}
