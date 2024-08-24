<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Models\KondisiPerusahaan;
use App\Models\Perusahaan;
use Illuminate\Http\Request;
use SebastianBergmann\CodeCoverage\Report\Xml\Unit;
use App\Models\UnitStatistik;
use App\Models\PerusahaanSementara;

class TambahPerusahaanController extends Controller
{
    public function tampilBlok1()
    {
        $unitStatistiks = UnitStatistik::all();
        $kondisiPerusahaans = KondisiPerusahaan::all();
        $tahun = Carbon::now()->year;
        $jumlah = Perusahaan::all()->count() + 1;
        $id_perusahaan = 'prs'.$jumlah;
        return view('page-petugas.tambah.perusahaan-tambah-blok1',[
            'judul' => 'Perusahaan',
            'cari' => "-",
            'pesan' => "-",
            'unitStatistiks' => $unitStatistiks,
            'kondisiPerusahaans' => $kondisiPerusahaans,
            'id_perusahaan' => $id_perusahaan,
        ]);
    }

    public function tampilBlok2()
    {
        $unitStatistiks = UnitStatistik::all();
        $kondisiPerusahaans = KondisiPerusahaan::all();
        return view('page-petugas.tambah.perusahaan-tambah-blok2',[
            'judul' => 'Perusahaan',
            'cari' => "-",
            'pesan' => "-",
            'unitStatistiks' => $unitStatistiks,
            'kondisiPerusahaans' => $kondisiPerusahaans,
        ]);
    }

    public function tambahBlok1(Request $request){
        try{
            $this->validate($request, [
                'id-petugas' => 'required',
                'kode-kegiatan' => 'required',
                'id-perusahaan' => 'required',
                'id-sbr' => 'required',
                'nama-usaha' => 'required',
                'nama-komersial' => 'required',
                'kode-unit-statistik' => 'required',
                'provinsi' => 'required',
                'kabupaten' => 'required',
                'kecamatan' => 'required',
                'kelurahan' => 'required',
                'nama-sls' => 'required',
                'alamat-sbr' => 'required',
                'alamat-pencacahan' => 'required',
                'kode-pos' => 'required',
                'telepon' => 'required',
                'email' => 'required',
                'website' => 'required',
                'kode-kondisi-perusahaan' => 'required',
                'lattitude' => 'required',
                'longitude' => 'required',
            ]);

            $hari = Carbon::now()->month;
            $bulan = Carbon::now()->month;
            $tahun = Carbon::now()->year;

            PerusahaanSementara::create([
                // Blok 1
                'id_perusahaan' => $request->input('id-perusahaan'),
                'nip' => $request->input('id-petugas'),
                'id_pembaruan' => 1,
                'kode_kegiatan' => $request->input('kode-kegiatan'),
                'id_sbr' => $request->input('id-sbr'),
                'tanggal_cacah_pertama' => $tahun.'-'.$bulan.'-'.$hari,
                'tanggal_cacah_terakhir' => $tahun.'-'.$bulan.'-'.$hari,
                'nama_usaha' => $request->input('nama-usaha'),
                'nama_komersial' => $request->input('nama-komersial'),
                'kode_unit_statistik' => $request->input('kode-unit-statistik'),
                'provinsi' => $request->input('provinsi'),
                'kabupaten' => $request->input('kabupaten'),
                'kecamatan' => $request->input('kecamatan'),
                'kelurahan' => $request->input('kelurahan'),
                'nama_sls' => $request->input('nama-sls'),
                'alamat_sbr' => $request->input('alamat-sbr'),
                'alamat_pencacahan' => $request->input('alamat-pencacahan'),
                'kode_pos' => $request->input('kode-pos'),
                'telepon' => $request->input('telepon'),
                'email' => $request->input('email'),
                'website' => $request->input('website'),
                'kode_kondisi_perusahaan' => $request->input('kode-kondisi-perusahaan'),
                'lattitude' => $request->input('lattitude'),
                'longitude' => $request->input('longitude'),
                // Blok 2
                'kegiatan_utama' => '-',
                'kode_kbli' => '0',
                'produk_utama' => '-',
                'kode_kbki' => '0',
                'kode_jenis_kepemilikan' => '0',
                'kode_bentuk_badan_usaha' => '0',
                'kode_laporan_keuangan' => '0',
                'tahun_berdiri' => '0',
                'tahun_mulai_beroperasi' => '0',
                'no_induk_berusaha' => '-',
                'kode_skala_usaha' => '0',
                'kode_jaringan_usaha' => '0',
                'kode_preferensi' => '0',
                'nama_kantor_pusat' => '-',
                'alamat_kantor_pusat' => '-',
                'email_kantor_pusat' => '-',
                'negara_kantor_pusat' => '-',
                'provinsi_kantor_pusat' => '-',
                'kabupaten_kantor_pusat' => '-',
                'kecamatan_kantor_pusat' => '-',
                // Blok 3
                'nama_penanggungjawab' => '-',
                'jenis_kelamin_penanggungjawab' => '-',
                'tanggal_lahir_penanggungjawab' => '-',
                'kewarganegaraan_penanggungjawab' => '-',
                'kode_jabatan_penanggungjawab' => '0',
                'nama_pemegang_saham' => '-',
                'npwp_perusahaan' => '-',
                'kode_status_penanaman_modal' => '0',
            ]);
            $unitStatistiks = UnitStatistik::all();
            $kondisiPerusahaans = KondisiPerusahaan::all();

            return redirect()->route('perusahaan-tambah-blok2')->with('pesanBlok','berhasil menambahkan blok');
        }catch (\Exception $e) {
            // Tangkap exception dan alihkan halaman kembali dengan pesan error
            $message = $e->getMessage();
            $messageArray = explode(' ', $message);

            // Jika panjang pesan kurang dari atau sama dengan 30 karakter, gunakan pesan tersebut
            if (count($messageArray) < 11) {
                $result = $message;
            } else {
                // Ambil 11 elemen pertama
                $first11Elements = array_slice($messageArray, 0, 11);

                // Gabungkan elemen-elemen tersebut menjadi string
                $result = implode(' ', $first11Elements);
            }
            return redirect()->route('perusahaan-tambah-blok1')->with('pesanBlok', 'terjadi kesalahan penambahan data : '.$result);
        }
    }
}
