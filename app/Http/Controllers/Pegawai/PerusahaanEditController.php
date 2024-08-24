<?php

namespace App\Http\Controllers\Pegawai;

use App\Models\UnitStatistik;
use App\Models\KegiatanStatistik;
use App\Models\KondisiPerusahaan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use App\Models\PreferensiLokasiPencacahan;
use App\Models\JenisKepemilikan;
use App\Models\BentukBadanUsaha;
use App\Models\LaporanKeuangan;
use App\Models\SkalaUsaha;
use App\Models\JaringanUsaha;
use App\Models\JabatanPenanggungjawab;
use App\Models\StatusPenanamanModal;
use App\Models\Perusahaan;
use App\Models\Pembaruan;
use App\Models\PerusahaanSementara;

class PerusahaanEditController extends Controller
{

public function tampilEdit1($id_perusahaan)
    {
        $unitStatistiks = UnitStatistik::all();
        $kondisiPerusahaans = KondisiPerusahaan::all();
        $jenisKepemilikans = JenisKepemilikan::all();
        $bentukBadanUsahas = BentukBadanUsaha::all();
        $laporanKeuangans = LaporanKeuangan::all();
        $skalaUsahas = SkalaUsaha::all();
        $jaringanUsahas = JaringanUsaha::all();
        $preferensis = PreferensiLokasiPencacahan::all();
        $jabatanPenanggungjawabs = JabatanPenanggungjawab::all();
        $statusPenanamanModals = StatusPenanamanModal::all();
        $perusahaan = Perusahaan::find($id_perusahaan);

        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;
        $today = Carbon::now()->day;

        $kegiatans = KegiatanStatistik::orderBy('tanggal_mulai', 'desc')
        ->when($currentMonth, function ($query) use ($currentMonth) {
            return $query->whereMonth('tanggal_mulai','>=', $currentMonth);
        })
        ->when($currentYear, function ($query) use ($currentYear) {
            return $query->whereYear('tanggal_mulai', $currentYear);
        })
        ->whereDate('tanggal_mulai', '>=', $today)->get();

        return view('page-pegawai.perusahaan.edit.perusahaan-edit1',[
            'judul' => 'Perusahaan',
            'cari' => "-",
            'pesan' => "-",
            'unitStatistiks' => $unitStatistiks,
            'kondisiPerusahaans' => $kondisiPerusahaans,
            'id_perusahaan' => $id_perusahaan,
            'kegiatans'=> $kegiatans,
            'jenisKepemilikans' => $jenisKepemilikans,
            'bentukBadanUsahas' => $bentukBadanUsahas,
            'laporanKeuangans' => $laporanKeuangans,
            'skalaUsahas' => $skalaUsahas,
            'jaringanUsahas' => $jaringanUsahas,
            'preferensis' => $preferensis,
            'jabatanPenanggungjawabs' => $jabatanPenanggungjawabs,
            'statusPenanamanModals' => $statusPenanamanModals,
            'perusahaan' => $perusahaan,
        ]);
    }

    public function prosesEdit1(Request $request){
        try{
            $this->validate($request, [
                // Blok 1
                'nip' => 'required',
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
                // Blok 2
                'kegiatan-utama' => 'required',
                'kode-kbli' => 'required',
                'produk-utama' => 'required',
                'kode-kbki' => 'required',
                'kode-jenis-kepemilikan' => 'required',
                'kode-bentuk-badan-usaha' => 'required',
                'kode-laporan-keuangan' => 'required',
                'tahun-berdiri' => 'required',
                'tahun-mulai-beroperasi' => 'required',
                'no-induk-berusaha' => 'required',
                'kode-skala-usaha' => 'required',
                'kode-jaringan-usaha' => 'required',
                'kode-preferensi' => 'required',
                'nama-kantor-pusat' => 'required',
                'alamat-kantor-pusat' => 'required',
                'email-kantor-pusat' => 'required',
                'negara-kantor-pusat' => 'required',
                'provinsi-kantor-pusat' => 'required',
                'kabupaten-kantor-pusat' => 'required',
                'kecamatan-kantor-pusat' => 'required',
                // Blok 3
                'nama-penanggungjawab' => 'required',
                'jenis-kelamin-penanggungjawab' => 'required',
                'tanggal-lahir-penanggungjawab' => 'required',
                'kewarganegaraan-penanggungjawab' => 'required',
                'kode-jabatan-penanggungjawab' => 'required',
                'nama-pemegang-saham' => 'required',
                'npwp-perusahaan' => 'required',
                'kode-status-penanaman-modal' => 'required',
            ]);

            $pembaruan = Pembaruan::create([
                'nip' => $request->input('nip'),
                'kode_kegiatan' => $request->input('kode-kegiatan'),
                'keterangan'=> 'mengedit perusahaan',
            ]);

            $tanggal = Carbon::now()->day;
            $bulan = Carbon::now()->month;
            $tahun = Carbon::now()->year;

            PerusahaanSementara::create([
                // Blok 1
                'id_perusahaan' => $request->input('id-perusahaan'),
                'id_sbr' => $request->input('id-sbr'),
                'tanggal_cacah_pertama' => $tahun.'-'.$bulan.'-'.$tanggal,
                'tanggal_cacah_terakhir' => $tahun.'-'.$bulan.'-'.$tanggal,
                'nip' => $request->input('nip'),
                'kode_kegiatan' => $request->input('kode-kegiatan'),
                'id_pembaruan' => $pembaruan->id_pembaruan,
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
                'kegiatan_utama' => $request->input('kegiatan-utama'),
                'kode_kbli' => $request->input('kode-kbli'),
                'produk_utama' => $request->input('produk-utama'),
                'kode_kbki' => $request->input('kode-kbki'),
                'kode_jenis_kepemilikan' => $request->input('kode-jenis-kepemilikan'),
                'kode_bentuk_badan_usaha' => $request->input('kode-bentuk-badan-usaha'),
                'kode_laporan_keuangan' => $request->input('kode-laporan-keuangan'),
                'tahun_berdiri' => $request->input('tahun-berdiri'),
                'tahun_mulai_beroperasi' => $request->input('tahun-mulai-beroperasi'),
                'no_induk_berusaha' => $request->input('no-induk-berusaha'),
                'kode_skala_usaha' => $request->input('kode-skala-usaha'),
                'kode_jaringan_usaha' => $request->input('kode-jaringan-usaha'),
                'kode_preferensi' => $request->input('kode-preferensi'),
                'nama_kantor_pusat' => $request->input('nama-kantor-pusat'),
                'alamat_kantor_pusat' => $request->input('alamat-kantor-pusat'),
                'email_kantor_pusat' => $request->input('email-kantor-pusat'),
                'negara_kantor_pusat' => $request->input('negara-kantor-pusat'),
                'provinsi_kantor_pusat' => $request->input('provinsi-kantor-pusat'),
                'kabupaten_kantor_pusat' => $request->input('kabupaten-kantor-pusat'),
                'kecamatan_kantor_pusat' => $request->input('kecamatan-kantor-pusat'),
                // Blok 3
                'nama_penanggungjawab' => $request->input('nama-penanggungjawab'),
                'jenis_kelamin_penanggungjawab' => $request->input('jenis-kelamin-penanggungjawab'),
                'tanggal_lahir_penanggungjawab' => $request->input('tanggal-lahir-penanggungjawab'),
                'kewarganegaraan_penanggungjawab' => $request->input('kewarganegaraan-penanggungjawab'),
                'kode_jabatan_penanggungjawab' => $request->input('kode-jabatan-penanggungjawab'),
                'nama_pemegang_saham' => $request->input('nama-pemegang-saham'),
                'npwp_perusahaan' => $request->input('npwp-perusahaan'),
                'kode_status_penanaman_modal' => $request->input('kode-status-penanaman-modal'),
            ]);

            return redirect()->route('perusahaan')->with('pesanEdit1', 'Perusahaan berhasil diedit');
        }catch(\Exception $e){
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
            return back()->with('pesanEdit1', 'Perusahaan gagal diedit : '.$result);
        }

    }
}
