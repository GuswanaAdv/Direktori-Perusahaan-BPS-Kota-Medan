<?php

namespace App\Http\Controllers;

use App\Models\Petugas;
use Illuminate\Http\Request;

class PetugasController extends Controller
{
    public function tampil()
    {   
        $petugass = Petugas::with(["perusahaanKegiatan"])->paginate(5);
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
            'judul' => 'Petugas',
            'petugas' => $petugas,
        ]);
    }

    public function search2(){
        $search = request('search');
        $petugass = Petugas::where('nama_petugas', 'like', "%$search%")
                    ->orWhere('jenis_kelamin', 'like', "%$search%")
                    ->orWhere('usia', 'like', "%$search%")
                    ->orWhere('no_wa', 'like', "%$search%")
                    ->orWhere('alamat', 'like', "%$search%")
                    ->paginate(5);
        $message = $petugass->isEmpty() ? 'tidak ditemukan' : '';

        return view('page.petugas',[
            'judul' => 'Petugas',
            'petugass' => $petugass,
            'cari' => $search,
            'pesan' => $message,
        ]);
    }
}
