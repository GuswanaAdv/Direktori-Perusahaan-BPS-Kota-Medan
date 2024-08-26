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
                'id_perusahaan' => $row[2],
                'id_petugas' => $row[3],
                'nama_petugas' => $row[3],
                'nip' => $row[4],
                'status' => $row[5],
                'tanggal_kegiatan' => $row[6],
                'tanggal_penginputan' => $row[7],
                'reverse_kegiatan' => $row[8],
                'reverse_penginputan' => $row[9],
                'keterangan' => $row[10],
            ]);
        }

        // Close the file
        fclose($csvFile);
    }
}
