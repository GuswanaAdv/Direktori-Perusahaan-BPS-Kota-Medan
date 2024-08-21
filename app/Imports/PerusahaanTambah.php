<?php

namespace App\Imports;

use App\Models\Perusahaan;
use App\Models\PerusahaanSementara;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PerusahaanTambah implements ToModel, WithHeadingRow
{
    protected $kode_kegiatan;
    protected $id_pembaruan;

    public function __construct($kode_kegiatan, $id_pembaruan)
    {
        $this->kode_kegiatan = $kode_kegiatan;
        $this->id_pembaruan = $id_pembaruan;
    }

    public function model(array $row){
        $kode_kegiatan = $this->kode_kegiatan;
        $id_pembaruan = $this->id_pembaruan;

        $jumlah = PerusahaanSementara::all()->count() + 1 ;
        $id_perusahaan = 'prs_sem'.$jumlah;

        $perusahaan = Perusahaan::where('id_perusahaan', $id_perusahaan)->first();

        if(!$perusahaan){
            PerusahaanSementara::create([
                // Blok 1
                'id_perusahaan' => $id_perusahaan,
                'id_sbr' => $row['id_sbr'],
                'tanggal_cacah_pertama' => $row['tanggal_cacah_pertama'],
                'tanggal_cacah_terakhir' => $row['tanggal_cacah_terakhir'],
                'nip' => $row['nip'],
                'kode_kegiatan' => $kode_kegiatan,
                'id_pembaruan' => $id_pembaruan,
                'nama_usaha' => $row['nama_usaha'],
                'nama_komersial' => $row['nama_komersial'],
                'kode_unit_statistik' => $row['kode_unit_statistik'],
                'provinsi' => $row['provinsi'],
                'kabupaten' => $row['kabupaten'],
                'kecamatan' => $row['kecamatan'],
                'kelurahan' => $row['kelurahan'],
                'nama_sls' => $row['nama_sls'],
                'alamat_sbr' => $row['alamat_sbr'],
                'alamat_pencacahan' => $row['alamat_pencacahan'],
                'kode_pos' => $row['kode_pos'],
                'telepon' => $row['telepon'],
                'email' => $row['email'],
                'website' => $row['website'],
                'kode_kondisi_perusahaan' => $row['kode_kondisi_perusahaan'],
                'lattitude' => $row['lattitude'],
                'longitude' => $row['longitude'],
                // Blok 2
                'kegiatan_utama' => $row['kegiatan_utama'],
                'kode_kbli' => $row['kode_kbli'],
                'produk_utama' => $row['produk_utama'],
                'kode_kbki' => $row['kode_kbki'],
                'kode_jenis_kepemilikan' => $row['kode_jenis_kepemilikan'],
                'kode_bentuk_badan_usaha' => $row['kode_bentuk_badan_usaha'],
                'kode_laporan_keuangan' => $row['kode_laporan_keuangan'],
                'tahun_berdiri' => $row['tahun_berdiri'],
                'tahun_mulai_beroperasi' => $row['tahun_mulai_beroperasi'],
                'no_induk_berusaha' => $row['no_induk_berusaha'],
                'kode_skala_usaha' => $row['kode_skala_usaha'],
                'kode_jaringan_usaha' => $row['kode_jaringan_usaha'],
                'kode_preferensi' => $row['kode_preferensi'],
                'nama_kantor_pusat' => $row['nama_kantor_pusat'],
                'alamat_kantor_pusat' => $row['alamat_kantor_pusat'],
                'email_kantor_pusat' => $row['email_kantor_pusat'],
                'negara_kantor_pusat' => $row['negara_kantor_pusat'],
                'provinsi_kantor_pusat' => $row['provinsi_kantor_pusat'],
                'kabupaten_kantor_pusat' => $row['kabupaten_kantor_pusat'],
                'kecamatan_kantor_pusat' => $row['kecamatan_kantor_pusat'],
                // Blok 3
                'nama_penanggungjawab' => $row['nama_penanggungjawab'],
                'jenis_kelamin_penanggungjawab' => $row['jenis_kelamin_penanggungjawab'],
                'tanggal_lahir_penanggungjawab' => $row['tanggal_lahir_penanggungjawab'],
                'kewarganegaraan_penanggungjawab' => $row['kewarganegaraan_penanggungjawab'],
                'kode_jabatan_penanggungjawab' => $row['kode_jabatan_penanggungjawab'],
                'nama_pemegang_saham' => $row['nama_pemegang_saham'],
                'npwp_perusahaan' => $row['npwp_perusahaan'],
                'kode_status_penanaman_modal' => $row['kode_status_penanaman_modal'],
            ]);
        }

    }

}
