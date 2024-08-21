@extends('layout.pegawai')
@section('content')
    <div class="flex items-center justify-center py-8">
        <div class="card bg-white sm:w-3/4 shadow-xl w-full">
            <div class="card-body w-full text-2xl text-left sm:px-20 border-b-2 font-bold">
                Menunggu Persetujuan
            </div>
            @include('component.pesan')
            <div class="card-body w-full text-left sm:px-20 border-b-2 font-bold">
                <div class="flex items-center justify-center py-8 w-full">
                    <div class="overflow-x-auto shadow-xl">
                        <table class="table table-zebra bg-white shadow-2xl">
                            <!-- head -->
                            <thead>
                            <tr class="text-center">
                                <th></th>
                                <th>Nama</th>
                                <th>Kegiatan</th>
                                <th>Keterangan</th>
                                <th>Periksa</th>
                            </tr>
                            </thead>

                            <tbody>
                                @php
                                    $no = 0;
                                @endphp
                                @if (count($pembaruans) == 0)
                                    <tr>
                                        <td colspan="6" class="text-center text-red">Belum ada pembaruan data perusahaan</td>
                                    </tr>
                                @else
                                    @foreach ($pembaruans as $pembaruan)
                                        @if ($pembaruan->pegawai->nip == Auth::user()->pegawai->nip)
                                            @php
                                                $no++;
                                            @endphp
                                            <tr>
                                                <td>{{ $no }}</td>
                                                <td>{{ $pembaruan->pegawai->nama_pegawai }}</td>
                                                <td>{{ $pembaruan->kegiatanStatistik->nama_kegiatan }}</td>
                                                <td>{{ $pembaruan->keterangan }}</td>
                                                <td>
                                                    <a href="{{ route('perusahaan-aproval-cek', ['id_pembaruan' => $pembaruan->id_pembaruan]) }}"
                                                    class="btn bg-orange text-white hover:bg-yellowpastel hover:text-darkgrey">Periksa</a>
                                                </td>
                                            </tr>
                                        @endif
                                        @if ($no == 0)
                                            <tr>
                                                <td colspan="6" class="text-center text-red">Belum ada pembaruan data perusahaan</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                @endif

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card-body w-full text-left sm:px-20 border-b-2 font-bold">

            </div>
        </div>
    </div>
@endsection
