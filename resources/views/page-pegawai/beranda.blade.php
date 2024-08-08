@extends('layout.pegawai')
@section('content')
    @include('component.searchbar')

    @include('component.pesan')

    <div id="beranda" class="bg-lightgrey">
        <div class="flex items-center justify-center pt-4">
            <a class="btn border-darkblue text-darkblue bg-white hover:bg-darkblue hover:text-white"
             href="{{route('kegiatan-statistik')}}">Kegiatan Statistik Bulan Ini:</a>
        </div>

        <div class="flex items-center justify-center py-8">
            <div class="carousel sm:w-2/4">

                @php
                    $no = 0;
                    $jumlah = count($kegiatanStatistiks);
                @endphp

                @if ($pesan == 'tidak ditemukan')

                    <div id="{{ $no < $jumlah? 'slide'.$no : 'slide'.$jumlah}}" class="carousel-item relative w-full">
                        <div class="w-full flex items-center justify-center">
                            <div class="grid grid-cols-1 gap-8">
                                <div class="card bg-base-100 sm:w-96 w-full shadow-xl">
                                    <figure class="px-10 pt-10">
                                    <img
                                        src="https://cdn3.iconfinder.com/data/icons/survey-rating/512/Survey_rating_rate-19-256.png"
                                        alt="Shoes"
                                        class="rounded-xl" style="width: 50px"/>
                                    </figure>
                                    <div class="card-body items-center text-center">
                                        <h2 class="card-title text-red">Tidak Ada Kegiatan Statistik di Bulan ini</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="absolute left-5 right-5 top-1/2 flex -translate-y-1/2 transform justify-between">
                        </div>
                    </div>

                @else
                    @foreach ($kegiatanStatistiks as $kegiatan)
                        @php
                            $no++;
                        @endphp

                        <div id="{{ $no < $jumlah? 'slide'.$no : 'slide'.$jumlah}}" class="carousel-item relative w-full">
                            <div class="w-full flex items-center justify-center">
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
                            </div>
                            <div class="absolute left-5 right-5 top-1/2 flex -translate-y-1/2 transform justify-between">
                                @if ($no == 1)
                                    <a href="{{'#slide'.$jumlah}}" class="btn btn-circle bg-white shadow-lg">❮</a>
                                    <a href="{{'#slide'.$no + 1}}" class="btn btn-circle bg-white shadow-lg">❯</a>
                                @elseif($no < $jumlah)
                                    <a href="{{'#slide'.$no - 1}}" class="btn btn-circle bg-white shadow-lg">❮</a>
                                    <a href="{{'#slide'.$no + 1}}" class="btn btn-circle bg-white shadow-lg">❯</a>
                                @else
                                    <a href="{{'#slide'.$no - 1}}" class="btn btn-circle bg-white shadow-lg">❮</a>
                                    <a href="{{'#slide1'}}" class="btn btn-circle bg-white shadow-lg">❯</a>
                                @endif
                            </div>
                        </div>
                    @endforeach
                @endif

            </div>
        </div>

    </div>

    <script>
        // Tunggu sampai halaman selesai dimuat
        document.addEventListener('DOMContentLoaded', function() {
            // Setelah 2 detik, sembunyikan elemen toast
            setTimeout(function() {
                document.getElementById('myToast').style.display = 'none';
            }, 2000); // 2000ms = 2 detik
        });
    </script>

@endsection
