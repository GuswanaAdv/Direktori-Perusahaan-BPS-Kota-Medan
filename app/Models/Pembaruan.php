<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembaruan extends Model
{
    use HasFactory;

    protected $table = 'pembaruan';

    protected $primaryKey = 'id_pembaruan';
    public $incrementing = true;

    // The primary key is of type string
    protected $keyType = 'integer';

    // Indicates if the model should be timestamped.
    public $timestamps = false;

    protected $fillable = [
        'nip',
        'kode_kegiatan',
        'keterangan',
        'status',
    ];

    // Relasi satu ke satu
    function kegiatanStatistik(){
        return $this->belongsTo(KegiatanStatistik::class,'kode_kegiatan','kode_kegiatan');
    }

    function pegawai(){
        return $this->belongsTo(Pegawai::class,'nip','nip');
    }

    function perusahaanSementara(){
        return $this->hasOne(perusahaanSementara::class,'id_perusahaan','id_perusahaan');
    }
}
