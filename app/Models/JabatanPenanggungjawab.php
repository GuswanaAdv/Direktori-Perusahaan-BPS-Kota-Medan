<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JabatanPenanggungjawab extends Model
{
    use HasFactory;
    protected $table = 'jabatan_penanggungjawab';

    // The primary key is not auto-incrementing
    public $incrementing = false;

    // The primary key is of type string
    protected $keyType = 'string';

    // Indicates if the model should be timestamped.
    public $timestamps = false;

    protected $fillable = [
        'kode_jabatan_penanggungjawab',
        'nama_jabatan_penanggungjawab',
    ];

    // Relasi banyak ke satu ke tabel Perusahaan
    function perusahaan(){
        return $this->hasOne(Perusahaan::class,'kode_jabatan_penanggungjawab','kode_jabatan_penanggungjawab');
    }

    function perusahaanSementara(){
        return $this->hasOne(PerusahaanSementara::class,'kode_jabatan_penanggungjawab','kode_jabatan_penanggungjawab');
    }
}
