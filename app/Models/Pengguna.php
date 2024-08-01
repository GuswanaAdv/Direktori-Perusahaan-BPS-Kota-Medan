<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengguna extends Model
{
    use HasFactory;
    protected $table = 'pengguna';

    // The primary key is not auto-incrementing
    public $incrementing = false;

    // The primary key is of type string
    protected $keyType = 'integer';

    // Indicates if the model should be timestamped.
    public $timestamps = false;

    protected $fillable = [
        'id_pengguna',
        'email',
        'password',
        'id_peran',
    ];

    // Relasi satu ke satu
    function peran(){
        return $this->hasOne(Peran::class,'id_peran','id_peran');
    }

    function pegawai(){
        return $this->belongsTo(Pegawai::class,'id_pengguna','id_pengguna');
    }

    function petugas(){
        return $this->belongsTo(Petugas::class,'id_pengguna','id_pengguna');
    }
}
