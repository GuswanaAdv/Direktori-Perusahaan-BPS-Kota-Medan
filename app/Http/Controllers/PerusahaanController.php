<?php

namespace App\Http\Controllers;

use App\Models\Perusahaan;
use App\Models\PerusahaanKegiatan;
use Illuminate\Http\Request;

class PerusahaanController extends Controller
{
    public function tampil()
    {
        $perusahaans = Perusahaan::paginate(10);
        return view('page-pegawai.perusahaan.perusahaan',[
            'judul' => 'Perusahaan',
            'perusahaans' => $perusahaans,
            'cari' => "-",
            'pesan' => "-",
        ]);
    }

    public function lengkap($id_sbr)
    {
        $perusahaan = Perusahaan::with(['jenisKepemilikan'])->where('id_sbr', $id_sbr)->first();
        $perusahaanKegiatans = PerusahaanKegiatan::with(['perusahaan','pegawai','petugas','kegiatanStatistik'])
        ->where('id_sbr', $id_sbr)->paginate(10);

        if ($perusahaan->lattitude != 0)
            $initialMarkers = [
                [
                    'position' => [
                        'lat' => $perusahaan->lattitude,
                        'lng' => $perusahaan->longitude
                    ],
                    'draggable' => true
                ],
            ];
        else
            $initialMarkers = 0;

        $message = $perusahaanKegiatans->isEmpty() ? 'tidak ditemukan' : '';

        return view('page-pegawai.perusahaan.perusahaan-view',[
            'judul' => 'Perusahaan',
            'perusahaan' => $perusahaan,
            'perusahaanKegiatans' => $perusahaanKegiatans,
            'initialMarkers' => $initialMarkers,
            'pesan' => $message,
        ]);
    }

    public function search1(){
        $search = request('search');
        $perusahaans = Perusahaan::where('nama_usaha', 'like', "%$search%")
                        ->orWhere('alamat_sbr','like',"%$search%")
                        ->paginate(10);
        return view('page-pegawai.perusahaan.perusahaan',[
            'judul' => 'Perusahaan',
            'perusahaans' => $perusahaans,
            'cari' => $search,
            'pesan' => "-",
        ]);
    }

    public function search2(){
        $search = request('search');
        $perusahaans = Perusahaan::where('nama_usaha', 'like', "%$search%")
                        ->orWhere('alamat_sbr','like',"%$search%")
                        ->paginate(10);
        $message = $perusahaans->isEmpty() ? 'tidak ditemukan' : '';

        return view('page-pegawai.perusahaan.perusahaan',[
            'judul' => 'Perusahaan',
            'perusahaans' => $perusahaans,
            'cari' => $search,
            'pesan' => $message,
        ]);
    }
}
