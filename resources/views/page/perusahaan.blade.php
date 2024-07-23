@extends('layout.app')
@section('content')
    @include('component.searchbar')
    <div id="beranda" class="bg-lightgrey">
        <div class="flex items-center justify-center pt-4">
            <div class="flex space-x-40">
                <button class="btn border-darkblue text-darkblue bg-white hover:border-darkblue hover:bg-white hover:text-darkblue">
                    Daftar Perusahaan:
                </button>
                <button class="btn border-darkblue text-darkblue bg-white hover:bg-darkblue hover:text-white">
                    Tambah Perusahaan
                    <img src="https://cdn1.iconfinder.com/data/icons/unicons-line-vol-5/24/plus-circle-64.png" 
                    alt=""
                    height="32"
                    width="32">
                </button>
            </div>
        </div>

        <div class="flex items-center justify-center py-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
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
        </div>

    </div>

@endsection