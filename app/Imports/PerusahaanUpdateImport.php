<?php

namespace App\Imports;

use App\Models\Perusahaan;
use App\Models\PerusahaanSementara;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PerusahaanUpdateImport implements ToModel, WithHeadingRow
{
    protected $kode_kegiatan;
    protected $id_pembaruan;

    public function __construct($kode_kegiatan, $id_pembaruan)
    {
        $this->kode_kegiatan = $kode_kegiatan;
        $this->id_pembaruan = $id_pembaruan;
    }

    public function model(array $row){
        $kode_kegiatan = $this->kode_kegiatan;
        $id_pembaruan = $this->id_pembaruan;

        $perusahaan = PerusahaanSementara::where('id_perusahaan', $row['id_perusahaan'])
        ->when($id_pembaruan, function ($query) use ($id_pembaruan) {
            return $query->where('id_pembaruan','>=', $id_pembaruan);
        })->first();

        if($perusahaan){
            $perusahaan->update([
                // Blok 1
                'id_perusahaan' => $row['id_perusahaan'],
                'ada_sbr' => $row['ada_sbr'],
                'id_sbr' => $row['id_sbr'],
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
            ]);
        }

    }

}
