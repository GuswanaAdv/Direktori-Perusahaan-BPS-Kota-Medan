<?php

namespace App\Http\Controllers\Pegawai;

use App\Exports\PerusahaanAprove;
use App\Models\PerusahaanSementara;
use App\Models\Perusahaan;
use App\Models\KegiatanStatistik;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use App\Models\Pembaruan;
use App\Models\PerusahaanKegiatan;

class PerusahaanAprovalController extends Controller
{
    public function tampilAprovalKetuaTim()
    {
        $pembaruans = Pembaruan::all();
        return view('page-pegawai.perusahaan.perusahaan-aproval-ketuatim',[
            'judul' => 'Perusahaan',
            'cari' => "-",
            'pesan' => "-",
            'pembaruans' => $pembaruans,
        ]);
    }

    public function tampilAprovalStaff()
    {
        $pembaruans = Pembaruan::all();
        return view('page-pegawai.perusahaan.perusahaan-aproval-staff',[
            'judul' => 'Perusahaan',
            'cari' => "-",
            'pesan' => "-",
            'pembaruans' => $pembaruans,
        ]);
    }

    public function downloadAproval($id_pembaruan){
        $perusahaan = PerusahaanSementara::where('id_pembaruan',$id_pembaruan)->get();
        $pembaruan = Pembaruan::find($id_pembaruan);
        return Excel::download(new PerusahaanAprove($perusahaan),
            $pembaruan->pegawai->nama_pegawai.'-'.
            $pembaruan->kegiatanStatistik->nama_kegiatan.'-'.
            $id_pembaruan.'.xlsx'
        );
    }

    public function prosesAproval($id_pembaruan){
        try{
            $perusahaanSementaras = PerusahaanSementara::where('id_pembaruan',$id_pembaruan)->get();
            $pembaruan = Pembaruan::find($id_pembaruan);
            foreach ($perusahaanSementaras as $perusahaanSementara){
                $perusahaan = Perusahaan::find($perusahaanSementara->id_perusahaan);
                if($perusahaan){
                    $perusahaan->update([
                        // Blok 1
                        'id_sbr' => $perusahaanSementara->id_sbr,
                        'tanggal_cacah_pertama' => $perusahaanSementara->tanggal_cacah_pertama,
                        'tanggal_cacah_terakhir' => $perusahaanSementara->tanggal_cacah_terakhir,
                        'nama_usaha' => $perusahaanSementara->nama_usaha,
                        'nama_komersial' => $perusahaanSementara->nama_komersial,
                        'nip' => $perusahaanSementara->nip,
                        'kode_unit_statistik' => $perusahaanSementara->kode_unit_statistik,
                        'provinsi' => $perusahaanSementara->provinsi,
                        'kabupaten' => $perusahaanSementara->kabupaten,
                        'kecamatan' => $perusahaanSementara->kecamatan,
                        'kelurahan' => $perusahaanSementara->kelurahan,
                        'nama_sls' => $perusahaanSementara->nama_sls,
                        'alamat_sbr' => $perusahaanSementara->alamat_sbr,
                        'alamat_pencacahan' => $perusahaanSementara->alamat_pencacahan,
                        'kode_pos' => $perusahaanSementara->kode_pos,
                        'telepon' => $perusahaanSementara->telepon,
                        'email' => $perusahaanSementara->email,
                        'website' => $perusahaanSementara->website,
                        'kode_kondisi_perusahaan' => $perusahaanSementara->kode_kondisi_perusahaan,
                        'lattitude' => $perusahaanSementara->lattitude,
                        'longitude' => $perusahaanSementara->longitude,
                        // Blok 2
                        'kegiatan_utama' => $perusahaanSementara->kegiatan_utama,
                        'kode_kbli' => $perusahaanSementara->kode_kbli,
                        'produk_utama' => $perusahaanSementara->produk_utama,
                        'kode_kbki' => $perusahaanSementara->kode_kbki,
                        'kode_jenis_kepemilikan' => $perusahaanSementara->kode_jenis_kepemilikan,
                        'kode_bentuk_badan_usaha' => $perusahaanSementara->kode_bentuk_badan_usaha,
                        'kode_laporan_keuangan' => $perusahaanSementara->kode_laporan_keuangan,
                        'tahun_berdiri' => $perusahaanSementara->tahun_berdiri,
                        'tahun_mulai_beroperasi' => $perusahaanSementara->tahun_mulai_beroperasi,
                        'no_induk_berusaha' => $perusahaanSementara->no_induk_berusaha,
                        'kode_skala_usaha' => $perusahaanSementara->kode_skala_usaha,
                        'kode_jaringan_usaha' => $perusahaanSementara->kode_jaringan_usaha,
                        'kode_preferensi' => $perusahaanSementara->kode_preferensi,
                        'nama_kantor_pusat' => $perusahaanSementara->nama_kantor_pusat,
                        'alamat_kantor_pusat' => $perusahaanSementara->alamat_kantor_pusat,
                        'email_kantor_pusat' => $perusahaanSementara->email_kantor_pusat,
                        'negara_kantor_pusat' => $perusahaanSementara->negara_kantor_pusat,
                        'provinsi_kantor_pusat' => $perusahaanSementara->provinsi_kantor_pusat,
                        'kabupaten_kantor_pusat' => $perusahaanSementara->kabupaten_kantor_pusat,
                        'kecamatan_kantor_pusat' => $perusahaanSementara->kecamatan_kantor_pusat,
                        // Blok 3
                        'nama_penanggungjawab' => $perusahaanSementara->nama_penanggungjawab,
                        'jenis_kelamin_penanggungjawab' => $perusahaanSementara->jenis_kelamin_penanggungjawab,
                        'tanggal_lahir_penanggungjawab' => $perusahaanSementara->tanggal_lahir_penanggungjawab,
                        'kewarganegaraan_penanggungjawab' => $perusahaanSementara->kewarganegaraan_penanggungjawab,
                        'kode_jabatan_penanggungjawab' => $perusahaanSementara->kode_jabatan_penanggungjawab,
                        'nama_pemegang_saham' => $perusahaanSementara->nama_pemegang_saham,
                        'npwp_perusahaan' => $perusahaanSementara->npwp_perusahaan,
                        'kode_status_penanaman_modal' => $perusahaanSementara->kode_status_penanaman_modal,
                    ]);

                    $tanggal = Carbon::now()->day;
                    $bulan = Carbon::now()->month;
                    $tahun = Carbon::now()->year;
                    PerusahaanKegiatan::create([
                        'kode_kegiatan' => $perusahaanSementara->kode_kegiatan,
                        'id_perusahaan' => $perusahaan->id_perusahaan,
                        'id_petugas' => 0,
                        'nip' => $perusahaan->nip,
                        'aktivitas' => 'pemutakhiran data perusahaan',
                        'tanggal_kegiatan' => $tahun.'-'.$bulan.'-'.$tanggal,
                        'tanggal_penginputan' => $tahun.'-'.$bulan.'-'.$tanggal,
                        'reverse_kegiatan' => $tanggal.'-'.$bulan.'-'.$tahun,
                        'reverse_penginputan' => $tanggal.'-'.$bulan.'-'.$tahun,
                        'keterangan' => $pembaruan->keterangan,
                    ]);
                }else{
                    $jumlah = Perusahaan::all()->count() + 1;
                    $newPerusahaan = Perusahaan::create([
                        // Blok 1
                        'id_perusahaan' => 'prs'.$jumlah,
                        'id_sbr' => $perusahaanSementara->id_sbr,
                        'tanggal_cacah_pertama' => $perusahaanSementara->tanggal_cacah_pertama,
                        'tanggal_cacah_terakhir' => $perusahaanSementara->tanggal_cacah_terakhir,
                        'nama_usaha' => $perusahaanSementara->nama_usaha,
                        'nama_komersial' => $perusahaanSementara->nama_komersial,
                        'nip' => $perusahaanSementara->nip,
                        'kode_unit_statistik' => $perusahaanSementara->kode_unit_statistik,
                        'provinsi' => $perusahaanSementara->provinsi,
                        'kabupaten' => $perusahaanSementara->kabupaten,
                        'kecamatan' => $perusahaanSementara->kecamatan,
                        'kelurahan' => $perusahaanSementara->kelurahan,
                        'nama_sls' => $perusahaanSementara->nama_sls,
                        'alamat_sbr' => $perusahaanSementara->alamat_sbr,
                        'alamat_pencacahan' => $perusahaanSementara->alamat_pencacahan,
                        'kode_pos' => $perusahaanSementara->kode_pos,
                        'telepon' => $perusahaanSementara->telepon,
                        'email' => $perusahaanSementara->email,
                        'website' => $perusahaanSementara->website,
                        'kode_kondisi_perusahaan' => $perusahaanSementara->kode_kondisi_perusahaan,
                        'lattitude' => $perusahaanSementara->lattitude,
                        'longitude' => $perusahaanSementara->longitude,
                        // Blok 2
                        'kegiatan_utama' => $perusahaanSementara->kegiatan_utama,
                        'kode_kbli' => $perusahaanSementara->kode_kbli,
                        'produk_utama' => $perusahaanSementara->produk_utama,
                        'kode_kbki' => $perusahaanSementara->kode_kbki,
                        'kode_jenis_kepemilikan' => $perusahaanSementara->kode_jenis_kepemilikan,
                        'kode_bentuk_badan_usaha' => $perusahaanSementara->kode_bentuk_badan_usaha,
                        'kode_laporan_keuangan' => $perusahaanSementara->kode_laporan_keuangan,
                        'tahun_berdiri' => $perusahaanSementara->tahun_berdiri,
                        'tahun_mulai_beroperasi' => $perusahaanSementara->tahun_mulai_beroperasi,
                        'no_induk_berusaha' => $perusahaanSementara->no_induk_berusaha,
                        'kode_skala_usaha' => $perusahaanSementara->kode_skala_usaha,
                        'kode_jaringan_usaha' => $perusahaanSementara->kode_jaringan_usaha,
                        'kode_preferensi' => $perusahaanSementara->kode_preferensi,
                        'nama_kantor_pusat' => $perusahaanSementara->nama_kantor_pusat,
                        'alamat_kantor_pusat' => $perusahaanSementara->alamat_kantor_pusat,
                        'email_kantor_pusat' => $perusahaanSementara->email_kantor_pusat,
                        'negara_kantor_pusat' => $perusahaanSementara->negara_kantor_pusat,
                        'provinsi_kantor_pusat' => $perusahaanSementara->provinsi_kantor_pusat,
                        'kabupaten_kantor_pusat' => $perusahaanSementara->kabupaten_kantor_pusat,
                        'kecamatan_kantor_pusat' => $perusahaanSementara->kecamatan_kantor_pusat,
                        // Blok 3
                        'nama_penanggungjawab' => $perusahaanSementara->nama_penanggungjawab,
                        'jenis_kelamin_penanggungjawab' => $perusahaanSementara->jenis_kelamin_penanggungjawab,
                        'tanggal_lahir_penanggungjawab' => $perusahaanSementara->tanggal_lahir_penanggungjawab,
                        'kewarganegaraan_penanggungjawab' => $perusahaanSementara->kewarganegaraan_penanggungjawab,
                        'kode_jabatan_penanggungjawab' => $perusahaanSementara->kode_jabatan_penanggungjawab,
                        'nama_pemegang_saham' => $perusahaanSementara->nama_pemegang_saham,
                        'npwp_perusahaan' => $perusahaanSementara->npwp_perusahaan,
                        'kode_status_penanaman_modal' => $perusahaanSementara->kode_status_penanaman_modal,
                    ]);

                    $tanggal = Carbon::now()->day;
                    $bulan = Carbon::now()->month;
                    $tahun = Carbon::now()->year;
                    PerusahaanKegiatan::create([
                        'kode_kegiatan' => $perusahaanSementara->kode_kegiatan,
                        'id_perusahaan' => 'prs'.$jumlah,
                        'id_petugas' => 0,
                        'nip' => $newPerusahaan->nip,
                        'aktivitas' => 'penambahan perusahaan baru',
                        'tanggal_kegiatan' => $tahun.'-'.$bulan.'-'.$tanggal,
                        'tanggal_penginputan' => $tahun.'-'.$bulan.'-'.$tanggal,
                        'reverse_kegiatan' => $tanggal.'-'.$bulan.'-'.$tahun,
                        'reverse_penginputan' => $tanggal.'-'.$bulan.'-'.$tahun,
                        'keterangan' => $pembaruan->keterangan,
                    ]);
                }
            }

            foreach ($perusahaanSementaras as $perusahaanSementara){
                $perusahaanSementara->delete();
            }
            $pembaruan->delete();
            return redirect()->route('perusahaan-aproval-ketuatim')->with('pesanAproval','Data berhasil di aproval');
        }catch(\Exception $e){
            // Tangkap exception dan alihkan halaman kembali dengan pesan error
            $message = $e->getMessage();
            $messageArray = explode(' ', $message);

            // Jika panjang pesan kurang dari atau sama dengan 30 karakter, gunakan pesan tersebut
            if (count($messageArray) < 12) {
                $result = $message;
            } else {
                // Ambil 11 elemen pertama
                $first11Elements = array_slice($messageArray, 0, 12);

                // Gabungkan elemen-elemen tersebut menjadi string
                $result = implode(' ', $first11Elements);
            }
            return redirect()->route('perusahaan-aproval-ketuatim')->with('pesanAproval','Data gagal di aproval : '.$result);
        }

    }

    public function tolakAproval($id_pembaruan){
        try{
            $perusahaanSementaras = PerusahaanSementara::where('id_pembaruan',$id_pembaruan)->get();
            foreach ($perusahaanSementaras as $perusahaanSementara){
                $perusahaanSementara->delete();
            }
            $pembaruan = Pembaruan::find($id_pembaruan);
            $pembaruan->delete();
            return redirect()->route('perusahaan-aproval-ketuatim')->with('pesanAproval','Data berhasil di tolak');
        }catch(\Exception $e){
            // Tangkap exception dan alihkan halaman kembali dengan pesan error
            $message = $e->getMessage();
            $messageArray = explode(' ', $message);

            // Jika panjang pesan kurang dari atau sama dengan 30 karakter, gunakan pesan tersebut
            if (count($messageArray) < 12) {
                $result = $message;
            } else {
                // Ambil 11 elemen pertama
                $first11Elements = array_slice($messageArray, 0, 12);

                // Gabungkan elemen-elemen tersebut menjadi string
                $result = implode(' ', $first11Elements);
            }
            return redirect()->route('perusahaan-aproval-ketuatim')->with('pesanAproval','Data gagal di tolak : '.$result);
        }
    }

}
