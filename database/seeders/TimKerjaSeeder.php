<?php

namespace Database\Seeders;

use App\Models\TimKerja;
use Illuminate\Database\Seeder;

class TimKerjaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Truncate the table
        TimKerja::truncate();

        // Open the CSV file
        $csvFile = fopen(base_path('database/seeders/data/tim_kerja.csv'), 'r');

        // Skip the header row
        fgetcsv($csvFile);

        // Iterate over each row of the file
        while (($row = fgetcsv($csvFile)) !== FALSE) {
            // Insert data into the database
            TimKerja::insert([
                'id_tim_kerja' => $row[0],
                'nama_tim_kerja' => $row[1],
            ]);
        }

        // Close the file
        fclose($csvFile);
    }
}
