<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PreferensiLokasiPencacahan extends Model
{
    use HasFactory;
    protected $table = 'preferensi_lokasi_pencacahan';

    // The primary key is not auto-incrementing
    public $incrementing = false;

    // The primary key is of type string
    protected $keyType = 'string';

    // Indicates if the model should be timestamped.
    public $timestamps = false;

    protected $fillable = [
        'kode_preferensi_lokasi_pencacahan',
        'nama_preferensi_lokasi_pencacahan',
    ];
}
