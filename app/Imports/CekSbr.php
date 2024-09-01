<?php

namespace App\Imports;

use App\Models\Perusahaan;
use App\Models\PerusahaanSementara;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CekSbr implements ToModel, WithHeadingRow
{
    protected $id_pembaruan;

    public function __construct($id_pembaruan)
    {
        $this->id_pembaruan = $id_pembaruan;
    }

    public function model(array $row){
        $id_pembaruan = $this->id_pembaruan;
        $perusahaan = Perusahaan::where('id_sbr', $row['id_sbr'])->first();
        // dd($row['id_sbr']);
        if($perusahaan){
            PerusahaanSementara::create([
                // Blok 1
                'id_perusahaan' => $perusahaan->id_perusahaan,
                'ada_sbr' => $perusahaan->ada_sbr,
                'id_sbr' => $perusahaan->id_sbr,
                'tanggal_cacah_pertama' => $perusahaan->tanggal_cacah_pertama,
                'tanggal_cacah_terakhir' => $perusahaan->tanggal_cacah_terakhir,
                'nip' => $perusahaan->nip,
                'nama_petugas' => $perusahaan->nip,
                'kode_kegiatan' => $perusahaan->kode_kegiatan,
                'id_pembaruan' => $id_pembaruan,
                'nama_usaha' => $perusahaan->nama_usaha,
                'nama_komersial' => $perusahaan->nama_komersial,
                'kode_unit_statistik' => $perusahaan->kode_unit_statistik,
                'provinsi' => $perusahaan->provinsi,
                'kabupaten' => $perusahaan->kabupaten,
                'kecamatan' => $perusahaan->kecamatan,
                'kelurahan' => $perusahaan->kelurahan,
                'nama_sls' => $perusahaan->nama_sls,
                'alamat_sbr' => $perusahaan->alamat_sbr,
                'telepon' => $perusahaan->telepon,
                'kode_kondisi_perusahaan' => $perusahaan->kode_kondisi_perusahaan,
                'kode_kategori' => $perusahaan->kode_kategori,
            ]);
        }
    }

}
