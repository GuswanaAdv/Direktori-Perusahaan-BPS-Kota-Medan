<?php

namespace Database\Seeders;

use App\Models\UnitStatistik;
use Illuminate\Database\Seeder;

class UnitStatistikSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UnitStatistik::insert([
            [
                'kode_unit_statistik' => '1',
                'nama_unit_statistik' => 'Enterprise Group',
            ],
            [
                'kode_unit_statistik' => '2',
                'nama_unit_statistik' => 'Enterprise',
            ],
            [
                'kode_unit_statistik' => '3',
                'nama_unit_statistik' => 'Establishment',
            ],
            [
                'kode_unit_statistik' => '4',
                'nama_unit_statistik' => 'Ancillary Unit',
            ],
        ]);
    }
}
