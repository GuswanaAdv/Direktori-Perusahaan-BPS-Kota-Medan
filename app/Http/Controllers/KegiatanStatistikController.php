<?php

namespace App\Http\Controllers;

use App\Models\KegiatanStatistik;
use App\Models\PerusahaanKegiatan;
use Illuminate\Http\Request;

class KegiatanStatistikController extends Controller
{
    public function tampil()
    {   
        $kegiatanStatistiks = KegiatanStatistik::orderBy('tanggal_mulai', 'desc')->paginate(4);
        return view('page.kegiatan-statistik.kegiatan-statistik',[
            'judul' => 'Kegiatan Statistik',
            'kegiatanStatistiks' => $kegiatanStatistiks,
            'cari' => "-",
            'pesan' => "-",
        ]);
    }

    public function lengkap($kode_kegiatan)
    {   
        $kegiatanStatistik = KegiatanStatistik::where('kode_kegiatan', $kode_kegiatan)->first();
        $perusahaanKegiatans = PerusahaanKegiatan::with(['perusahaan','pegawai','petugas','kegiatanStatistik'])
        ->where('kode_kegiatan', $kode_kegiatan)->paginate(10);
        $message = $perusahaanKegiatans->isEmpty() ? 'tidak ditemukan' : '';

        return view('page.kegiatan-statistik.kegiatan-statistik-view',[
            'judul' => 'Kegiatan Statistik',
            'kegiatanStatistik' => $kegiatanStatistik,
            'perusahaanKegiatans' => $perusahaanKegiatans,
            'pesan' => $message,
        ]);
    }

    public function search2(){
        $search = request('search');
        $kegiatanStatistiks = KegiatanStatistik::where('nama_kegiatan', 'like', "%$search%")->
                                where('tanggal_mulai', 'like', "%$search%")->
                                orderBy('tanggal_mulai', 'desc')->paginate(10);
        $message = $kegiatanStatistiks->isEmpty() ? 'tidak ditemukan' : '';

        return view('page.kegiatan-statistik.kegiatan-statistik',[
            'judul' => 'Kegiatan Statistik',
            'kegiatanStatistiks' => $kegiatanStatistiks,
            'cari' => $search,
            'pesan' => $message,
        ]);
    }
    
}
