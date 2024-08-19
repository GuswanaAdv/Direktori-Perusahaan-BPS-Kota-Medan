@extends('layout.pegawai')
@section('content')
    @include('component.searchbar.searchbar-pegawai')
    @include('component.pesan')
    <div id="beranda" class="bg-white">
        <div class="flex items-center justify-center pt-4">
            <div class="flex sm:space-x-12 grid sm:grid-cols-2 grid-cols-1">
                <div class="flex items-center justify-center py-2">
                    <button class="btn border-darkgrey text-darkgrey bg-white hover:border-darkgrey hover:bg-white hover:text-darkgrey">
                        <img src="{{ url('logo/logo-list-2.png') }}"
                            alt=""
                            height="28"
                            width="28"
                        >
                        Daftar Kegiatan Statistik:
                    </button>
                </div>
                <div class="flex items-center justify-center py-2">
                    <a class="btn border-darkgrey text-darkgrey bg-white hover:bg-darkgrey hover:text-white"
                        href="{{ route('kegiatan-statistik-tambah') }}">
                        <img src="{{ url('logo/logo-tambah-lingkaran-2.png') }}"
                        alt=""
                        height="28"
                        width="28">
                        Tambah Kegiatan Statistik
                    </a>
                </div>
            </div>
        </div>

        <div class="flex items-center justify-center py-8">

            @if ($pesan == 'tidak ditemukan')
                <div class="grid grid-cols-1 gap-8">
                    <div class="card bg-white border border-darkgrey sm:w-96 w-full shadow-xl">
                        <figure class="px-10 pt-10">
                        <img
                            src="{{ url('logo/logo-kegiatan-statistik.png') }}"
                            alt="Shoes"
                            class="rounded-xl" style="width: 50px"/>
                        </figure>
                        <div class="card-body items-center text-center">
                            <h2 class="card-title text-red">Kegiatan Statistik Tidak Ditemukan </h2>
                        </div>
                    </div>
                </div>

            @else
               <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    @foreach ($kegiatanStatistiks as $kegiatan)
                        <div class="card bg-white border border-darkgrey w-96 shadow-xl">
                            <figure class="px-10 pt-10">
                                <img
                                    src="{{ url('logo/logo-kegiatan-statistik.png') }}"
                                    alt="Shoes"
                                    class="rounded-xl" style="width: 50px"/>
                            </figure>
                            <div class="card-body items-center text-center">
                                <h2 class="card-title">{{!empty($kegiatan->nama_kegiatan)? $kegiatan->nama_kegiatan : ""}}</h2>
                                <p>
                                    {{!empty($kegiatan->tanggal_mulai) && !empty($kegiatan->tanggal_selesai)?
                                        "Tanggal : ".date('d-m-Y', strtotime($kegiatan->tanggal_mulai))." s/d ".date('d-m-Y', strtotime($kegiatan->tanggal_selesai)) : ""}}
                                </p>
                                <p class="text-sm">created by : {{ !empty($kegiatan->pegawai->nama_pegawai)?  $kegiatan->pegawai->nama_pegawai : "-"}}</p>
                                <div class="card-actions">
                                    <a class="btn bg-orange text-white hover:bg-yellowpastel hover:text-darkgrey"
                                        href="{{route('kegiatan-statistik-view', ['kode_kegiatan' => $kegiatan->kode_kegiatan])}}">
                                        Selengkapnya
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

            @endif

        </div>

        <div class="flex items-center justify-center pt-8 pb-16">
            {{ $kegiatanStatistiks->appends(request()->input())->links('vendor.pagination.tailwind-2') }}
        </div>

    </div>

@endsection
