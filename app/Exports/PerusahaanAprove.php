<?php

namespace App\Exports;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;

class PerusahaanAprove implements WithHeadings, FromCollection, WithMapping, WithTitle
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
            'id_sbr' => $row->id_sbr,
            'tanggal_cacah_pertama' => $row->tanggal_cacah_pertama,
            'tanggal_cacah_terakhir' => $row->tanggal_cacah_terakhir,
            'nama_usaha' => $row->nama_usaha,
            'nama_komersial' => $row->nama_komersial,
            'nip' => $row->nip,
            'kode_unit_statistik' => $row->kode_unit_statistik,
            'provinsi' => $row->provinsi,
            'kabupaten' => $row->kabupaten,
            'kecamatan' => $row->kecamatan,
            'kelurahan' => $row->kelurahan,
            'nama_sls' => $row->nama_sls,
            'alamat_sbr' => $row->alamat_sbr,
            'alamat_pencacahan' => $row->alamat_pencacahan,
            'kode_pos' => $row->kode_pos,
            'telepon' => $row->telepon,
            'email' => $row->email,
            'website' => $row->website,
            'kode_kondisi_perusahaan' => $row->kode_kondisi_perusahaan,
            'lattitude' => $row->lattitude,
            'longitude' => $row->longitude,
            'kegiatan_utama' => $row->kegiatan_utama,
            'kode_kbli' => $row->kode_kbli,
            'produk_utama' => $row->produk_utama,
            'kode_kbki' => $row->kode_kbki,
            'kode_jenis_kepemilikan' => $row->kode_jenis_kepemilikan,
            'kode_bentuk_badan_usaha' => $row->kode_bentuk_badan_usaha,
            'kode_laporan_keuangan' => $row->kode_laporan_keuangan,
            'tahun_berdiri' => $row->tahun_berdiri,
            'tahun_mulai_beroperasi' => $row->tahun_mulai_beroperasi,
            'no_induk_berusaha' => $row->no_induk_berusaha,
            'kode_skala_usaha' => $row->kode_skala_usaha,
            'kode_jaringan_usaha' => $row->kode_jaringan_usaha,
            'kode_preferensi' => $row->kode_preferensi,
            'nama_kantor_pusat' => $row->nama_kantor_pusat,
            'alamat_kantor_pusat' => $row->alamat_kantor_pusat,
            'email_kantor_pusat' => $row->email_kantor_pusat,
            'negara_kantor_pusat' => $row->negara_kantor_pusat,
            'provinsi_kantor_pusat' => $row->provinsi_kantor_pusat,
            'kabupaten_kantor_pusat' => $row->kabupaten_kantor_pusat,
            'kecamatan_kantor_pusat' => $row->kecamatan_kantor_pusat,
            'nama_penanggungjawab' => $row->nama_penanggungjawab,
            'jenis_kelamin_penanggungjawab' => $row->jenis_kelamin_penanggungjawab,
            'tanggal_lahir_penanggungjawab' => $row->tanggal_lahir_penanggungjawab,
            'kewarganegaraan_penanggungjawab' => $row->kewarganegaraan_penanggungjawab,
            'kode_jabatan_penanggungjawab' => $row->kode_jabatan_penanggungjawab,
            'nama_pemegang_saham' => $row->nama_pemegang_saham,
            'npwp_perusahaan' => $row->npwp_perusahaan,
            'kode_status_penanaman_modal' => $row->kode_status_penanaman_modal,
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
            'id_sbr',
            'tanggal_cacah_pertama',
            'tanggal_cacah_terakhir',
            'nama_usaha',
            'nama_komersial',
            'nip',
            'kode_unit_statistik',
            'provinsi',
            'kabupaten',
            'kecamatan',
            'kelurahan',
            'nama_sls',
            'alamat_sbr',
            'alamat_pencacahan',
            'kode_pos',
            'telepon',
            'email',
            'website',
            'kode_kondisi_perusahaan',
            'lattitude',
            'longitude',
            'kegiatan_utama',
            'kode_kbli',
            'produk_utama',
            'kode_kbki',
            'kode_jenis_kepemilikan',
            'kode_bentuk_badan_usaha',
            'kode_laporan_keuangan',
            'tahun_berdiri',
            'tahun_mulai_beroperasi',
            'no_induk_berusaha',
            'kode_skala_usaha',
            'kode_jaringan_usaha',
            'kode_preferensi',
            'nama_kantor_pusat',
            'alamat_kantor_pusat',
            'email_kantor_pusat',
            'negara_kantor_pusat',
            'provinsi_kantor_pusat',
            'kabupaten_kantor_pusat',
            'kecamatan_kantor_pusat',
            'nama_penanggungjawab',
            'jenis_kelamin_penanggungjawab',
            'tanggal_lahir_penanggungjawab',
            'kewarganegaraan_penanggungjawab',
            'kode_jabatan_penanggungjawab',
            'nama_pemegang_saham',
            'npwp_perusahaan',
            'kode_status_penanaman_modal',
        ]];
    }
}
