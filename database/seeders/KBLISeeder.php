<?php

namespace Database\Seeders;

use App\Models\KBLI;
use Illuminate\Database\Seeder;

class KBLISeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Truncate the table
        KBLI::truncate();

        // Open the CSV file
        $csvFile = fopen(base_path('database/seeders/data/kbli.csv'), 'r');

        // Skip the header row
        fgetcsv($csvFile);

        // Iterate over each row of the file
        while (($row = fgetcsv($csvFile)) !== FALSE) {
            // Insert data into the database
            KBLI::insert([
                'kode_kbli' => $row[0],
                'nama_kbli' => $row[1],
            ]);
        }

        // Close the file
        fclose($csvFile);
    }
}
