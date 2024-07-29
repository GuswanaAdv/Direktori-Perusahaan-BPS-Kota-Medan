<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JabatanPenanggungjawab extends Model
{
    use HasFactory;
    protected $table = 'jabatan_penanggungjawab';

    // The primary key is not auto-incrementing
    public $incrementing = false;

    // The primary key is of type string
    protected $keyType = 'string';

    // Indicates if the model should be timestamped.
    public $timestamps = false;

    protected $fillable = [
        'kode_jabatan_penanggungjawab',
        'nama_jabatan_penanggungjawab',
    ];
}
