<?php

namespace Database\Seeders;

use App\Models\Petugas;
use Illuminate\Database\Seeder;

class PetugasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Truncate the table
        Petugas::truncate();

        // Open the CSV file
        $csvFile = fopen(base_path('database/seeders/data/petugas.csv'), 'r');

        // Skip the header row
        fgetcsv($csvFile);

        // Iterate over each row of the file
        while (($row = fgetcsv($csvFile)) !== FALSE) {
            // Insert data into the database
            Petugas::insert([
                'id_petugas' => $row[0],
                'id_pengguna' => $row[1],
                'nama_petugas' => $row[2],
                'kode_kegiatan' => $row[3],
                'jenis_kelamin' => $row[4],
                'usia' => $row[5],
                'no_wa' => $row[6],
                'alamat' => $row[7],
            ]);
        }

        // Close the file
        fclose($csvFile);
    }
}
