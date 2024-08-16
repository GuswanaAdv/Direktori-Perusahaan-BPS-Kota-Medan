<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimKerja extends Model
{
    use HasFactory;

    protected $table = 'tim_kerja';

    protected $primaryKey = 'id_tim_kerja';

    // The primary key is not auto-incrementing
    public $incrementing = false;

    // The primary key is of type string
    protected $keyType = 'string';

    // Indicates if the model should be timestamped.
    public $timestamps = false;

    protected $fillable = [
        'id_tim_kerja',
        'nama_tim_kerja'
    ];

    // Relasi satu ke banyak
    public function pegawai(){
        return $this->hasMany(Pegawai::class,'id_tim_kerja','id_tim_kerja');
    }

}
