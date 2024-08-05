<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Pengguna extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'pengguna';

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

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Relasi satu ke satu
    function peran(){
        return $this->belongsTo(Peran::class,'id_peran','id_peran');
    }

    function pegawai(){
        return $this->hasOne(Pegawai::class,'id_pengguna','id_pengguna');
    }

    function petugas(){
        return $this->hasOne(Petugas::class,'id_pengguna','id_pengguna');
    }
}
