<?php

namespace Database\Seeders;

use App\Models\KategoriUsaha;
use Illuminate\Database\Seeder;

class KategoriUsahaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Truncate the table
        KategoriUsaha::truncate();

        // Open the CSV file
        $csvFile = fopen(base_path('database/seeders/data/kategori_usaha.csv'), 'r');

        // Skip the header row
        fgetcsv($csvFile);

        // Iterate over each row of the file
        while (($row = fgetcsv($csvFile)) !== FALSE) {
            // Insert data into the database
            KategoriUsaha::insert([
                'kode_kategori' => $row[0],
                'nama_kategori' => $row[1],
            ]);
        }

        // Close the file
        fclose($csvFile);
    }
}
