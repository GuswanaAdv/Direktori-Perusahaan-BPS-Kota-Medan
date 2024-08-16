<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    use HasFactory;
    protected $table = 'jabatan';

    protected $primaryKey = 'id_jabatan';

    // The primary key is not auto-incrementing
    public $incrementing = false;

    // The primary key is of type string
    protected $keyType = 'string';

    // Indicates if the model should be timestamped.
    public $timestamps = false;

    protected $fillable = [
        'id_jabatan',
        'nama_jabatan'
    ];

    // Relasi satu ke banyak
    public function pegawai(){
        return $this->hasMany(Pegawai::class,'id_jabatan','id_jabatan');
    }
}
