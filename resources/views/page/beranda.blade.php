@extends('layout.app')
@section('content')
    @include('component.searchbar')
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

                {{-- <div id="slide2" class="carousel-item relative w-full">
                    <div class="w-full flex items-center justify-center">
                        <img
                        src="https://flowbite.com/docs/images/book-light.svg"
                        class="sm:w-60 sm:h-60"/>
                    </div>
                    <div class="absolute left-5 right-5 top-1/2 flex -translate-y-1/2 transform justify-between">
                        <a href="#slide1" class="btn btn-circle bg-white shadow-lg">❮</a>
                        <a href="#slide3" class="btn btn-circle bg-white shadow-lg">❯</a>
                    </div>
                </div>

                <div id="slide3" class="carousel-item relative w-full">
                    <div class="w-full flex items-center justify-center">
                        <img
                            src="https://srv.carbonads.net/static/30242/fba2b75980d7e962392c7481a2be33acdcf00528"
                            class="sm:w-60 sm:h-60"/>
                    </div>
                    <div class="absolute left-5 right-5 top-1/2 flex -translate-y-1/2 transform justify-between">
                        <a href="#slide2" class="btn btn-circle bg-white shadow-lg">❮</a>
                        <a href="#slide4" class="btn btn-circle bg-white shadow-lg">❯</a>
                    </div>
                </div>

                <div id="slide4" class="carousel-item relative w-full">
                    <div class="w-full flex items-center justify-center">
                        <img
                            src="https://flowbite.com/docs/images/book-light.svg"
                            class="sm:w-60 sm:h-60"/>
                    </div>
                    <div class="absolute left-5 right-5 top-1/2 flex -translate-y-1/2 transform justify-between">
                        <a href="#slide3" class="btn btn-circle bg-white shadow-lg">❮</a>
                        <a href="#slide1" class="btn btn-circle bg-white shadow-lg">❯</a>
                    </div>
                </div> --}}
            </div>
        </div>

    </div>

@endsection