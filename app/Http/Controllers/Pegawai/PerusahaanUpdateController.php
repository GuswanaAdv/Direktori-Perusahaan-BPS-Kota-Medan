<?php

namespace App\Http\Controllers\Pegawai;

use App\Imports\PerusahaanImport;
use App\Imports\PerusahaanTambah;
use App\Models\Perusahaan;
use App\Models\PerusahaanKegiatan;
use App\Models\Pembaruan;
use App\Models\KegiatanStatistik;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;

class PerusahaanUpdateController extends Controller
{
    public function tampilUpdate()
    {
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;
        $today = Carbon::now()->day;

        $kegiatans = KegiatanStatistik::orderBy('tanggal_mulai', 'desc')
        ->when($currentMonth, function ($query) use ($currentMonth) {
            return $query->whereMonth('tanggal_mulai','>=', $currentMonth);
        })
        ->when($currentYear, function ($query) use ($currentYear) {
            return $query->whereYear('tanggal_mulai', $currentYear);
        })
        ->whereDate('tanggal_mulai', '>=', $today)
        ->get();

        $perusahaans = Perusahaan::orderBy('id_perusahaan', 'asc')->get();

        return view('page-pegawai.perusahaan.update.perusahaan-update',[
            'judul' => 'Perusahaan',
            'cari' => "-",
            'pesan' => "-",
            'kegiatans'=> $kegiatans,
            'perusahaans' => $perusahaans,
        ]);
    }

    public function search1(Request $request){
        $search = $request->search;
        if($request->ajax()){
            $output="";
            $perusahaans = Perusahaan::where('nama_usaha', 'like', "%$search%")
                        ->orWhere('nama_komersial', 'like', "%$search%")
                        ->orWhere('id_sbr', 'like', "%$search%")
                        ->orderBy('id_sbr', 'asc')->take(10)->get();

            if(!$perusahaans->isEmpty()){
                foreach($perusahaans as $perusahaan){
                    $output.=
                    '<tr>'.
                        '<td>'.$perusahaan->id_sbr.'</td>'.
                        '<td>'.$perusahaan->nama_usaha.'</td>'.
                        '<td>
                            <input type="checkbox"
                            class="checkbox perusahaan-checkbox"
                            id="perusahaan-checkbox'.$perusahaan->id_perusahaan.'"
                            data-nama="'.$perusahaan->id_perusahaan.'-'.$perusahaan->id_sbr.'-'.$perusahaan->nama_usaha.'"/>
                        </td>'.
                    '</tr>';
                }
                return response($output);
            }
            else{
                $notfound = '<tr class="text-red text-center">'.'Data tidak ditemukan'.'</tr>';
                return response($notfound);
            }
        }
    }
}
