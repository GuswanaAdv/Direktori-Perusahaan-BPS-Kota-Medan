@extends('layout.pegawai')
@section('content')
    <div class="flex items-center justify-center py-8">
        <div class="card bg-white sm:w-3/4 shadow-xl w-full">

            <div class="card-body w-full text-2xl text-left sm:px-20 font-bold">
                <p class="pl-4 font-bold text-xl text-center">
                    Pilih Perusahaan yang belum memiliki ID SBR (*Optional)
                </p>
                <form action="{{ route('perusahaan-tambah1') }}" method="post" id="form-download">
                    @csrf
                    <input type="hidden" value="{{ $id_pembaruan }}" name="id-pembaruan">
                    <input type="hidden" value="{{ $kode_kegiatan }}" name="kode-kegiatan">
                    <div class="w-full grid md:grid-cols-3 grid-cols-1 border-2 rounded-lg p-4 max-h-80 overflow-y-auto border border-darkgrey" id="kotak"></div>
                    <div id="warning-message-perusahaan" style="display: none;" class="text-center text-red text-sm">
                        Silahkan pilih perusahaan terlebih dahulu.
                    </div>
                    <button class="btn w-full mt-4 bg-grey text-black hover:bg-orange hover:text-whit" id="button-download">Tambah</button>
                </form>
            </div>
            <div class="card-body w-full text-left sm:px-20 border-b-2 font-bold">
                @include('page-pegawai.kegiatan-statistik.tambah.perusahaan-cari')
            </div>

            <div class="card-body w-full text-xl text-center sm:px-20 font-bold">
                Tambah Data Perusahaan Baru (*Optional)
            </div>

            <div class="card-body w-full text-left sm:px-20 border-b-2 font-bold">
                @include('component.catatan.perusahaan-catatan')
            </div>

            @include('component.pesan')

            <div class="card-body w-full text-left sm:px-20 border-b-2">

                <form class="mx-auto py-4 w-full" action="{{ route('perusahaan-tambah2') }}"
                id="form-update" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" value="{{ $id_pembaruan }}" name="id-pembaruan">
                    <input type="hidden" value="{{ $kode_kegiatan }}" name="kode-kegiatan">
                    <input type="hidden" value="{{ Auth::user()->pegawai->nip }}" name="nip">
                    <div class="w-full flex items-center justify-center">
                        <div class="grid grid-cols-1">
                            <label class="block mb-2 text-sm font-bold text-black pl-2"
                                for="user_avatar">
                                Upload File Berekstensi .xlsx
                            </label>
                            <div class="w-full flex items-center justify-center">
                                <input type="file" name="file" id="fileInput"
                                    class="file-input file-input-success file-input-bordered w-full max-w-xs"
                                    accept=".xlsx" required/>
                            </div>
                            <div class="mt-1 text-sm text-gray-500 dark:text-gray-300"
                            id="user_avatar_help">
                                pastikan urutan kolom excel sudah disusun dengan benar
                            </div>
                        </div>
                    </div>

                    <div id="preview" class="mt-4 w-full flex items-center justify-center"></div>

                    <div class="w-full flex items-center justify-center mt-8">
                       <button class="btn w-full max-w-xs bg-grey text-black hover:bg-orange hover:text-white"
                            type="submit">
                            Tambah
                        </button>
                    </div>
                </form>

            </div>

            <div class="card-body w-full text-xl text-center sm:px-20 font-bold">
                Daftar Sampel Perusahaan
            </div>

            <div class="card-body w-full text-left sm:px-20">
                <div class="overflow-x-auto overflow-y-auto w-full max-h-4/5">
                    <table class="table table-zebra w-full">
                      <!-- head -->
                      <thead>
                        <tr>
                          <th></th>
                          <th>ID SBR</th>
                          <th>Tanggal Pencacahan Terakhir</th>
                          <th>Nama Usaha</th>
                          <th>Unit Statistik</th>
                          <th>Kecamatan</th>
                          <th>Kelurahan</th>
                          <th>Alamat</th>
                          <th>Telepon</th>
                          <th>Status Perusahaan</th>
                          <th>Kategori Perusahaan</th>
                          <th>Nama Petugas Terakhir</th>
                        </tr>
                      </thead>
                      <tbody>
                        <!-- row 1 -->
                        @php
                            $no = 0;
                        @endphp
                        @foreach ($perusahaanSementaras as $row)
                            @php
                                $no++;
                            @endphp
                            <tr>
                                <th>{{$no}}</th>
                                <td>{{!empty($row->id_sbr)? $row->id_sbr: " "}}</td>
                                <td>{{!empty($row->tanggal_cacah_terakhir)? date('d-m-Y', strtotime($row->tanggal_cacah_terakhir)): " "}}</td>
                                <td>{{!empty($row->nama_usaha)? $row->nama_usaha: " "}}</td>
                                <td>{{!empty($row->unitStatistik->nama_unit_statistik)? $row->unitStatistik->nama_unit_statistik: " "}}</td>
                                <td>{{!empty($row->kecamatan)? $row->kecamatan: " "}}</td>
                                <td>{{!empty($row->kelurahan)? $row->kelurahan: " "}}</td>
                                <td>{{!empty($row->alamat_sbr)? $row->alamat_sbr: " "}}</td>
                                <td>{{!empty($row->telepon)? $row->telepon: " "}}</td>
                                <td>{{!empty($row->kondisiPerusahaan->nama_kondisi_perusahaan)? $row->kondisiPerusahaan->nama_kondisi_perusahaan: "-"}}</td>
                                <td>{{!empty($row->kategoriUsaha->nama_kategori)? $row->kategoriUsaha->nama_kategori: "-"}}</td>
                                <td>{{!empty($row->nama_petugas)? $row->nama_petugas: " "}}</td>
                            </tr>
                        @endforeach

                      </tbody>
                    </table>
                </div>
            </div>

            <div class="card-body text-2xl text-left sm:px-20 font-bold">
                <div class="w-30 flex items-center justify-end sm:mr-20 mb-8">
                    <a href="{{ route('perusahaan-petugas',['id_pembaruan'=>$id_pembaruan]) }}"
                        class="btn bg-orange text-white hover:bg-yellowpastel hover:text-darkgrey max-w-30">
                            selanjutnya
                    </a>
                </div>
            </div>

        </div>
    </div>

    @include('component.script-preview')
@endsection
