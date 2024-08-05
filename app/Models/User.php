<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $primaryKey = 'id_pengguna';
    public $incrementing = false;
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
