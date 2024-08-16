<?php

namespace Database\Seeders;

use App\Models\KegiatanStatistik;
use Illuminate\Database\Seeder;

class KegiatanStatistikSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Truncate the table
        KegiatanStatistik::truncate();

        // Open the CSV file
        $csvFile = fopen(base_path('database/seeders/data/kegiatan_statistik.csv'), 'r');

        // Skip the header row
        fgetcsv($csvFile);

        // Iterate over each row of the file
        while (($row = fgetcsv($csvFile)) !== FALSE) {
            // Insert data into the database
            KegiatanStatistik::insert([
                'kode_kegiatan' => $row[0],
                'nip' => $row[1],
                'nama_kegiatan' => $row[2],
                'tanggal_mulai' => $row[3],
                'tanggal_selesai' => $row[4],
                'reverse_mulai' => $row[5],
                'reverse_selesai' => $row[6],
                'keterangan' => $row[7],
            ]);
        }

        // Close the file
        fclose($csvFile);
    }
}
