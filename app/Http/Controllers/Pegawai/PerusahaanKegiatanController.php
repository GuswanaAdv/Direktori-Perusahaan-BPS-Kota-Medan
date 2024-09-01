<?php

namespace App\Http\Controllers\Pegawai;

use App\Models\KegiatanStatistik;
use App\Models\PerusahaanSementara;
use App\Models\Perusahaan;
use App\Models\PerusahaanKegiatan;
use App\Models\Pembaruan;
use App\Imports\CekSbr;
use App\Imports\PerusahaanTambah2;
use App\Imports\PetugasTambah;
use App\Exports\DownloadKolomPetugas;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Carbon;
use App\Rules\MinimumDateDifference;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PerusahaanKegiatanController extends Controller
{
    public function kegiatanTambah()
    {
        $tahun = Carbon::now()->year;
        $jumlah = KegiatanStatistik::whereYear('tanggal_mulai', $tahun)->count() + 1;
        $kode_kegiatan = 'ks'.$jumlah.'-'.$tahun;
        return view('page-pegawai.kegiatan-statistik.tambah.kegiatan',[
            'judul' => 'Kegiatan Statistik',
            'cari' => "-",
            'pesan' => "-",
            'kode_kegiatan' => $kode_kegiatan,
        ]);
    }

    public function prosesKegiatanTambah(Request $request){
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
            return redirect()->route('perusahaan-cek-sbr',['kode_kegiatan'=>$kode_kegiatan])->with('pesanTambahKegiatanStatistik','Kegiatan Statistik Berhasil Ditambahkan');
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
            return redirect()->route('kegiatan-tambah')->with('pesanTambahKegiatanStatistik', 'Terjadi kesalahan saat menambahkan data: '. $result);
        }
    }

    public function perusahaanCekSbr($kode_kegiatan){
        return view('page-pegawai.kegiatan-statistik.tambah.sbr-cek',[
            'judul' => 'Kegiatan Statistik',
            'cari' => "-",
            'pesan' => "-",
            'kode_kegiatan' => $kode_kegiatan,
        ]);
    }

    public function prosesPerusahaanCekSbr(Request $request){
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
                'keterangan'=> 'menunggu proses update',
            ]);

            // import data
            Excel::import(new CekSbr ($pembaruan->id_pembaruan), public_path('/file_perusahaan/'.$nama_file));
            unlink(public_path('/file_perusahaan/' . $nama_file));
            // alihkan halaman kembali
            return redirect()->route('perusahaan-hasil-sbr',['id_pembaruan'=>$pembaruan->id_pembaruan])->with([
                'pesanTambahPerusahaan'=>'Data Berhasil Diimport'
            ]);
        }catch (\Exception $e) {
            // Tangkap exception dan alihkan halaman kembali dengan pesan error
            $message = $e->getMessage();
            $messageArray = explode(' ', $message);

            // Jika panjang pesan kurang dari atau sama dengan 30 karakter, gunakan pesan tersebut
            if (count($messageArray) < 15) {
                $result = $message;
            } else {
                // Ambil 11 elemen pertama
                $first11Elements = array_slice($messageArray, 0, 15);

                // Gabungkan elemen-elemen tersebut menjadi string
                $result = implode(' ', $first11Elements);
            }
            return redirect()->route('perusahaan-cek-sbr',['kode_kegiatan'=>$kode_kegiatan])->with('pesanTambahPerusahaan', 'Terjadi kesalahan saat mengimpor data: '.$result);
        }
    }

    public function perusahaanHasilSbr($id_pembaruan){
        $perusahaanSementaras = PerusahaanSementara::where('id_pembaruan', $id_pembaruan)->get();
        return view('page-pegawai.kegiatan-statistik.tambah.sbr-hasil',[
            'judul' => 'Kegiatan Statistik',
            'cari' => "-",
            'pesan' => "-",
            'id_pembaruan' => $id_pembaruan,
            'perusahaanSementaras' => $perusahaanSementaras,
        ]);
    }

    public function perusahaanCariTambah($id_pembaruan){
        $perusahaans = Perusahaan::where('ada_sbr','tidak ada')->orderBy('id_perusahaan', 'asc')->get();
        $kode_kegiatan = Pembaruan::find($id_pembaruan)->kode_kegiatan;
        $perusahaanSementaras = PerusahaanSementara::where('id_pembaruan', $id_pembaruan)->get();
        return view('page-pegawai.kegiatan-statistik.tambah.perusahaan-layout',[
            'judul' => 'Kegiatan Statistik',
            'cari' => "-",
            'pesan' => "-",
            'kode_kegiatan' => $kode_kegiatan,
            'id_pembaruan' => $id_pembaruan,
            'perusahaans' => $perusahaans,
            'perusahaanSementaras' => $perusahaanSementaras,
        ]);
    }

    public function perusahaanCari(Request $request){
        $search = $request->search;
        $ada_sbr = 'tidak ada';
        if($request->ajax()){
            $output="";
            $perusahaans = Perusahaan::where('nama_usaha', 'like', "%$search%")
                        ->when($ada_sbr, function ($query) use ($ada_sbr) {
                            return $query->where('ada_sbr','>=', $ada_sbr);
                        })
                        ->orWhere('nama_komersial', 'like', "%$search%")
                        ->when($ada_sbr, function ($query) use ($ada_sbr) {
                            return $query->where('ada_sbr','>=', $ada_sbr);
                        })
                        ->orWhere('id_sbr', 'like', "%$search%")
                        ->when($ada_sbr, function ($query) use ($ada_sbr) {
                            return $query->where('ada_sbr','>=', $ada_sbr);
                        })
                        ->orderBy('id_sbr', 'asc')->take(10)->get();

            if(!$perusahaans->isEmpty()){
                foreach($perusahaans as $perusahaan){
                    $href = "/perusahaan/".$perusahaan->id_perusahaan;
                    $output.=
                    '<tr>'.
                        '<td>'.$perusahaan->id_sbr.'</td>'.
                        '<td>'.$perusahaan->nama_usaha.'</td>'.
                        '<td>'.'<a href="'.$href.'"
                                class="btn bg-orange text-white hover:bg-yellowpastel hover:text-darkgrey">
                                    selengkapnya
                                </a>'.
                        '</td>'.
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
                $notfound = '<tr><td colspan="3" class="text-red text-center">'.'Data tidak ditemukan'.'</td></tr>';
                return response($notfound);
            }
        }
    }

    public function perusahaanTambah1(Request $request){
        try{
            $this->validate($request, [
                'id-pembaruan' => 'required',
                'kode-kegiatan' => 'required',
            ]);
            $id_pembaruan = $request->input('id-pembaruan');
            $kode_kegiatan = $request->input('kode-kegiatan');

            // Mengambil semua input sebagai array
            $inputData = array_values($request->input())[3];
            $id_perusahaans = collect($inputData);
            // dd($id_perusahaan);

            foreach($id_perusahaans as $id_perusahaan){
                $perusahaan = Perusahaan::find($id_perusahaan);
                if($perusahaan){
                    PerusahaanSementara::create([
                        // Blok 1
                        'id_perusahaan' => $perusahaan->id_perusahaan,
                        'ada_sbr' => $perusahaan->ada_sbr,
                        'id_sbr' => $perusahaan->id_sbr,
                        'tanggal_cacah_pertama' => $perusahaan->tanggal_cacah_pertama,
                        'tanggal_cacah_terakhir' => $perusahaan->tanggal_cacah_terakhir,
                        'nip' => $perusahaan->nip,
                        'nama_petugas' => $perusahaan->nip,
                        'kode_kegiatan' => $kode_kegiatan,
                        'id_pembaruan' => $id_pembaruan,
                        'nama_usaha' => $perusahaan->nama_usaha,
                        'nama_komersial' => $perusahaan->nama_komersial,
                        'kode_unit_statistik' => $perusahaan->kode_unit_statistik,
                        'provinsi' => $perusahaan->provinsi,
                        'kabupaten' => $perusahaan->kabupaten,
                        'kecamatan' => $perusahaan->kecamatan,
                        'kelurahan' => $perusahaan->kelurahan,
                        'nama_sls' => $perusahaan->nama_sls,
                        'alamat_sbr' => $perusahaan->alamat_sbr,
                        'telepon' => $perusahaan->telepon,
                        'kode_kondisi_perusahaan' => $perusahaan->kode_kondisi_perusahaan,
                        'kode_kategori' => $perusahaan->kode_kategori,
                    ]);
                }
            }
            return redirect()->route('perusahaan-cari-tambah',['id_pembaruan' => $id_pembaruan])->with('pesanTambahPerusahaan', 'Data Berhasil Diimport');
        }catch (\Exception $e) {
            // Tangkap exception dan alihkan halaman kembali dengan pesan error
            $message = $e->getMessage();
            $messageArray = explode(' ', $message);

            // Jika panjang pesan kurang dari atau sama dengan 30 karakter, gunakan pesan tersebut
            if (count($messageArray) < 15) {
                $result = $message;
            } else {
                // Ambil 11 elemen pertama
                $first11Elements = array_slice($messageArray, 0, 15);

                // Gabungkan elemen-elemen tersebut menjadi string
                $result = implode(' ', $first11Elements);
            }
            return redirect()->route('perusahaan-cari-tambah',['id_pembaruan' => $id_pembaruan])->with('pesanTambahPerusahaan', 'Terjadi kesalahan saat mengimpor data: '.$result);
        }
    }

    public function perusahaanTambah2(Request $request){
        try{
            // validasi
            $this->validate($request, [
                'file' => 'required|mimes:csv,xls,xlsx',
                'kode-kegiatan' => 'required',
                'nip' => 'required',
                'id-pembaruan' => 'required',
            ]);

            // menangkap file excel
            $file = $request->file('file');

            // membuat nama file unik
            $nama_file = rand().$file->getClientOriginalName();

            // upload ke folder file_siswa di dalam folder public
            $file->move('file_perusahaan',$nama_file);

            $nip = $request->input('nip');
            $kode_kegiatan = $request->input('kode-kegiatan');
            $id_pembaruan = $request->input('id-pembaruan');

            // import data
            Excel::import(new PerusahaanTambah2 ($kode_kegiatan, $id_pembaruan, $nip), public_path('/file_perusahaan/'.$nama_file));
            unlink(public_path('/file_perusahaan/' . $nama_file));
            // alihkan halaman kembali
            return redirect()->route('perusahaan-cari-tambah',['id_pembaruan' => $id_pembaruan])->with('pesanTambahPerusahaan', 'Data Berhasil Diimport');
        }catch (\Exception $e) {
            // Tangkap exception dan alihkan halaman kembali dengan pesan error
            $message = $e->getMessage();
            $messageArray = explode(' ', $message);
            $id_pembaruan = $request->input('id-pembaruan');

            // Jika panjang pesan kurang dari atau sama dengan 30 karakter, gunakan pesan tersebut
            if (count($messageArray) < 11) {
                $result = $message;
            } else {
                // Ambil 11 elemen pertama
                $first11Elements = array_slice($messageArray, 0, 11);

                // Gabungkan elemen-elemen tersebut menjadi string
                $result = implode(' ', $first11Elements);
            }
            return redirect()->route('perusahaan-cari-tambah',['id_pembaruan' => $id_pembaruan])->with('pesanTambahPerusahaan', 'Terjadi kesalahan saat mengimpor data: '.$result);
        }
    }

    public function perusahaanPetugas($id_pembaruan){
        $kode_kegiatan = Pembaruan::find($id_pembaruan)->kode_kegiatan;
        $perusahaanSementaras = PerusahaanSementara::where('id_pembaruan', $id_pembaruan)->get();
        return view('page-pegawai.kegiatan-statistik.tambah.petugas-layout',[
            'judul' => 'Kegiatan Statistik',
            'cari' => "-",
            'pesan' => "-",
            'kode_kegiatan' => $kode_kegiatan,
            'id_pembaruan' => $id_pembaruan,
            'perusahaanSementaras' => $perusahaanSementaras,
        ]);
    }

    public function downloadKolomPetugas($id_pembaruan){
        $perusahaan = PerusahaanSementara::where('id_pembaruan',$id_pembaruan)->get();
        $pembaruan = Pembaruan::find($id_pembaruan);
        return Excel::download(new DownloadKolomPetugas($perusahaan),
            $pembaruan->pegawai->nama_pegawai.'-'.
            $pembaruan->kegiatanStatistik->nama_kegiatan.'-'
            .'kolom-petugas'.'.xlsx'
        );
    }

    public function petugasTambah(Request $request){
        try{
            // validasi
            $this->validate($request, [
                'file' => 'required|mimes:csv,xls,xlsx',
                'id-pembaruan' => 'required',
            ]);

            // menangkap file excel
            $file = $request->file('file');

            // membuat nama file unik
            $nama_file = rand().$file->getClientOriginalName();

            // upload ke folder file_siswa di dalam folder public
            $file->move('file_perusahaan',$nama_file);
            $id_pembaruan = $request->input('id-pembaruan');

            // import data
            Excel::import(new PetugasTambah ($id_pembaruan), public_path('/file_perusahaan/'.$nama_file));
            unlink(public_path('/file_perusahaan/' . $nama_file));
            // alihkan halaman kembali
            return redirect()->route('perusahaan-kegiatan',['id_pembaruan' => $id_pembaruan])->with('pesanTambahPerusahaan', 'Data Berhasil Diimport');
        }catch (\Exception $e) {
            // Tangkap exception dan alihkan halaman kembali dengan pesan error
            $message = $e->getMessage();
            $messageArray = explode(' ', $message);
            $id_pembaruan = $request->input('id-pembaruan');

            // Jika panjang pesan kurang dari atau sama dengan 30 karakter, gunakan pesan tersebut
            if (count($messageArray) < 11) {
                $result = $message;
            } else {
                // Ambil 11 elemen pertama
                $first11Elements = array_slice($messageArray, 0, 11);

                // Gabungkan elemen-elemen tersebut menjadi string
                $result = implode(' ', $first11Elements);
            }
            return redirect()->route('perusahaan-petugas',['id_pembaruan' => $id_pembaruan])->with('pesanTambahPerusahaan', 'Terjadi kesalahan saat mengimpor data: '.$message);
        }
    }

    public function perusahaanKegiatan($id_pembaruan){
        $pembaruan = Pembaruan::find($id_pembaruan);
        $perusahaanSementaras = PerusahaanSementara::where('id_pembaruan', $id_pembaruan)->get();
        foreach($perusahaanSementaras as $perusahaan){
            PerusahaanKegiatan::create([
                'kode_kegiatan'=>$pembaruan->kegiatanStatistik->kode_kegiatan,
                'id_perusahaan'=>$perusahaan->id_perusahaan,
                'nama_petugas'=>$perusahaan->nama_petugas,
                'nip'=>$perusahaan->nip,
                'status'=>$perusahaan->kode_kondisi_perusahaan,
                'tanggal_kegiatan'=>$pembaruan->kegiatanStatistik->tanggal_mulai,
                'tanggal_penginputan'=>$pembaruan->kegiatanStatistik->tanggal_mulai,
                'keterangan'=>'belum diupdate',
                'reverse_kegiatan'=>Carbon::createFromFormat('Y-m-d', $pembaruan->kegiatanStatistik->tanggal_mulai)->format('d-m-Y'),
                'reverse_penginputan'=>Carbon::createFromFormat('Y-m-d', $pembaruan->kegiatanStatistik->tanggal_mulai)->format('d-m-Y'),
            ]);
        }
        return view('page-pegawai.kegiatan-statistik.tambah.perusahaan-kegiatan',[
            'judul' => 'Kegiatan Statistik',
            'cari' => "-",
            'pesan' => "-",
            'pembaruan' => $pembaruan,
            'perusahaanSementaras' => $perusahaanSementaras,
        ]);
    }

    public function selesai(){
        return redirect()->route('kegiatan-statistik')->with('pesanTambahKegiatanStatistik','Selamat Kegiatan Statistik Berhasil Ditambahkan');
    }
}
