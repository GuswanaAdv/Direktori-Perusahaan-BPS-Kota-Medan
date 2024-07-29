<?php

namespace Database\Seeders;

use App\Models\PreferensiLokasiPencacahan;
use Illuminate\Database\Seeder;

class PreferensiLokasiPencacahanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PreferensiLokasiPencacahan::insert([
            [
                'kode_preferensi' => '1',
                'nama_preferensi' => 'Kantor Pusat saja',
            ],
            [
                'kode_preferensi' => '2',
                'nama_preferensi' => 'Kantor Cabang',
            ],
            [
                'kode_preferensi' => '3',
                'nama_preferensi' => 'Kantor Pusat dan Kantor Cabang',
            ],
        ]);
    }
}
