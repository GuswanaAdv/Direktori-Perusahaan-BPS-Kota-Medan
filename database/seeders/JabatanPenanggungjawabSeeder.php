<?php

namespace Database\Seeders;

use App\Models\JabatanPenanggungjawab;
use Illuminate\Database\Seeder;

class JabatanPenanggungjawabSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        JabatanPenanggungjawab::insert([
            [
                'kode_jabatan_penanggungjawab' => '1',
                'nama_jabatan_penanggungjawab' => 'Pemilik',
            ],
            [
                'kode_jabatan_penanggungjawab' => '2',
                'nama_jabatan_penanggungjawab' => 'Penanggung Jawab',
            ],
            [
                'kode_jabatan_penanggungjawab' => '3',
                'nama_jabatan_penanggungjawab' => 'Pemilik dan Penanggung Jawab',
            ],
        ]);
    }
}
