<?php

namespace Database\Seeders;

use App\Models\StatusPenanamanModal;
use Illuminate\Database\Seeder;

class StatusPenanamanModalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        StatusPenanamanModal::insert([
            [
                'kode_status_penanaman_modal' => '1',
                'nama_status_penanaman_modal' => 'Penanaman Modal Dalam Negeri (PMDN)',
            ],
            [
                'kode_status_penanaman_modal' => '2',
                'nama_status_penanaman_modal' => 'Penanaman Modal Asing (PMA)',
            ],
            [
                'kode_status_penanaman_modal' => '3',
                'nama_status_penanaman_modal' => 'Penanaman Modal Lainnnya (Non PMA/PMDN)',
            ],
        ]);
    }
}
