<?php

namespace App\Http\Controllers;

use App\Models\Petugas;
use Illuminate\Http\Request;

class PetugasController extends Controller
{
    public function tampil()
    {   
        $petugass = Petugas::paginate(6);
        return view('page.petugas',[
            'judul' => 'Petugas',
            'petugass' => $petugass,
            'cari' => "-",
            'pesan' => "-",
        ]);
    }

    public function lengkap($id_petugas)
    {   
        $petugas = Petugas::with(['jenisKepemilikan'])->where('id_petugas', $id_petugas)->first();

        return view('page.petugas.petugas-view',[
            'judul' => 'petugas Statistik',
            'petugas' => $petugas,
        ]);
    }

    public function search2(){
        $search = request('search');
        $petugass = Petugas::where('nama_petugas', 'like', "%$search%")->paginate(6);
        $message = $petugass->isEmpty() ? 'tidak ditemukan' : '';

        return view('page.petugas',[
            'judul' => 'Kegiatan Statistik',
            'petugass' => $petugass,
            'cari' => $search,
            'pesan' => $message,
        ]);
    }
}
