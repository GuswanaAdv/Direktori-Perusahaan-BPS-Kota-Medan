<?php

namespace Database\Seeders;

use App\Models\JenisKepemilikan;
use Illuminate\Database\Seeder;

class JenisKepemilikanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        JenisKepemilikan::insert([
            [
                'kode_jenis_kepemilikan' => '1',
                'nama_jenis_kepemilikan' => 'BUMN',
            ],
            [
                'kode_jenis_kepemilikan' => '2',
                'nama_jenis_kepemilikan' => 'BUMD',
            ],
            [
                'kode_jenis_kepemilikan' => '3',
                'nama_jenis_kepemilikan' => 'Non BUMN',
            ],
            [
                'kode_jenis_kepemilikan' => '4',
                'nama_jenis_kepemilikan' => 'BUM Des',
            ],
        ]);
    }
}
