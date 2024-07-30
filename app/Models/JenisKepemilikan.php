<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisKepemilikan extends Model
{
    use HasFactory;
    protected $table = 'jenis_kepemilikan';
    // The primary key is not auto-incrementing
    public $incrementing = false;

    // The primary key is of type string
    protected $keyType = 'string';

    // Indicates if the model should be timestamped.
    public $timestamps = false;

    protected $fillable = [
        'kode_jenis_kepemilikan',
        'nama_jenis_kepemilikan',
    ];

    // Relasi banyak ke satu ke tabel Perusahaan
    function perusahaan(){
        return $this->belongsTo(Perusahaan::class,'kode_jenis_kepemilikan','kode_jenis_kepemilikan');
    }
}
