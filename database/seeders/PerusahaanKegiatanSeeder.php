<?php

namespace Database\Seeders;

use App\Models\PerusahaanKegiatan;
use Illuminate\Database\Seeder;

class PerusahaanKegiatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Truncate the table
        PerusahaanKegiatan::truncate();

        // Open the CSV file
        $csvFile = fopen(base_path('database/seeders/data/perusahaan_kegiatan.csv'), 'r');

        // Skip the header row
        fgetcsv($csvFile);

        // Iterate over each row of the file
        while (($row = fgetcsv($csvFile)) !== FALSE) {
            // Insert data into the database
            PerusahaanKegiatan::insert([
                'id_perusahaan_kegiatan' => $row[0],
                'kode_kegiatan' => $row[1],
                'id_sbr' => $row[2],
                'id_petugas' => $row[3],
                'nip' => $row[4],
                'aktivitas' => $row[5],
                'hari_tanggal' => $row[6],
                'keterangan' => $row[7],
            ]);
        }

        // Close the file
        fclose($csvFile);
    }
}
