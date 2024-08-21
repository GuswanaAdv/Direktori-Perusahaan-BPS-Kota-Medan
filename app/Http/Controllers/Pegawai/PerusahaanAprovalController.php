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

class PerusahaanAprovalController extends Controller
{
    public function tampilAproval()
    {
        $pembaruans = Pembaruan::all();
        return view('page-pegawai.perusahaan.perusahaan-aproval',[
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
        $perusahaanSementaras = PerusahaanSementara::where('id_pembaruan',$id_pembaruan)->get();
        foreach ($perusahaanSementaras as $perusahaanSementara){
            $perusahaan = Perusahaan::where('id_perusahaan', $perusahaanSementara->id_perusahaan)->first();
            if($perusahaan){

            }
        }
    }

}
