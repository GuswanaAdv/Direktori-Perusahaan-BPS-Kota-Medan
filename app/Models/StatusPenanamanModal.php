<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusPenanamanModal extends Model
{
    use HasFactory;

    protected $table = 'status_penanaman_modal';

    // The primary key is not auto-incrementing
    public $incrementing = false;

    // The primary key is of type string
    protected $keyType = 'string';

    // Indicates if the model should be timestamped.
    public $timestamps = false;

    protected $fillable = [
        'kode_status_penanaman_modal',
        'nama_status_penanaman_modal',
    ];

    // Relasi banyak ke satu ke tabel Perusahaan
    function perusahaan(){
        return $this->hasOne(Perusahaan::class,'kode_status_penanaman_modal','kode_status_penanaman_modal');
    }

    function perusahaanSementara(){
        return $this->hasOne(PerusahaanSementara::class,'kode_status_penanaman_modal','kode_status_penanaman_modal');
    }
}
