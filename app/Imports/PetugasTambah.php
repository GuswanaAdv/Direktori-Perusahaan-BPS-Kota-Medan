<?php

namespace App\Imports;

use App\Models\Pembaruan;
use App\Models\PerusahaanSementara;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PetugasTambah implements ToModel, WithHeadingRow
{
    protected $id_pembaruan;
    public function __construct($id_pembaruan)
    {
        $this->id_pembaruan = $id_pembaruan;
    }
    public function model(array $row){
        $id_pembaruan = $this->id_pembaruan;
        $id_perusahaan = $row['id_perusahaan'];
        $kode_kegiatan = Pembaruan::find($id_pembaruan)->kode_kegiatan;
        $perusahaanSementara = PerusahaanSementara::where('id_pembaruan', $id_pembaruan)->
        when($id_perusahaan, function ($query) use ($id_perusahaan) {
            return $query->where('id_perusahaan', $id_perusahaan);
        })->first();
        $perusahaanSementara->update([
            // Blok 1
            'id_perusahaan' => $row['id_perusahaan'],
            'ada_sbr' => ($row['id_sbr'] == "-")? "tidak ada" : "ada",
            'id_sbr' => ($row['id_sbr'] == "-")? $row['id_perusahaan'] : $row['id_sbr'],
            'tanggal_cacah_pertama' => $row['tanggal_cacah_pertama'],
            'tanggal_cacah_terakhir' => $row['tanggal_cacah_terakhir'],
            'nip' => $row['nip'],
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
            'nama_petugas' => $row['nama_petugas'],
        ]);
    }
}
