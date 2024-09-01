<?php

namespace App\Http\Controllers\Pegawai;

use App\Exports\DownloadUpdatePerusahaan;
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
        return Excel::download(new DownloadUpdatePerusahaan($perusahaan),
            $pembaruan->pegawai->nama_pegawai.'-'.
            $pembaruan->kegiatanStatistik->nama_kegiatan.'-'.
            $id_pembaruan.'.xlsx'
        );
    }

    public function prosesAproval($id_pembaruan){
        try{
            $perusahaanSementaras = PerusahaanSementara::where('id_pembaruan',$id_pembaruan)->get();
            $pembaruan = Pembaruan::find($id_pembaruan);
            // dd($perusahaanSementaras);
            foreach ($perusahaanSementaras as $perusahaanSementara){
                $perusahaan = Perusahaan::find($perusahaanSementara->id_perusahaan);
                if($perusahaan){
                    $perusahaan->update([
                        // Blok 1
                        'ada_sbr' => $perusahaanSementara->ada_sbr,
                        'id_sbr' => $perusahaanSementara->id_sbr,
                        'tanggal_cacah_pertama' => $perusahaanSementara->tanggal_cacah_pertama,
                        'tanggal_cacah_terakhir' => $perusahaanSementara->tanggal_cacah_terakhir,
                        'nama_usaha' => $perusahaanSementara->nama_usaha,
                        'nama_komersial' => $perusahaanSementara->nama_komersial,
                        'nip' => $perusahaanSementara->nip,
                        'nama_petugas' => $perusahaanSementara->nama_petugas,
                        'kode_kegiatan' => $perusahaanSementara->kode_kegiatan,
                        'kode_unit_statistik' => $perusahaanSementara->kode_unit_statistik,
                        'provinsi' => $perusahaanSementara->provinsi,
                        'kabupaten' => $perusahaanSementara->kabupaten,
                        'kecamatan' => $perusahaanSementara->kecamatan,
                        'kelurahan' => $perusahaanSementara->kelurahan,
                        'alamat_sbr' => $perusahaanSementara->alamat_sbr,
                        'telepon' => $perusahaanSementara->telepon,
                        'kode_kondisi_perusahaan' => $perusahaanSementara->kode_kondisi_perusahaan,
                        'kode_kategori' => $perusahaanSementara->kode_kategori,
                    ]);

                    $tanggal = Carbon::now()->day;
                    $bulan = Carbon::now()->month;
                    $tahun = Carbon::now()->year;
                    $id_perusahaan = $perusahaan->id_perusahaan;
                    $perusahaanKegiatan = PerusahaanKegiatan::where('kode_kegiatan',$perusahaanSementara->kode_kegiatan)
                    ->when($id_perusahaan, function ($query) use ($id_perusahaan) {
                        return $query->where('id_perusahaan', $id_perusahaan);
                    })->first();
                    // dd($perusahaanKegiatan);
                    $perusahaanKegiatan->update([
                        'kode_kegiatan' => $perusahaanSementara->kode_kegiatan,
                        'id_perusahaan' => $id_perusahaan,
                        'id_petugas' => 0,
                        'nama_petugas' => $perusahaanSementara->nama_petugas,
                        'nip' => $perusahaan->nip,
                        'aktivitas' => 'pemutakhiran data perusahaan',
                        'tanggal_kegiatan' => $tahun.'-'.$bulan.'-'.$tanggal,
                        'tanggal_penginputan' => $tahun.'-'.$bulan.'-'.$tanggal,
                        'reverse_kegiatan' => $tanggal.'-'.$bulan.'-'.$tahun,
                        'reverse_penginputan' => $tanggal.'-'.$bulan.'-'.$tahun,
                        'keterangan' => 'telah diupdating',
                        'status' => !empty($perusahaanSementara->kondisiPerusahaan->nama_kondisi_perusahaan)? $perusahaanSementara->kondisiPerusahaan->nama_kondisi_perusahaan:'belum diisi',
                    ]);
                }else{
                    $jumlah = Perusahaan::all()->count() + 1;
                    // dd($perusahaanSementara);
                    $newPerusahaan = Perusahaan::create([
                        // Blok 1
                        'id_perusahaan' => 'prs'.$jumlah,
                        'ada_sbr' => $perusahaanSementara->ada_sbr,
                        'id_sbr' => ($perusahaanSementara->ada_sbr === 'tidak ada')? 'prs'.$jumlah : $perusahaanSementara->id_sbr,
                        'tanggal_cacah_pertama' => $perusahaanSementara->tanggal_cacah_pertama,
                        'tanggal_cacah_terakhir' => $perusahaanSementara->tanggal_cacah_terakhir,
                        'nama_usaha' => $perusahaanSementara->nama_usaha,
                        'nama_komersial' => $perusahaanSementara->nama_komersial,
                        'nip' => $perusahaanSementara->nip,
                        'nama_petugas' => $perusahaanSementara->nama_petugas,
                        'kode_kegiatan' => $perusahaanSementara->kode_kegiatan,
                        'kode_unit_statistik' => $perusahaanSementara->kode_unit_statistik,
                        'provinsi' => $perusahaanSementara->provinsi,
                        'kabupaten' => $perusahaanSementara->kabupaten,
                        'kecamatan' => $perusahaanSementara->kecamatan,
                        'kelurahan' => $perusahaanSementara->kelurahan,
                        'alamat_sbr' => $perusahaanSementara->alamat_sbr,
                        'telepon' => $perusahaanSementara->telepon,
                        'kode_kondisi_perusahaan' => $perusahaanSementara->kode_kondisi_perusahaan,
                        'kode_kategori' => $perusahaanSementara->kode_kategori,
                    ]);

                    $tanggal = Carbon::now()->day;
                    $bulan = Carbon::now()->month;
                    $tahun = Carbon::now()->year;
                    $id_perusahaan = $perusahaanSementara->id_perusahaan;
                    $perusahaanKegiatan = PerusahaanKegiatan::where('kode_kegiatan',$perusahaanSementara->kode_kegiatan)
                    ->when($id_perusahaan, function ($query) use ($id_perusahaan) {
                        return $query->where('id_perusahaan', $id_perusahaan);
                    })->first();
                    // dd($perusahaanSementara->kondisiPerusahaan->nama_kondisi_perusahaan,);
                    $perusahaanKegiatan->update([
                        'kode_kegiatan' => $perusahaanSementara->kode_kegiatan,
                        'id_perusahaan' => 'prs'.$jumlah,
                        'id_petugas' => 0,
                        'nama_petugas' => $perusahaanSementara->nama_petugas,
                        'nip' => $newPerusahaan->nip,
                        'aktivitas' => 'penambahan perusahaan baru',
                        'tanggal_kegiatan' => $tahun.'-'.$bulan.'-'.$tanggal,
                        'tanggal_penginputan' => $tahun.'-'.$bulan.'-'.$tanggal,
                        'reverse_kegiatan' => $tanggal.'-'.$bulan.'-'.$tahun,
                        'reverse_penginputan' => $tanggal.'-'.$bulan.'-'.$tahun,
                        'keterangan' => 'telah diupdating',
                        'status' => !empty($perusahaanSementara->kondisiPerusahaan->nama_kondisi_perusahaan)? $perusahaanSementara->kondisiPerusahaan->nama_kondisi_perusahaan:'belum diisi',
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
            $pembaruan = Pembaruan::find($id_pembaruan);
            $pembaruan->update([
                'keterangan' => 'perubahan perlu diperbaiki',
            ]);
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
