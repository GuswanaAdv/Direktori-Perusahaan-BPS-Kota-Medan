<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perusahaan extends Model
{
    use HasFactory;

    protected $table = 'perusahaan';

    // The primary key is not auto-incrementing
    public $incrementing = false;

    // The primary key is of type string
    protected $keyType = 'string';

    // Indicates if the model should be timestamped.
    public $timestamps = false;

    protected $fillable = [
        'kode_brs',
        'kode_perusahaan',
        'nama_perusahaan',
        'pemilik_perusahaan',
        'kategori_perusahaan',
        'status_perusahaan',
        'keterangan',
        'kode_klasifikasi',
    ];
}
