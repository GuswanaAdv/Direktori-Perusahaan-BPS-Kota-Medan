<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnitStatistik extends Model
{
    use HasFactory;

    protected $table = 'unit_statistik';

    // The primary key is not auto-incrementing
    public $incrementing = false;

    // The primary key is of type string
    protected $keyType = 'string';

    // Indicates if the model should be timestamped.
    public $timestamps = false;

    protected $fillable = [
        'kode_unit_statistik',
        'nama_unit_statistik',
    ];

    // Relasi banyak ke satu ke tabel Perusahaan
    function perusahaan(){
        return $this->hasOne(Perusahaan::class,'kode_unit_statistik','kode_unit_statistik');
    }

    function perusahaanSementara(){
        return $this->hasOne(PerusahaanSementara::class,'kode_unit_statistik','kode_unit_statistik');
    }
}
