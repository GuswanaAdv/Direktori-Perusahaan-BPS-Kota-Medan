<?php

namespace App\Imports;

use App\Models\Petugas;
use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PetugasImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row){
        // Menentukan identifier unik
        $email = $row['email'];
        $id_petugas = $row['id_petugas'];

        // Mencari entitas dengan identifier yang sama
        $user = User::where('email', $email)->first();
        $petugas = Petugas::where('id_petugas', $id_petugas)->first();

        if ($user) {
            // Jika entitas ditemukan, lakukan update
            $petugas->update([
                'nama_petugas' => $row['nama_petugas'],
                'jenis_kelamin' => $row['jenis_kelamin'],
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
                'id_petugas' => $row['id_petugas'],
                'id_pengguna' => $newUser->id_pengguna,
                'nama_petugas' => $row['nama_petugas'],
                'jenis_kelamin' => $row['jenis_kelamin'],
                'usia' => $row['usia'],
                'no_wa' => $row['no_wa'],
                'alamat' => $row['alamat'],
            ]);
        }
    }

}
