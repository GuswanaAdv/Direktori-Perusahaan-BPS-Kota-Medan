<?php

namespace App\Http\Controllers\Pegawai;

use App\Imports\PetugasImport;
use Carbon\Carbon;
use App\Models\Petugas;
use App\Models\KegiatanStatistik;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;

class PetugasController extends Controller
{
    public function tampil()
    {
        $petugass = Petugas::with(["perusahaanKegiatan"])->paginate(5);
        return view('page-pegawai.petugas.petugas',[
            'judul' => 'Petugas',
            'petugass' => $petugass,
            'cari' => "-",
            'pesan' => "-",
        ]);
    }

    public function lengkap($id_petugas)
    {
        $petugas = Petugas::with(['jenisKepemilikan'])->where('id_petugas', $id_petugas)->first();

        return view('page-pegawai.petugas.petugas-view',[
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

        return view('page-pegawai.petugas.petugas',[
            'judul' => 'Petugas',
            'petugass' => $petugass,
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
            return $query->whereMonth('tanggal_mulai', $currentMonth);
        })
        ->when($currentYear, function ($query) use ($currentYear) {
            return $query->whereYear('tanggal_mulai', $currentYear);
        })
        ->whereDate('tanggal_mulai', '>=', $today)
        ->get();

        return view('page-pegawai.petugas.petugas-tambah',[
            'judul' => 'Petugas',
            'cari' => "-",
            'pesan' => "-",
            'kegiatans'=> $kegiatans
        ]);
    }

    public function importExcel(Request $request)
	{
        try{
            // validasi
            $this->validate($request, [
                'file' => 'required|mimes:csv,xls,xlsx',
                'kode-kegiatan' => 'required',
            ]);

            $kode_kegiatan = $request->input('kode-kegiatan');

            // menangkap file excel
            $file = $request->file('file');

            // membuat nama file unik
            $nama_file = rand().$file->getClientOriginalName();

            // upload ke folder file_siswa di dalam folder public
            $file->move('file_petugas',$nama_file);

            // import data
            Excel::import(new PetugasImport ($kode_kegiatan), public_path('/file_petugas/'.$nama_file) );

            // alihkan halaman kembali
            return redirect()->route('petugas')->with('pesanTambahPetugas','Data Berhasil Diimport');
        }
        catch (\Exception $e) {
            // Tangkap exception dan alihkan halaman kembali dengan pesan error
            return redirect()->route('petugas-tambah')->with('pesanTambahPetugas', 'Terjadi kesalahan saat mengimpor data: '.$e->getMessage());
        }
	}
}
