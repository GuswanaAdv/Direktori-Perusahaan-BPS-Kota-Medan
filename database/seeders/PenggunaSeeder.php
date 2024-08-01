<?php

namespace Database\Seeders;

use App\Models\Pengguna;
use Illuminate\Database\Seeder;

class PenggunaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Truncate the table
        Pengguna::truncate();

        // Open the CSV file
        $csvFile = fopen(base_path('database/seeders/data/pengguna.csv'), 'r');

        // Skip the header row
        fgetcsv($csvFile);

        // Iterate over each row of the file
        while (($row = fgetcsv($csvFile)) !== FALSE) {
            // Insert data into the database
            Pengguna::insert([
                'id_pengguna' => $row[0],
                'email' => $row[1],
                'password' => $row[2],
                'id_peran' => $row[3],
            ]);
        }

        // Close the file
        fclose($csvFile);
    }
}
