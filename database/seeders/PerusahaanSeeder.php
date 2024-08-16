<?php

namespace Database\Seeders;

use App\Models\Perusahaan;
use Illuminate\Database\Seeder;

class PerusahaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Truncate the table
        Perusahaan::truncate();

        // Open the CSV file
        $csvFile = fopen(base_path('database/seeders/data/perusahaan.csv'), 'r');

        // Skip the header row
        fgetcsv($csvFile);

        // Iterate over each row of the file
        while (($row = fgetcsv($csvFile)) !== FALSE) {
            // Insert data into the database
            Perusahaan::insert([
                'id_perusahaan' => $row[0],
                'id_sbr' => $row[1],
                'tanggal_cacah_pertama' => $row[2],
                'tanggal_cacah_terakhir' => $row[3],
                'nama_usaha' => $row[4],
                'nama_komersial' => $row[5],
                'nip' => $row[6],
                'kode_unit_statistik' => $row[7],
                'provinsi' => $row[8],
                'kabupaten' => $row[9],
                'kecamatan' => $row[10],
                'kelurahan' => $row[11],
                'nama_sls' => $row[12],
                'alamat_sbr' => $row[13],
                'alamat_pencacahan' => $row[14],
                'kode_pos' => $row[15],
                'telepon' => $row[16],
                'email' => $row[17],
                'website' => $row[18],
                'kode_kondisi_perusahaan' => $row[19],
                'lattitude' => $row[20],
                'longitude' => $row[21],
                'kegiatan_utama' => $row[22],
                'kode_kbli' => $row[23],
                'produk_utama' => $row[24],
                'kode_kbki' => $row[25],
                'kode_jenis_kepemilikan' => $row[26],
                'kode_bentuk_badan_usaha' => $row[27],
                'kode_laporan_keuangan' => $row[28],
                'tahun_berdiri' => $row[29],
                'tahun_mulai_beroperasi' => $row[30],
                'no_induk_berusaha' => $row[31],
                'kode_skala_usaha' => $row[32],
                'kode_jaringan_usaha' => $row[33],
                'kode_preferensi' => $row[34],
                'nama_kantor_pusat' => $row[35],
                'alamat_kantor_pusat' => $row[36],
                'email_kantor_pusat' => $row[37],
                'negara_kantor_pusat' => $row[38],
                'provinsi_kantor_pusat' => $row[39],
                'kabupaten_kantor_pusat' => $row[40],
                'kecamatan_kantor_pusat' => $row[41],
                'nama_penanggungjawab' => $row[42],
                'jenis_kelamin_penanggungjawab' => $row[43],
                'tanggal_lahir_penanggungjawab' => $row[44],
                'kewarganegaraan_penanggungjawab' => $row[45],
                'kode_jabatan_penanggungjawab' => $row[46],
                'nama_pemegang_saham' => $row[47],
                'npwp_perusahaan' => $row[48],
                'kode_status_penanaman_modal' => $row[49],
            ]);
        }

        // Close the file
        fclose($csvFile);
    }
}
