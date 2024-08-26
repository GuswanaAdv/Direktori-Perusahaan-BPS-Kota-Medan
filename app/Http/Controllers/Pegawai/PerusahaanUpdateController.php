<?php

namespace App\Http\Controllers\Pegawai;

use App\Exports\PerusahaanUpdateExport;
use App\Imports\PerusahaanUpdateImport;
use App\Models\Perusahaan;
use App\Models\PerusahaanKegiatan;
use App\Models\Pembaruan;
use App\Models\KegiatanStatistik;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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

        // $perusahaans = Perusahaan::orderBy('id_perusahaan', 'asc')->get();

        // return view('page-pegawai.perusahaan.update.perusahaan-update',[
        return view('page-pegawai.perusahaan.perusahaan-update',[
            'judul' => 'Perusahaan',
            'cari' => "-",
            'pesan' => "-",
            'kegiatans'=> $kegiatans,
            // 'perusahaans' => $perusahaans,
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

    public function download(Request $request){
        // Mengambil semua input sebagai array
        $inputData = array_values($request->input())[1];
        $input = collect($inputData);
        return Excel::download(new PerusahaanUpdateExport($input),
            Auth::user()->pegawai->nama_pegawai.'-updating.xlsx'
        );
    }

    public function prosesUpdate(Request $request){
        try{
            // validasi
            $this->validate($request, [
                'file' => 'required|mimes:csv,xls,xlsx',
                'kode-kegiatan' => 'required',
                'nip' => 'required',
            ]);

            // menangkap file excel
            $file = $request->file('file');

            // membuat nama file unik
            $nama_file = rand().$file->getClientOriginalName();

            // upload ke folder file_siswa di dalam folder public
            $file->move('file_perusahaan',$nama_file);

            $nip = $request->input('nip');
            $kode_kegiatan = $request->input('kode-kegiatan');

            $pembaruan = Pembaruan::create([
                'nip' => $nip,
                'kode_kegiatan' => $kode_kegiatan,
                'keterangan'=> 'mengupdate perusahaan',
            ]);

            // import data
            Excel::import(new PerusahaanUpdateImport ($kode_kegiatan, $pembaruan->id_pembaruan), public_path('/file_perusahaan/'.$nama_file));

            // alihkan halaman kembali
            return redirect()->route('perusahaan')->with('pesanTambahPerusahaan','Data Berhasil Diimport');
        }catch (\Exception $e) {
            // Tangkap exception dan alihkan halaman kembali dengan pesan error
            $message = $e->getMessage();
            $messageArray = explode(' ', $message);

            // Jika panjang pesan kurang dari atau sama dengan 30 karakter, gunakan pesan tersebut
            if (count($messageArray) < 11) {
                $result = $message;
            } else {
                // Ambil 11 elemen pertama
                $first11Elements = array_slice($messageArray, 0, 11);

                // Gabungkan elemen-elemen tersebut menjadi string
                $result = implode(' ', $first11Elements);
            }
            return redirect()->route('perusahaan-update')->with('pesanTambahPerusahaan', 'Terjadi kesalahan saat mengimpor data: '.$result);
        }
    }
}
