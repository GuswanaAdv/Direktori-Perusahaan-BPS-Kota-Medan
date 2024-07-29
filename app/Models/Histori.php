<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Histori extends Model
{
    use HasFactory;

    protected $table = 'histori';

    // The primary key is not auto-incrementing
    public $incrementing = true;

    // The primary key is of type string
    // protected $keyType = 'string';

    // Indicates if the model should be timestamped.
    public $timestamps = true;

    protected $fillable = [
        'id_histori',
        'id_perusahaan_survei',
        'kode_survei',
        'kode_brs',
        'id_petugas',
        'nip',
        'keterangan',
    ];
}
