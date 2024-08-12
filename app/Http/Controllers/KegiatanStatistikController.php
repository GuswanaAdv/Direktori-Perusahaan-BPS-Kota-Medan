<?php

namespace App\Http\Controllers;

use App\Models\KegiatanStatistik;
use App\Models\PerusahaanKegiatan;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;

class KegiatanStatistikController extends Controller
{
    public function tampil()
    {
        $kegiatanStatistiks = KegiatanStatistik::latest('tanggal_mulai')->paginate(4);
        return view('page-pegawai.kegiatan-statistik.kegiatan-statistik',[
            'judul' => 'Kegiatan Statistik',
            'kegiatanStatistiks' => $kegiatanStatistiks,
            'cari' => "-",
            'pesan' => "-",
        ]);
    }

    public function lengkap($kode_kegiatan)
    {
        $kegiatanStatistik = KegiatanStatistik::where('kode_kegiatan', $kode_kegiatan)->first();
        $perusahaanKegiatans = PerusahaanKegiatan::with(['perusahaan','pegawai','petugas','kegiatanStatistik'])
        ->where('kode_kegiatan', $kode_kegiatan)->paginate(10);
        $message = $perusahaanKegiatans->isEmpty() ? 'tidak ditemukan' : '';

        return view('page-pegawai.kegiatan-statistik.kegiatan-statistik-view',[
            'judul' => 'Kegiatan Statistik',
            'kegiatanStatistik' => $kegiatanStatistik,
            'perusahaanKegiatans' => $perusahaanKegiatans,
            'pesan' => $message,
        ]);
    }

    public function search2(){
        $search = request('search');
        $kegiatanStatistiks = KegiatanStatistik::where('nama_kegiatan', 'like', "%$search%")->
                                orWhere('reverse_mulai', 'like', "%$search%")->
                                orWhere('reverse_selesai', 'like', "%$search%")->
                                latest('tanggal_mulai')->paginate(4);
        $message = $kegiatanStatistiks->isEmpty() ? 'tidak ditemukan' : '';

        return view('page-pegawai.kegiatan-statistik.kegiatan-statistik',[
            'judul' => 'Kegiatan Statistik',
            'kegiatanStatistiks' => $kegiatanStatistiks,
            'cari' => $search,
            'pesan' => $message,
        ]);
    }

    public function tampilTambah()
    {
        return view('page-pegawai.kegiatan-statistik.kegiatan-statistik-tambah',[
            'judul' => 'Kegiatan Statistik',
            'cari' => "-",
            'pesan' => "-",
        ]);
    }

    public function prosesTambah(Request $request){
        try{
            $this->validate($request, [
                'kode-kegiatan' => 'required',
                'nama-kegiatan' => 'required',
                'waktu-mulai' => 'required|date_format:Y-m-d',
                'waktu-selesai' => 'required|date_format:Y-m-d|after:waktu-mulai',
                'keterangan' => 'required',
            ]);

            $kode_kegiatan = $request->input('kode-kegiatan');
            $nama_kegiatan = $request->input('nama-kegiatan');
            $waktu_mulai = $request->input('waktu-mulai');
            $waktu_selesai = $request->input('waktu-selesai');
            $reverse_mulai = Carbon::createFromFormat('Y-m-d', $request->input('waktu-mulai'))->format('d-m-Y');
            $reverse_selesai = Carbon::createFromFormat('Y-m-d', $request->input('waktu-selesai'))->format('d-m-Y');
            $keterangan = $request->input('keterangan');

            KegiatanStatistik::create([
                'kode_kegiatan' => $kode_kegiatan,
                'nama_kegiatan' => $nama_kegiatan,
                'tanggal_mulai' => $waktu_mulai,
                'tanggal_selesai' => $waktu_selesai,
                'reverse_mulai' => $reverse_mulai,
                'reverse_selesai' => $reverse_selesai,
                'keterangan' => $keterangan,
            ]);

            // dd($waktu_selesai,$reverse_selesai);

            return redirect()->route('kegiatan-statistik')->with('pesanTambahKegiatanStatistik','Kegiatan Statistik Berhasil Ditambahkan');
        }catch (\Exception $e) {
            // Tangkap exception dan alihkan halaman kembali dengan pesan error
            return redirect()->route('kegiatan-statistik-tambah')->with('pesanTambahKegiatanStatistik', 'Terjadi kesalahan saat menambahkan data: '.$e->getMessage());
        }
    }
}
