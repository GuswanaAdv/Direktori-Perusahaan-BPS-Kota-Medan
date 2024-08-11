<div class="m-4 font-bold text-2-xl p-4 bg-white rounded-xl">
    <p>Riwayat Ikut Serta : {{$petugas->nama_petugas}}</p>
</div>
<div class="overflow-x-auto">
    @if ($petugas->perusahaanKegiatan->isEmpty())
        <p class="text-2xl text-red text-center bg-white py-4 rounded-xl"> Petugas belum bertugas </p>
    @else
        <table class="table table-zebra bg-white">
            <!-- head -->
            <thead>
            <tr>
                <th></th>
                <th>Kegiatan</th>
                <th>Tanggal Mencacah</th>
                <th>Sampel Perusahaan</th>
                <th>Alamat Perusahaan</th>
                <th>Keterangan</th>
            </tr>
            </thead>

            <tbody>
                @php
                    $no = 0;
                @endphp

                @foreach ($petugas->perusahaanKegiatan as $kegiatan)
                    @php
                        $no++;
                    @endphp
                    <!-- row 1 -->
                    <tr>
                        <th>{{$no}}</th>
                        <td>{{!empty($kegiatan->kegiatanStatistik->nama_kegiatan)? $kegiatan->kegiatanStatistik->nama_kegiatan : ""}}</td>
                        <td>{{!empty($kegiatan->tanggal_kegiatan)? date('d-m-Y', strtotime($kegiatan->tanggal_kegiatan)) : ""}}</td>
                        <td>{{!empty($kegiatan->perusahaan->nama_usaha)? $kegiatan->perusahaan->nama_usaha : ""}}</td>
                        <td>{{!empty($kegiatan->perusahaan->alamat_sbr)? $kegiatan->perusahaan->alamat_sbr : ""}}</td>
                        <td>{{!empty($kegiatan->keterangan)? $kegiatan->keterangan : ""}}</td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    @endif
</div>
