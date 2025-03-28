<?php

namespace App\Imports;

use App\Models\Petugas;
use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PetugasImport implements ToModel, WithHeadingRow
{
    protected $kode_kegiatan;

    public function __construct($kode_kegiatan)
    {
        $this->kode_kegiatan = $kode_kegiatan;
    }
    public function model(array $row){

        $kode_kegiatan = $this->kode_kegiatan;
        // Menentukan identifier unik
        $email = $row['email'];

        // Mencari entitas dengan identifier yang sama
        $user = User::where('email', $email)->first();
        $jumlah = Petugas::all()->count() + 1;

        if ($user) {
            // Jika entitas ditemukan, lakukan update
            $petugas = Petugas::where('id_petugas', $user->petugas->id_petugas)->first();
            $petugas->update([
                'nama_petugas' => $row['nama_petugas'],
                'jenis_kelamin' => $row['jenis_kelamin'],
                'kode_kegiatan' => $kode_kegiatan,
                'usia' => $row['usia'],
                'no_wa' => $row['no_wa'],
                'alamat' => $row['alamat'],
            ]);
        } else {
            // Jika entitas tidak ditemukan, buat entitas baru
            $newUser = User::create([
                // Blok 1
                'email' => $row['email'],
                'password' => bcrypt($row['password']),
                'id_peran' => 'p2', //Petugas
            ]);
            Petugas::create([
                'id_petugas' => $jumlah,
                'id_pengguna' => $newUser->id_pengguna,
                'nama_petugas' => $row['nama_petugas'],
                'kode_kegiatan' => $kode_kegiatan,
                'jenis_kelamin' => $row['jenis_kelamin'],
                'usia' => $row['usia'],
                'no_wa' => $row['no_wa'],
                'alamat' => $row['alamat'],
            ]);
        }
    }

}
