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

    public function lengkap($id_perusahaan)
    {
        $perusahaan = Perusahaan::with(['jenisKepemilikan'])->where('id_perusahaan', $id_perusahaan)->first();
        $perusahaanKegiatans = PerusahaanKegiatan::with(['perusahaan','pegawai','petugas','kegiatanStatistik'])
        ->where('id_perusahaan', $id_perusahaan)->paginate(10);

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
        $editor = PerusahaanKegiatan::where('nip', $perusahaan->nip)->when($id_perusahaan, function ($query) use ($id_perusahaan) {
            return $query->where('id_perusahaan', $id_perusahaan);
        })->latest('tanggal_penginputan')->first();

        return view('page-pegawai.perusahaan.perusahaan-view',[
            'judul' => 'Perusahaan',
            'perusahaan' => $perusahaan,
            'perusahaanKegiatans' => $perusahaanKegiatans,
            'initialMarkers' => $initialMarkers,
            'pesan' => $message,
            'editor' => $editor,
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

    public function tampilTambah()
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

        return view('page-pegawai.perusahaan.perusahaan-tambah',[
            'judul' => 'Perusahaan',
            'cari' => "-",
            'pesan' => "-",
            'kegiatans'=> $kegiatans,
        ]);
    }

    public function tambahPerusahaan(Request $request)
	{
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
                'keterangan'=> 'menambah perusahaan baru',
            ]);

            // import data
            Excel::import(new PerusahaanTambah ($kode_kegiatan, $pembaruan->id_pembaruan), public_path('/file_perusahaan/'.$nama_file));

            // alihkan halaman kembali
            return redirect()->route('perusahaan')->with('pesanTambahPerusahaan','Data Berhasil Diimport');
        }catch (\Exception $e) {
            // Tangkap exception dan alihkan halaman kembali dengan pesan error
            return redirect()->route('perusahaan-tambah')->with('pesanTambahPerusahaan', 'Terjadi kesalahan saat mengimpor data: '.$e->getMessage());
        }
	}
}
