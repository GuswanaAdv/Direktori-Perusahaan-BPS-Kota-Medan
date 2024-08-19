<?php

namespace App\Imports;

use App\Models\Pegawai;
use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PegawaiImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Menentukan identifier unik
        $email = $row['email'];

        // Mencari entitas dengan identifier yang sama
        $user = User::where('email', $email)->first();

        if ($user) {
            // Jika entitas ditemukan, lakukan update
            $pegawai = Pegawai::where('nip', $user->pegawai->nip)->first();
            $pegawai->update([
                'nama_pegawai' => $row['nama_pegawai'],
                'id_tim_kerja' => $row['id_tim_kerja'],
                'id_jabatan' => $row['id_jabatan'],
                'jenis_kelamin' => $row['jenis_kelamin'],
                'usia' => $row['usia'],
                'no_wa' => $row['no_wa'],
                'alamat' => $row['alamat'],
            ]);
        } else {
            // Jika entitas tidak ditemukan, buat entitas baru
            $newUser = User::create([
                'email' => $row['email'],
                'password' => bcrypt($row['password']),
                'id_peran' => 'p1', //Pegawai
            ]);

            Pegawai::create([
                'nip' => $row['nip'],
                'id_pengguna' => $newUser->id_pengguna,
                'nama_pegawai' => $row['nama_pegawai'],
                'id_tim_kerja' => $row['id_tim_kerja'],
                'id_jabatan' => $row['id_jabatan'],
                'jenis_kelamin' => $row['jenis_kelamin'],
                'usia' => $row['usia'],
                'no_wa' => $row['no_wa'],
                'alamat' => $row['alamat'],
            ]);
            // dd($row);
        }
    }
}
