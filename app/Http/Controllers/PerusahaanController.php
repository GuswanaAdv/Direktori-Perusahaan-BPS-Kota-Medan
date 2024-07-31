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
            'perusahaans' => $perusahaans
        ]);
    }

    public function lengkap($id_brs)
    {   
        $perusahaan = Perusahaan::with(['jenisKepemilikan'])->where('id_brs', $id_brs)->first();

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
            'initialMarkers' => $initialMarkers
        ]);
    }

    public function search1(){
        $search = request('search');
        $perusahaans = Perusahaan::where('nama_usaha', 'like', "%$search%")->paginate(10);
        return view('page.perusahaan.perusahaan',[
            'judul' => 'Perusahaan',
            'perusahaans' => $perusahaans
        ]);
    }

    public function search2(){
        $search = request('search');
        $perusahaans = Perusahaan::where('nama_usaha', 'like', "%$search%")->paginate(10);
        return view('page.perusahaan.perusahaan',[
            'judul' => 'Perusahaan',
            'perusahaans' => $perusahaans
        ]);
    }
}
