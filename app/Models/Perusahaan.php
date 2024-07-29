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
        'id_brs',
        'id_brs',
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
        'id_kondisi_perusahaan',
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
        'kode_preferensi_lokasi_pencacahan',
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
        'negara_pemegang_saham',
        'npwp_perusahaan',
        'kode_status_penanaman_modal',
    ];
}
