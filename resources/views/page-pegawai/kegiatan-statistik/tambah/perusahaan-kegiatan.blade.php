@extends('layout.pegawai')
@section('content')
    <div class="flex items-center justify-center py-8">
        <div class="card bg-white sm:w-3/4 shadow-xl w-full">

            <div class="card-body w-full text-2xl text-left sm:px-20 font-bold">
                Daftar Sampel Perusahaan
            </div>
            <div class="card-body w-full text-left sm:px-20 ">
                <p>Kegiatan: {{ $pembaruan->kegiatanStatistik->nama_kegiatan }}</p>
                <p>Tanggal Pelaksanan: {{ date('d-m-Y', strtotime($pembaruan->kegiatanStatistik->tanggal_mulai)).' s/d '.date('d-m-Y', strtotime($pembaruan->kegiatanStatistik->tanggal_mulai))}}</p>
                <p>Total Sampel: {{ $perusahaanSementaras->count()." Perusahaan" }}</p>
            </div>

            @include('component.pesan')
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
                    <a href="{{ route('kegiatan-selesai') }}"
                        class="btn bg-orange text-white hover:bg-yellowpastel hover:text-darkgrey max-w-30">
                            selanjutnya
                    </a>
                </div>
            </div>

        </div>
    </div>
@endsection
