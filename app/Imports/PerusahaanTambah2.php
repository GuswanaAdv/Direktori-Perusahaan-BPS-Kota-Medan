<?php

namespace App\Imports;

use App\Models\Perusahaan;
use App\Models\PerusahaanSementara;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PerusahaanTambah2 implements ToModel, WithHeadingRow
{
    protected $kode_kegiatan;
    protected $id_pembaruan;
    protected $nip;

    public function __construct($kode_kegiatan, $id_pembaruan, $nip)
    {
        $this->kode_kegiatan = $kode_kegiatan;
        $this->id_pembaruan = $id_pembaruan;
        $this->nip = $nip;
    }

    public function model(array $row){
        $kode_kegiatan = $this->kode_kegiatan;
        $id_pembaruan = $this->id_pembaruan;
        $nip = $this->nip;
        $id_perusahaan = "prs_sem-".(PerusahaanSementara::all()->count()+1);
        PerusahaanSementara::create([
            // Blok 1
            'id_perusahaan' => $id_perusahaan,
            'ada_sbr' => ($row['id_sbr'] == "-")? "tidak ada" : "ada",
            'id_sbr' => ($row['id_sbr'] == "-")? $id_perusahaan : $row['id_sbr'],
            'tanggal_cacah_pertama' => $row['tanggal_cacah_pertama'],
            'tanggal_cacah_terakhir' => $row['tanggal_cacah_terakhir'],
            'nip' => $nip,
            'kode_kegiatan' => $kode_kegiatan,
            'id_pembaruan' => $id_pembaruan,
            'nama_usaha' => $row['nama_usaha'],
            'nama_komersial' => $row['nama_komersial'],
            'kode_unit_statistik' => $row['kode_unit_statistik'],
            'provinsi' => $row['provinsi'],
            'kabupaten' => $row['kabupaten'],
            'kecamatan' => $row['kecamatan'],
            'kelurahan' => $row['kelurahan'],
            'alamat_sbr' => $row['alamat_sbr'],
            'telepon' => $row['telepon'],
            'kode_kondisi_perusahaan' => $row['kode_kondisi_perusahaan'],
            'kode_kategori' => $row['kode_kategori'],
        ]);
    }
}
