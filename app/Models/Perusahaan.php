<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perusahaan extends Model
{
    use HasFactory;

    protected $table = 'perusahaan';

    // The primary key is not auto-incrementing
    public $incrementing = false;

    // The primary key is of type string
    protected $keyType = 'string';

    // Indicates if the model should be timestamped.
    public $timestamps = false;

    protected $fillable = [
        // Blok 1
        'id_sbr',
        'nama_usaha',
        'nama_komersial',
        'kode_unit_statistik',
        'provinsi',
        'kabupaten',
        'kecamatan',
        'kelurahan',
        'nama_sls',
        'alamat_sbr',
        'alamat_pencacahan',
        'kode_pos',
        'telepon',
        'email',
        'website',
        'kode_kondisi_perusahaan',
        'lattitude',
        'longitude',

        // Blok 2
        'kegiatan_utama',
        'kode_kbli',
        'produk_utama',
        'kode_kbki',
        'kode_jenis_kepemilikan',
        'kode_bentuk_badan_usaha',
        'kode_laporan_keuangan',
        'tahun_berdiri',
        'tahun_mulai_beroperasi',
        'no_induk_berusaha',
        'kode_skala_usaha',
        'kode_jaringan_usaha',
        'kode_preferensi',
        'nama_kantor_pusat',
        'alamat_kantor_pusat',
        'email_kantor_pusat',
        'negara_kantor_pusat',
        'provinsi_kantor_pusat',
        'kabupaten_kantor_pusat',
        'kecamatan_kantor_pusat',

        // Blok 3
        'nama_penanggungjawab',
        'jenis_kelamin_penanggungjawab',
        'tanggal_lahir_penanggungjawab',
        'kewarganegaraan_penanggungjawab',
        'kode_jabatan_penanggungjawab',
        'nama_pemegang_saham',
        'npwp_perusahaan',
        'kode_status_penanaman_modal',
    ];

    
    // Relasi satu ke satu
    function bentukBadanUsaha(){
        return $this->hasOne(BentukBadanUsaha::class, 'kode_bentuk_badan_usaha', 'kode_bentuk_badan_usaha');
    }

    function jabatanPenanggungjawab(){
        return $this->hasOne(JabatanPenanggungjawab::class, 'kode_jabatan_penanggungjawab', 'kode_jabatan_penanggungjawab');
    }

    function jaringanUsaha(){
        return $this->hasOne(JaringanUsaha::class, 'kode_jaringan_usaha', 'kode_jaringan_usaha');
    }

    function jenisKepemilikan(){
        return $this->hasOne(JenisKepemilikan::class, 'kode_jenis_kepemilikan', 'kode_jenis_kepemilikan');
    }

    function kbli(){
        return $this->hasOne(KBLI::class, 'kode_kbli', 'kode_kbli');
    }

    function kondisiPerusahaan(){
        return $this->hasOne(KondisiPerusahaan::class, 'kode_kondisi_perusahaan', 'kode_kondisi_perusahaan');
    }

    function laporanKeuangan(){
        return $this->hasOne(LaporanKeuangan::class, 'kode_laporan_keuangan', 'kode_laporan_keuangan');
    }

    function preferensiLokasiPencacahan(){
        return $this->hasOne(PreferensiLokasiPencacahan::class, 'kode_preferensi', 'kode_preferensi');
    }

    function skalaUsaha(){
        return $this->hasOne(SkalaUsaha::class, 'kode_skala_usaha', 'kode_skala_usaha');
    }

    function statusPenanamanModal(){
        return $this->hasOne(StatusPenanamanModal::class, 'kode_status_penanaman_modal', 'kode_status_penanaman_modal');
    }

    function unitStatistik(){
        return $this->hasOne(UnitStatistik::class, 'kode_unit_statistik', 'kode_unit_statistik');
    }

    // Relasi banyak ke satu
    function perusahaanKegiatan(){
        return $this->belongsTo(PerusahaanKegiatan::class, 'id_sbr', 'id_sbr');
    }

    function histori(){
        return $this->belongsTo(Histori::class, 'id_sbr', 'id_sbr');
    }
}
