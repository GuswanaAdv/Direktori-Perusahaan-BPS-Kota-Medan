<?php

namespace Database\Seeders;

use App\Models\Pegawai;
use Illuminate\Database\Seeder;

class PegawaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Truncate the table
        Pegawai::truncate();

        // Open the CSV file
        $csvFile = fopen(base_path('database/seeders/data/pegawai.csv'), 'r');

        // Skip the header row
        fgetcsv($csvFile);

        // Iterate over each row of the file
        while (($row = fgetcsv($csvFile)) !== FALSE) {
            // Insert data into the database
            Pegawai::insert([
                'nip' => $row[0],
                'id_pengguna' => $row[1],
                'nama_pegawai' => $row[2],
            ]);
        }

        // Close the file
        fclose($csvFile);
    }
}
