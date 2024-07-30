<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanKeuangan extends Model
{
    use HasFactory;
    protected $table = 'laporan_keuangan';

    // The primary key is not auto-incrementing
    public $incrementing = false;

    // The primary key is of type string
    protected $keyType = 'string';

    // Indicates if the model should be timestamped.
    public $timestamps = false;

    protected $fillable = [
        'kode_laporan_keuangan',
        'nama_laporan_keuangan',
    ];

    // Relasi banyak ke satu ke tabel Perusahaan
    function perusahaan(){
        return $this->belongsTo(Perusahaan::class,'kode_laporan_keuangan','kode_laporan_keuangan');
    }
}
