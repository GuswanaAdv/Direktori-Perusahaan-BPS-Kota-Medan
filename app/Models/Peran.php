<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peran extends Model
{
    use HasFactory;
    protected $table = 'peran';

    // The primary key is not auto-incrementing
    public $incrementing = false;

    // The primary key is of type string
    protected $keyType = 'string';

    // Indicates if the model should be timestamped.
    public $timestamps = false;

    protected $fillable = [
        'id_peran',
        'nama_peran',
    ];

    // Relasi satu ke satu
    function pengguna(){
        return $this->hasMany(Pengguna::class,'id_peran','id_peran');
    }

    function user(){
        return $this->hasMany(User::class,'id_peran','id_peran');
    }
}
