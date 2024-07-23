@extends('layout.app')
@section('content')
    @include('component.searchbar')
    <div id="beranda" class="bg-lightgrey">
        <div class="flex items-center justify-center pt-4">
            <a class="btn border-darkblue text-darkblue bg-white hover:bg-darkblue hover:text-white"
             href="{{route('survei')}}">Survei Bulan Ini:</a>
        </div>

        <div class="flex items-center justify-center py-8">
            <div class="carousel sm:w-2/4">
                <div id="slide1" class="carousel-item relative w-full">
                    <div class="w-full flex items-center justify-center">
                        <div class="card bg-base-100 w-96 shadow-xl">
                            <figure class="px-10 pt-10">
                              <img
                                src="https://img.daisyui.com/images/stock/photo-1606107557195-0e29a4b5b4aa.webp"
                                alt="Shoes"
                                class="rounded-xl" />
                            </figure>
                            <div class="card-body items-center text-center">
                              <h2 class="card-title">Shoes!</h2>
                              <p>If a dog chews shoes whose shoes does he choose?</p>
                              <div class="card-actions">
                                <button class="btn btn-primary">Buy Now</button>
                              </div>
                            </div>
                        </div>
                    </div>
                    <div class="absolute left-5 right-5 top-1/2 flex -translate-y-1/2 transform justify-between">
                        <a href="#slide4" class="btn btn-circle bg-white shadow-lg">❮</a>
                        <a href="#slide2" class="btn btn-circle bg-white shadow-lg">❯</a>
                    </div>
                </div>

                <div id="slide2" class="carousel-item relative w-full">
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
                </div>
              </div>
        </div>

    </div>

@endsection