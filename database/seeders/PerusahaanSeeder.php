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
                // Blok 1
                'id_brs' => $row[0],
                'nama_usaha' => $row[1],
                'nama_komersial' => $row[2],
                'kode_unit_statistik' => $row[3],
                'provinsi' => $row[4],
                'kabupaten' => $row[5],
                'kecamatan' => $row[6],
                'kelurahan' => $row[7],
                'nama_sls' => $row[8],
                'alamat_sbr' => $row[9],
                'alamat_pencacahan' => $row[10],
                'kode_pos' => $row[11],
                'telepon' => $row[12],
                'email' => $row[13],
                'website' => $row[14],
                'kode_kondisi_perusahaan' => $row[15],
                'lattitude' => $row[16],
                'longitude' => $row[17],

                // Blok 2
                'kegiatan_utama' => $row[18],
                'kode_kbli' => $row[19],
                'produk_utama' => $row[20],
                'kode_kbki' => $row[21],
                'kode_jenis_kepemilikan' => $row[22],
                'kode_bentuk_badan_usaha' => $row[23],
                'kode_laporan_keuangan' => $row[24],
                'tahun_berdiri' => $row[25],
                'tahun_mulai_beroperasi' => $row[26],
                'no_induk_berusaha' => $row[27],
                'kode_skala_usaha' => $row[28],
                'kode_jaringan_usaha' => $row[29],
                'kode_preferensi' => $row[30],
                'nama_kantor_pusat' => $row[31],
                'alamat_kantor_pusat' => $row[32],
                'email_kantor_pusat' => $row[33],
                'negara_kantor_pusat' => $row[34],
                'provinsi_kantor_pusat' => $row[35],
                'kabupaten_kantor_pusat' => $row[36],
                'kecamatan_kantor_pusat' => $row[37],

                // Blok 3
                'nama_penanggungjawab' => $row[38],
                'jenis_kelamin_penanggungjawab' => $row[39],
                'tanggal_lahir_penanggungjawab' => $row[40],
                'kewarganegaraan_penanggungjawab' => $row[41],
                'kode_jabatan_penanggungjawab' => $row[42],
                'nama_pemegang_saham' => $row[43],
                'npwp_perusahaan' => $row[44],
                'kode_status_penanaman_modal' => $row[45],
            ]);
        }

        // Close the file
        fclose($csvFile);
    }
}
