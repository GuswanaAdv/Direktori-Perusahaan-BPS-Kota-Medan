<div class="overflow-x-auto w-full">
    <table class="table table-zebra w-full">
      <!-- head -->
      <thead>
        <tr>
          <th></th>
          <th>Perusahaan</th>
          <th>Alamat</th>
          <th>Petugas</th>
          <th>Tanggal</th>
          <th>Penanggungjawab</th>
          <th>Keterangan</th>
        </tr>
      </thead>
      <tbody>
        <!-- row 1 -->
        @if (!empty($kegiatanStatistik->pembaruan->keterangan)&&$kegiatanStatistik->pembaruan->keterangan === 'menunggu proses update')
            @php
                $no = ($perusahaanSementaras->currentPage() - 1) * $perusahaanSementaras->perPage();
            @endphp
            @foreach ($perusahaanSementaras as $row)
                @php
                    $no++;
                @endphp
                <tr>
                    <th>{{$no}}</th>
                    <td>{{!empty($row->nama_usaha)? $row->nama_usaha: " "}}</td>
                    <td>{{!empty($row->alamat_sbr)? $row->alamat_sbr: " "}}</td>
                    <td>{{!empty($row->nama_petugas)? $row->nama_petugas: " "}}</td>
                    <td>{{!empty($row->kegiatanStatistik->tanggal_mulai)? date('d-m-Y', strtotime($row->kegiatanStatistik->tanggal_mulai)): " "}}</td>
                    <td>{{!empty($row->pegawai->nip)? $row->pegawai->nip: " "}}</td>
                    <td>{{!empty($row->kegiatanStatistik->pembaruan->keterangan)? $row->kegiatanStatistik->pembaruan->keterangan: " "}}</td>
                </tr>
            @endforeach
        @else
            @php
                $no = ($perusahaanKegiatans->currentPage() - 1) * $perusahaanKegiatans->perPage();
            @endphp
            @foreach ($perusahaanKegiatans as $row)
                @php
                    $no++;
                @endphp
                <tr>
                    <th>{{$no}}</th>
                    <td>{{!empty($row->perusahaan->nama_usaha)? $row->perusahaan->nama_usaha: " "}}</td>
                    <td>{{!empty($row->perusahaan->alamat_sbr)? $row->perusahaan->alamat_sbr: " "}}</td>
                    <td>{{!empty($row->petugas->nama_petugas)? $row->petugas->nama_petugas: " "}}</td>
                    <td>{{!empty($row->tanggal_kegiatan)? date('d-m-Y', strtotime($row->tanggal_kegiatan)): " "}}</td>
                    <td>{{!empty($row->pegawai->nama_pegawai)? $row->pegawai->nama_pegawai: " "}}</td>
                    <td>{{!empty($row->keterangan)? $row->keterangan: " "}}</td>
                </tr>
            @endforeach
        @endif

      </tbody>
    </table>
</div>
