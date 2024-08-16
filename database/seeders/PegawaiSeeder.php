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
                'id_tim_kerja' => $row[3],
                'id_jabatan' => $row[4],
                'jenis_kelamin' => $row[5],
                'usia' => $row[6],
                'no_wa' => $row[7],
                'alamat' => $row[8],
            ]);
        }

        // Close the file
        fclose($csvFile);
    }
}
