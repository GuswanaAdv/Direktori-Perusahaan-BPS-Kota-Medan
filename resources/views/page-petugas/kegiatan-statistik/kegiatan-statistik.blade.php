@extends('layout.pegawai')
@section('content')
    @include('component.searchbar')
    <div id="beranda" class="bg-lightgrey">
        <div class="flex items-center justify-center pt-4">
            <div class="flex sm:space-x-12 grid sm:grid-cols-2 grid-cols-1">
                <div class="flex items-center justify-center py-2">
                    <button class="btn border-darkblue text-darkblue bg-white hover:border-darkblue hover:bg-white hover:text-darkblue">
                        Daftar Kegiatan Statistik:
                    </button>
                </div>
                <div class="flex items-center justify-center py-2">
                    <button class="btn border-darkblue text-darkblue bg-white hover:bg-darkblue hover:text-white">
                        Tambah Kegiatan Statistik
                        <img src="https://cdn1.iconfinder.com/data/icons/unicons-line-vol-5/24/plus-circle-64.png"
                        alt=""
                        height="32"
                        width="32">
                    </button>
                </div>
            </div>
        </div>

        <div class="flex items-center justify-center py-8">

            @if ($pesan == 'tidak ditemukan')
                <div class="grid grid-cols-1 gap-8">
                    <div class="card bg-base-100 sm:w-96 w-full shadow-xl">
                        <figure class="px-10 pt-10">
                        <img
                            src="https://cdn3.iconfinder.com/data/icons/survey-rating/512/Survey_rating_rate-19-256.png"
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
                        <div class="card bg-base-100 w-96 shadow-xl">
                            <figure class="px-10 pt-10">
                                <img
                                    src="https://cdn3.iconfinder.com/data/icons/survey-rating/512/Survey_rating_rate-19-256.png"
                                    alt="Shoes"
                                    class="rounded-xl" style="width: 50px"/>
                            </figure>
                            <div class="card-body items-center text-center">
                                <h2 class="card-title">{{!empty($kegiatan->nama_kegiatan)? $kegiatan->nama_kegiatan : ""}}</h2>
                                <p>
                                    {{!empty($kegiatan->tanggal_mulai) && !empty($kegiatan->tanggal_selesai)?
                                        "Tanggal : ".date('d-m-Y', strtotime($kegiatan->tanggal_mulai))." s/d ".date('d-m-Y', strtotime($kegiatan->tanggal_selesai)) : ""}}
                                </p>
                                <div class="card-actions">
                                    <a class="btn bg-darkblue text-white hover:bg-blue"
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
