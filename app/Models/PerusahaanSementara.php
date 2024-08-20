<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerusahaanSementara extends Model
{
    use HasFactory;
    protected $table = 'perusahaan_sementara';
    protected $primaryKey = 'id_perusahaan';

    // The primary key is of type string
    protected $keyType = 'string';

    // Indicates if the model should be timestamped.
    public $timestamps = false;
    protected $fillable = [
        // Blok 1
        'id_perusahaan',
        'id_sbr',
        'tanggal_cacah_pertama',
        'tanggal_cacah_terakhir',
        'nama_usaha',
        'nama_komersial',
        // 'id_petugas',
        'nip',
        'id_pembaruan',
        'kode_kegiatan',
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
        return $this->belongsTo(BentukBadanUsaha::class, 'kode_bentuk_badan_usaha', 'kode_bentuk_badan_usaha');
    }

    function jabatanPenanggungjawab(){
        return $this->belongsTo(JabatanPenanggungjawab::class, 'kode_jabatan_penanggungjawab', 'kode_jabatan_penanggungjawab');
    }

    function jaringanUsaha(){
        return $this->belongsTo(JaringanUsaha::class, 'kode_jaringan_usaha', 'kode_jaringan_usaha');
    }

    function jenisKepemilikan(){
        return $this->belongsTo(JenisKepemilikan::class, 'kode_jenis_kepemilikan', 'kode_jenis_kepemilikan');
    }

    function kbli(){
        return $this->belongsTo(KBLI::class, 'kode_kbli', 'kode_kbli');
    }

    function kondisiPerusahaan(){
        return $this->belongsTo(KondisiPerusahaan::class, 'kode_kondisi_perusahaan', 'kode_kondisi_perusahaan');
    }

    function laporanKeuangan(){
        return $this->belongsTo(LaporanKeuangan::class, 'kode_laporan_keuangan', 'kode_laporan_keuangan');
    }

    function preferensiLokasiPencacahan(){
        return $this->belongsTo(PreferensiLokasiPencacahan::class, 'kode_preferensi', 'kode_preferensi');
    }

    function skalaUsaha(){
        return $this->belongsTo(SkalaUsaha::class, 'kode_skala_usaha', 'kode_skala_usaha');
    }

    function statusPenanamanModal(){
        return $this->belongsTo(StatusPenanamanModal::class, 'kode_status_penanaman_modal', 'kode_status_penanaman_modal');
    }

    function unitStatistik(){
        return $this->belongsTo(UnitStatistik::class, 'kode_unit_statistik', 'kode_unit_statistik');
    }

    // Relasi satu ke banyak
    function perusahaanKegiatan(){
        return $this->hasMany(PerusahaanKegiatan::class, 'id_perusahaan', 'id_perusahaan');
    }

    function histori(){
        return $this->hasMany(Histori::class, 'id_perusahaan', 'id_perusahaan');
    }

    // Relasi banyak ke satu
    function petugas(){
        return $this->belongsTo(Petugas::class, 'id_petugas', 'id_petugas');
    }
    function kegiatanStatistik(){
        return $this->belongsTo(KegiatanStatistik::class, 'kode_kegiatan', 'kode_kegiatan');
    }

    function pembaruan(){
        return $this->belongsTo(Pembaruan::class, 'id_pembaruan', 'id_pembaruan');
    }
}
