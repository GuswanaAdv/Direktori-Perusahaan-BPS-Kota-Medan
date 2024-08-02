@extends('layout.app')
@section('content')
    @include('component.searchbar')
    <div id="beranda" class="bg-lightgrey">
        <div class="flex items-center justify-center pt-4">
            <div class="flex sm:space-x-12 grid sm:grid-cols-2 grid-cols-1">
                <div class="flex items-center justify-center py-4">
                    <button class="btn border-darkblue text-darkblue bg-white hover:border-darkblue hover:bg-white hover:text-darkblue">
                        Daftar Petugas:
                    </button>
                </div>
                <div class="flex items-center justify-center py-4">
                    <button class="btn border-darkblue text-darkblue bg-white hover:bg-darkblue hover:text-white">
                        Tambah Petugas
                        <img src="https://cdn1.iconfinder.com/data/icons/unicons-line-vol-5/24/plus-circle-64.png" 
                        alt=""
                        height="32"
                        width="32">
                    </button>
                </div>
            </div>
        </div>

        <div class="flex items-center justify-center py-8">
            <div class="overflow-x-auto">
                <table class="table table-zebra bg-white">
                    <!-- head -->
                    <thead>
                    <tr>
                        <th></th>
                        <th>Name</th>
                        <th>Job</th>
                        <th>Favorite Color</th>
                        <th>Detail</th>
                    </tr>
                    </thead>
                    
                    <tbody>
                        @php
                            $no = ($petugass->currentPage() - 1) * $petugass->perPage();
                        @endphp
                        
                        @foreach ($petugass as $petugas)
                            @php
                                $no++;
                            @endphp
                            <!-- row 1 -->
                            <tr>
                                <th>{{$no}}</th>
                                <td>{{!empty($petugas->nama_petugas)? $petugas->nama_petugas : ""}}</td>
                                <td>Quality Control Specialist</td>
                                <td>Blue</td>
                                <td>
                                    <button class="btn btn-ghost btn-xs">details</button>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>

        <div class="flex items-center justify-center pb-16">
            {{ $petugass->appends(request()->input())->links('vendor.pagination.tailwind-2') }}
        </div>

    </div>

@endsection