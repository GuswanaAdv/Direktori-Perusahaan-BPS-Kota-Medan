@extends('layout.app')
@section('content')
    <div class="flex items-center justify-center py-8">
        <div class="card bg-white sm:w-3/4 shadow-xl w-full">
            <div class="card-body w-full text-left sm:px-20 border-b-2">
                <div class="w-full sm:flex sm:items-center sm:justify-center">
                    <h2 class="sm:w-2/4 w-full text-center text-3xl font-bold pb-8">
                        {{!empty($perusahaan->nama_usaha)? $perusahaan->nama_usaha : ""}}
                    </h2>
                </div>
                <p>{{!empty($perusahaan->provinsi)? "Provinsi : ".$perusahaan->provinsi : ""}}</p>
                <p>{{!empty($perusahaan->kabupaten)? "Kabupaten : ".$perusahaan->kabupaten : ""}}</p>
                <p>{{!empty($perusahaan->kecamatan)? "Kecamatan : ".$perusahaan->kecamatan : ""}}</p>
                <p>{{!empty($perusahaan->kelurahan)? " Kelurahan : ".$perusahaan->kelurahan : ""}}</p>
                <p>{{!empty($perusahaan->alamat_sbr)? "Alamat : ".$perusahaan->alamat_sbr : ""}}</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2">
                {{-- Map --}}
                 <div class="collapse bg-white border-r-2 border-b-2 rounded-none">
                     <input type="checkbox" />
                     <div class="collapse-title text-xl font-medium">
                         <a class="btn bg-darkblue text-white sm:mx-16">Lihat Peta</a>
                     </div>
                     <div class="collapse-content">
                         @if ($perusahaan->lattitude != 0)
                             @include('component.map')
                         @else
                             <p class="text-2xl text-red text-center"> Geotagging belum ditambahkan </p>
                         @endif
                     </div>
                 </div>
                 
                 
                 <div class="collapse bg-white border-b-2 rounded-none">
                     <input type="checkbox" />
                     <div class="collapse-title text-xl font-medium">
                         <a class="btn bg-darkblue text-white sm:mx-16">Informasi Tambahan</a>
                     </div>
                     <div class="collapse-content sm:mx-8 space-y-4">
                         <p>{{!empty($perusahaan->kegiatan_utama)? "Kegiatan Utama : ".$perusahaan->kegiatan_utama : ""}}</p>
                         <p>{{!empty($perusahaan->produk_utama)? "Produk Utama : ".$perusahaan->produk_utama : ""}}</p>
                         <p>{{!empty($perusahaan->jenisKepemilikan->nama_jenis_kepemilikan)? "Tipe Kepemilikan : ".$perusahaan->jenisKepemilikan->nama_jenis_kepemilikan : ""}}</p>
                     </div> 
                 </div> 
             </div>

            <div class="card-body w-full text-left sm:px-20 mb-8">
                <p>Riwayat Kegiatan Statistik</p>
                @if ($pesan == 'tidak ditemukan')
                    <p class="text-2xl text-red text-center"> Perusahaan belum pernah terpilih sebagai sampel </p>
                @else
                    @include('component.perusahaan-tabel')
                @endif
                
            </div>

            <div class="flex items-center justify-center pb-16">
                {{ $perusahaanKegiatans->appends(request()->input())->links('vendor.pagination.tailwind-2') }}
            </div>
        </div>    
    </div>  
@endsection