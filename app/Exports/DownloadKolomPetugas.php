<?php

namespace App\Exports;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;

class DownloadKolomPetugas implements WithHeadings, FromCollection, WithMapping, WithTitle
{
    protected $row;
    public function __construct($row)
    {
        $this->row = $row;
    }

    public function collection()
    {
        return $this->row;
    }

    public function map($row): array
    {
        return [
            'id_perusahaan' => $row->id_perusahaan,
            'ada_sbr' => $row->ada_sbr,
            'id_sbr' => $row->id_sbr,
            'tanggal_cacah_pertama' => $row->tanggal_cacah_pertama,
            'tanggal_cacah_terakhir' => $row->tanggal_cacah_terakhir,
            'nama_usaha' => $row->nama_usaha,
            'nama_komersial' => $row->nama_komersial,
            'nip' => $row->nip,
            'kode_kegiatan' => $row->kode_kegiatan,
            'kode_unit_statistik' => strval($row->kode_unit_statistik),
            'provinsi' => $row->provinsi,
            'kabupaten' => $row->kabupaten,
            'kecamatan' => $row->kecamatan,
            'kelurahan' => $row->kelurahan,
            'alamat_sbr' => $row->alamat_sbr,
            'telepon' => $row->telepon,
            'kode_kondisi_perusahaan' => $row->kode_kondisi_perusahaan,
            'kode_kategori' => $row->kode_kategori,
            'nama_petugas' => '-',
        ];
    }

    public function title(): string
    {
        return 'file';
    }

    public function headings(): array
    {
        return [[
            'id_perusahaan',
            'ada_sbr',
            'id_sbr',
            'tanggal_cacah_pertama',
            'tanggal_cacah_terakhir',
            'nama_usaha',
            'nama_komersial',
            'nip',
            'kode_kegiatan',
            'kode_unit_statistik',
            'provinsi',
            'kabupaten',
            'kecamatan',
            'kelurahan',
            'alamat_sbr',
            'telepon',
            'kode_kondisi_perusahaan',
            'kode_kategori',
            'nama_petugas',
        ]];
    }
}
