<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BentukBadanUsaha extends Model
{
    use HasFactory;
    protected $table = 'bentuk_badan_usaha';

    // The primary key is not auto-incrementing
    public $incrementing = false;

    // The primary key is of type string
    protected $keyType = 'string';

    // Indicates if the model should be timestamped.
    public $timestamps = false;

    protected $fillable = [
        'kode_bentuk_badan_usaha',
        'nama_bentuk_badan_usaha',
    ];
}
