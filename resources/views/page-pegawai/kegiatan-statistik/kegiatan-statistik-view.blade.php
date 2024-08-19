@extends('layout.pegawai')
@section('content')
    <div class="flex items-center justify-center py-8">
        <div class="card bg-white sm:w-3/4 shadow-xl w-full">
            <div class="card-body w-full text-left sm:px-20 border-b-2 space-y-4">
                <div class="w-full sm:flex sm:items-center sm:justify-center">
                    <h2 class="sm:w-2/4 w-full text-center text-3xl font-bold pb-8">
                        {{!empty($kegiatanStatistik->nama_kegiatan)? $kegiatanStatistik->nama_kegiatan : ""}}
                    </h2>
                </div>
                <p>
                    {{!empty($kegiatanStatistik->tanggal_mulai) && !empty($kegiatanStatistik->tanggal_selesai)?
                                        "Pelaksanaan : ".date('d-m-Y', strtotime($kegiatanStatistik->tanggal_mulai))." s/d ".date('d-m-Y', strtotime($kegiatanStatistik->tanggal_selesai)) : ""}}
                </p>
                <p class="font-bold text-justify">
                    {{!empty($kegiatanStatistik->nama_kegiatan)? "Apa itu ".$kegiatanStatistik->nama_kegiatan."?" : ""}}
                </p>
                <p>
                    {{!empty($kegiatanStatistik->keterangan)? $kegiatanStatistik->keterangan : ""}}
                </p>
                <p class="text-sm text-right">{{!empty($kegiatanStatistik->pegawai->nama_pegawai)? "created by : ".$kegiatanStatistik->pegawai->nama_pegawai : ""}}</p>
            </div>

            <div class="card-body w-full text-left sm:px-20 mb-8">
                <p>Daftar Sampel</p>
                @if ($pesan == 'tidak ditemukan')
                    <p class="text-2xl text-red text-center"> Perusahaan belum pernah terpilih sebagai sampel </p>
                @else
                    @include('component.kegiatan-tabel')
                @endif

            </div>

            <div class="flex items-center justify-center pb-16">
                {{ $perusahaanKegiatans->appends(request()->input())->links('vendor.pagination.tailwind-2') }}
            </div>
        </div>
    </div>
@endsection
