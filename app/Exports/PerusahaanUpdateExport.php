<?php

namespace App\Exports;
use App\Models\Perusahaan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;

class PerusahaanUpdateExport implements WithHeadings, FromCollection, WithMapping, WithTitle
{
    protected $input;
    public function __construct($input)
    {
        $this->input = $input;
    }

    public function collection()
    {
        return $this->input;
    }

    public function map($input): array
    {
        $perusahaan = Perusahaan::find($input);
        return [
            'id_perusahaan' => $perusahaan->id_perusahaan,
            'id_sbr' => $perusahaan->id_sbr,
            'tanggal_cacah_pertama' => $perusahaan->tanggal_cacah_pertama,
            'tanggal_cacah_terakhir' => $perusahaan->tanggal_cacah_terakhir,
            'nama_usaha' => $perusahaan->nama_usaha,
            'nama_komersial' => $perusahaan->nama_komersial,
            'nip' => $perusahaan->nip,
            'kode_unit_statistik' => strval($perusahaan->kode_unit_statistik),
            'provinsi' => $perusahaan->provinsi,
            'kabupaten' => $perusahaan->kabupaten,
            'kecamatan' => $perusahaan->kecamatan,
            'kelurahan' => $perusahaan->kelurahan,
            'nama_sls' => $perusahaan->nama_sls,
            'alamat_sbr' => $perusahaan->alamat_sbr,
            'alamat_pencacahan' => $perusahaan->alamat_pencacahan,
            'kode_pos' => $perusahaan->kode_pos,
            'telepon' => $perusahaan->telepon,
            'email' => $perusahaan->email,
            'website' => $perusahaan->website,
            'kode_kondisi_perusahaan' => $perusahaan->kode_kondisi_perusahaan,
            'lattitude' => strval($perusahaan->lattitude),
            'longitude' => strval($perusahaan->longitude),
            'kegiatan_utama' => $perusahaan->kegiatan_utama,
            'kode_kbli' => $perusahaan->kode_kbli,
            'produk_utama' => $perusahaan->produk_utama,
            'kode_kbki' => $perusahaan->kode_kbki,
            'kode_jenis_kepemilikan' => strval($perusahaan->kode_jenis_kepemilikan),
            'kode_bentuk_badan_usaha' => strval($perusahaan->kode_bentuk_badan_usaha),
            'kode_laporan_keuangan' => strval($perusahaan->kode_laporan_keuangan),
            'tahun_berdiri' => $perusahaan->tahun_berdiri,
            'tahun_mulai_beroperasi' => $perusahaan->tahun_mulai_beroperasi,
            'no_induk_berusaha' => $perusahaan->no_induk_berusaha,
            'kode_skala_usaha' => strval($perusahaan->kode_skala_usaha),
            'kode_jaringan_usaha' => strval($perusahaan->kode_jaringan_usaha),
            'kode_preferensi' => strval($perusahaan->kode_preferensi),
            'nama_kantor_pusat' => $perusahaan->nama_kantor_pusat,
            'alamat_kantor_pusat' => $perusahaan->alamat_kantor_pusat,
            'email_kantor_pusat' => $perusahaan->email_kantor_pusat,
            'negara_kantor_pusat' => $perusahaan->negara_kantor_pusat,
            'provinsi_kantor_pusat' => $perusahaan->provinsi_kantor_pusat,
            'kabupaten_kantor_pusat' => $perusahaan->kabupaten_kantor_pusat,
            'kecamatan_kantor_pusat' => $perusahaan->kecamatan_kantor_pusat,
            'nama_penanggungjawab' => $perusahaan->nama_penanggungjawab,
            'jenis_kelamin_penanggungjawab' => $perusahaan->jenis_kelamin_penanggungjawab,
            'tanggal_lahir_penanggungjawab' => $perusahaan->tanggal_lahir_penanggungjawab,
            'kewarganegaraan_penanggungjawab' => $perusahaan->kewarganegaraan_penanggungjawab,
            'kode_jabatan_penanggungjawab' => strval($perusahaan->kode_jabatan_penanggungjawab),
            'nama_pemegang_saham' => $perusahaan->nama_pemegang_saham,
            'npwp_perusahaan' => $perusahaan->npwp_perusahaan,
            'kode_status_penanaman_modal' => strval($perusahaan->kode_status_penanaman_modal),
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
