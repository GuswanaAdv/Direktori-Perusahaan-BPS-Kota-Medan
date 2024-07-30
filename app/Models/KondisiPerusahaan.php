<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KondisiPerusahaan extends Model
{
    use HasFactory;
    protected $table = 'kondisi_perusahaan';

    // The primary key is not auto-incrementing
    public $incrementing = false;

    // The primary key is of type string
    protected $keyType = 'string';

    // Indicates if the model should be timestamped.
    public $timestamps = false;

    protected $fillable = [
        'kode_kondisi_perusahaan',
        'nama_kondisi_perusahaan',
    ];

    // Relasi banyak ke satu ke tabel Perusahaan
    function perusahaan(){
        return $this->belongsTo(Perusahaan::class,'kode_kondisi_perusahaan','kode_kondisi_perusahaan');
    }
}
