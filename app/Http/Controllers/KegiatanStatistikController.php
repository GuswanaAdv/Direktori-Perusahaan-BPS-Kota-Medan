<?php

namespace App\Http\Controllers;

use App\Models\KegiatanStatistik;
use Illuminate\Http\Request;

class KegiatanStatistikController extends Controller
{
    public function tampil()
    {   
        $kegiatanStatistiks = KegiatanStatistik::paginate(4);
        return view('page.kegiatan-statistik',[
            'judul' => 'Kegiatan Statistik',
            'kegiatanStatistiks' => $kegiatanStatistiks,
            'cari' => "-",
            'pesan' => "-",
        ]);
    }

    public function lengkap($id_kegiatan)
    {   
        $kegiatanStatistik = KegiatanStatistik::with(['jenisKepemilikan'])->where('id_kegiatan', $id_kegiatan)->first();

        return view('page.kegiatanStatistik.kegiatanStatistik-view',[
            'judul' => 'Kegiatan Statistik',
            'kegiatanStatistik' => $kegiatanStatistik,
        ]);
    }

    public function search2(){
        $search = request('search');
        $kegiatanStatistiks = KegiatanStatistik::where('nama_kegiatan', 'like', "%$search%")->paginate(10);
        $message = $kegiatanStatistiks->isEmpty() ? 'tidak ditemukan' : '';

        return view('page.kegiatan-statistik',[
            'judul' => 'Kegiatan Statistik',
            'kegiatanStatistiks' => $kegiatanStatistiks,
            'cari' => $search,
            'pesan' => $message,
        ]);
    }
    
}
