<?php

namespace Database\Seeders;

use App\Models\Peran;
use Illuminate\Database\Seeder;

class PeranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Truncate the table
        Peran::truncate();

        // Open the CSV file
        $csvFile = fopen(base_path('database/seeders/data/peran.csv'), 'r');

        // Skip the header row
        fgetcsv($csvFile);

        // Iterate over each row of the file
        while (($row = fgetcsv($csvFile)) !== FALSE) {
            // Insert data into the database
            Peran::insert([
                'id_peran' => $row[0],
                'nama_peran' => $row[1],
            ]);
        }

        // Close the file
        fclose($csvFile);
    }
}
