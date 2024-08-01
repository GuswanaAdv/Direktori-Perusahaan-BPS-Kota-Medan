<?php

namespace App\Http\Controllers;

use App\Models\Perusahaan;
use Illuminate\Http\Request;

class PerusahaanController extends Controller
{
    public function tampil()
    {   
        $perusahaans = Perusahaan::paginate(10);
        return view('page.perusahaan.perusahaan',[
            'judul' => 'Perusahaan',
            'perusahaans' => $perusahaans,
            'cari' => "-",
            'pesan' => "-",
        ]);
    }

    public function lengkap($id_sbr)
    {   
        $perusahaan = Perusahaan::with(['jenisKepemilikan'])->where('id_sbr', $id_sbr)->first();

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

        return view('page.perusahaan.perusahaan-view',[
            'judul' => 'Perusahaan',
            'perusahaan' => $perusahaan,
            'initialMarkers' => $initialMarkers,
        ]);
    }

    public function search1(){
        $search = request('search');
        $perusahaans = Perusahaan::where('nama_usaha', 'like', "%$search%")->paginate(10);
        return view('page.perusahaan.perusahaan',[
            'judul' => 'Perusahaan',
            'perusahaans' => $perusahaans,
            'cari' => $search,
            'pesan' => "-",
        ]);
    }

    public function search2(){
        $search = request('search');
        $perusahaans = Perusahaan::where('nama_usaha', 'like', "%$search%")->paginate(10);
        $message = $perusahaans->isEmpty() ? 'tidak ditemukan' : '';

        return view('page.perusahaan.perusahaan',[
            'judul' => 'Perusahaan',
            'perusahaans' => $perusahaans,
            'cari' => $search,
            'pesan' => $message,
        ]);
    }
}
