<?php

namespace App\Http\Controllers\Pegawai;

use App\Models\KegiatanStatistik;
use App\Models\PerusahaanKegiatan;
use App\Models\PerusahaanSementara;
use Illuminate\Support\Carbon;
use App\Rules\MinimumDateDifference;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
        $perusahaanSementaras = ($kegiatanStatistik->pembaruan != '')? PerusahaanSementara::where('id_pembaruan',$kegiatanStatistik->pembaruan->id_pembaruan)->paginate(10) : '';
        $message_tambahan = $perusahaanSementaras === '' ? 'tidak ditemukan' : '';
        $perusahaanKegiatans = PerusahaanKegiatan::with(['perusahaan','pegawai','petugas','kegiatanStatistik'])
        ->where('kode_kegiatan', $kode_kegiatan)->paginate(10);
        $message = $perusahaanKegiatans->isEmpty() ? 'tidak ditemukan' : '';
        // dd($perusahaanSementaras);
        return view('page-pegawai.kegiatan-statistik.kegiatan-statistik-view',[
            'judul' => 'Kegiatan Statistik',
            'kegiatanStatistik' => $kegiatanStatistik,
            'perusahaanKegiatans' => $perusahaanKegiatans,
            'perusahaanSementaras' => $perusahaanSementaras,
            'pesan' => $message,
            'pesan_tambahan' => $message_tambahan,
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
        $tahun = Carbon::now()->year;
        $jumlah = KegiatanStatistik::whereYear('tanggal_mulai', $tahun)->count() + 1;
        $kode_kegiatan = 'ks'.$jumlah.'-'.$tahun;
        return view('page-pegawai.kegiatan-statistik.kegiatan-statistik-tambah',[
            'judul' => 'Kegiatan Statistik',
            'cari' => "-",
            'pesan' => "-",
            'kode_kegiatan' => $kode_kegiatan,
        ]);
    }

    public function prosesTambah(Request $request){
        try{
            $this->validate($request, [
                'kode-kegiatan' => 'required',
                'nama-kegiatan' => 'required',
                'waktu-mulai' => 'required|date_format:Y-m-d|after or equal:today',
                'waktu-selesai' => ['required', 'date_format:Y-m-d', 'after:waktu-mulai', new MinimumDateDifference(30)],
                'keterangan' => 'required',
            ]);

            $kode_kegiatan = $request->input('kode-kegiatan');
            $nama_kegiatan = $request->input('nama-kegiatan');
            $waktu_mulai = $request->input('waktu-mulai');
            $waktu_selesai = $request->input('waktu-selesai');
            $reverse_mulai = Carbon::createFromFormat('Y-m-d', $request->input('waktu-mulai'))->format('d-m-Y');
            $reverse_selesai = Carbon::createFromFormat('Y-m-d', $request->input('waktu-selesai'))->format('d-m-Y');
            $keterangan = $request->input('keterangan');
            $nip = Auth()->user()->pegawai->nip;

            KegiatanStatistik::create([
                'nip' => $nip,
                'kode_kegiatan' => $kode_kegiatan,
                'nama_kegiatan' => $nama_kegiatan,
                'tanggal_mulai' => $waktu_mulai,
                'tanggal_selesai' => $waktu_selesai,
                'reverse_mulai' => $reverse_mulai,
                'reverse_selesai' => $reverse_selesai,
                'keterangan' => $keterangan,
            ]);
            return redirect()->route('kegiatan-statistik')->with('pesanTambahKegiatanStatistik','Kegiatan Statistik Berhasil Ditambahkan');

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
            return redirect()->route('kegiatan-statistik-tambah')->with('pesanTambahKegiatanStatistik', 'Terjadi kesalahan saat menambahkan data: '. $result);
        }
    }
}
