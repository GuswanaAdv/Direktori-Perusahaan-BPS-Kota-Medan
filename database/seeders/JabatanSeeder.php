<?php

namespace Database\Seeders;

use App\Models\Jabatan;
use Illuminate\Database\Seeder;

class JabatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Truncate the table
        Jabatan::truncate();

        // Open the CSV file
        $csvFile = fopen(base_path('database/seeders/data/jabatan.csv'), 'r');

        // Skip the header row
        fgetcsv($csvFile);

        // Iterate over each row of the file
        while (($row = fgetcsv($csvFile)) !== FALSE) {
            // Insert data into the database
            Jabatan::insert([
                'id_jabatan' => $row[0],
                'nama_jabatan' => $row[1],
            ]);
        }

        // Close the file
        fclose($csvFile);
    }
}
