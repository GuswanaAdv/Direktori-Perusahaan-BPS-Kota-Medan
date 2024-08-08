<?php

namespace App\Imports;

use App\Models\Perusahaan;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PerusahaanImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row){
        // Menentukan identifier unik, misalnya id_sbr
        $identifier = $row['id_sbr'];

        // Mencari entitas dengan identifier yang sama
        $perusahaan = Perusahaan::where('id_sbr', $identifier)->first();

        if ($perusahaan) {
            // Jika entitas ditemukan, lakukan update
            $perusahaan->update([
                // Blok 1
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
        } else {
            // Jika entitas tidak ditemukan, buat entitas baru
            Perusahaan::create([
                // Blok 1
                'id_sbr' => $row['id_sbr'],
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
