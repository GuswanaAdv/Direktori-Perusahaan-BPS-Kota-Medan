<div class="sm:pl-2 pl-0">
    <label class="form-control w-full max-w-xs">
        <div class="label">
            <span class="label-text">Pilih Kegiatan Statistik</span>
        </div>
        <select class="select select-bordered" name="kode-kegiatan" id="kode-kegiatan">
            <option value="-">Pilih Kegiatan Statistik</option>
            @foreach ($kegiatans as $kegiatan)
                <option value="{{ $kegiatan->kode_kegiatan }}">{{ $kegiatan->nama_kegiatan }}</option>
            @endforeach
        </select>
    </label>
    <div id="warning-message-kode-kegiatan" class="text-left text-red pl-4" style="display:none">
        Silakan pilih terlebih dahulu.
    </div>

    <label class="form-control w-full max-w-xs">
        <div class="label">
            <span class="label-text">NIP</span>
        </div>
        <input type="text" placeholder="NIP" name="nip"
        class="input input-bordered w-full max-w-xs"
        value="{{ Auth::user()->pegawai->nip }}"
        required readonly/>
    </label>

    <label class="form-control w-full max-w-xs">
        <div class="label">
            <span class="label-text">Nama Pegawai</span>
        </div>
        <input type="text" placeholder="Nama Pegawai" name="nama-pegawai"
        class="input input-bordered w-full max-w-xs"
        value="{{ Auth::user()->pegawai->nama_pegawai }}"
        required readonly/>
    </label>
</div>

<div>
    <label class="form-control w-full max-w-xs">
        <div class="label">
            <span class="label-text">ID Perusahaan</span>
        </div>
        <input type="text" placeholder="ID Perusahaan" name="id-perusahaan" class="input input-bordered w-full max-w-xs"
        value="{{ $id_perusahaan }}" required/>
    </label>

    <label class="form-control w-full max-w-xs">
        <div class="label">
            <span class="label-text">ID SBR</span>
        </div>
        <input type="text" placeholder="ID SBR" name="id-sbr" class="input input-bordered w-full max-w-xs"
        value="{{ $perusahaan->id_sbr }}" required/>
    </label>

    <label class="form-control w-full max-w-xs">
        <div class="label">
            <span class="label-text">Nama Usaha</span>
        </div>
        <input type="text" placeholder="Nama Usaha" name="nama-usaha" class="input input-bordered w-full max-w-xs"
        value="{{ $perusahaan->nama_usaha }}" required/>
    </label>

    <label class="form-control w-full max-w-xs">
        <div class="label">
            <span class="label-text">Nama Komersial</span>
        </div>
        <input type="text" placeholder="Nama Komersial" name="nama-komersial" class="input input-bordered w-full max-w-xs"
        value="{{ $perusahaan->nama_komersial }}" required/>
    </label>
</div>

<script>
    document.getElementById('blok-form').addEventListener('submit', function(event) {
        // Ambil elemen select
        var kegiatanStatistik = document.getElementById('kode-kegiatan');

        // Ambil nilai yang dipilih
        var selectedKegiatanStatistik = kegiatanStatistik.value;

        // Ambil elemen peringatan
        var warningMessageKegiatanStatistik = document.getElementById('warning-message-kode-kegiatan');

        // Cek jika nilai yang dipilih adalah placeholder (kosong)
        if (selectedKegiatanStatistik === "-") {
            // Tampilkan peringatan
            warningMessageKegiatanStatistik.style.display = 'block';
            // Hentikan pengiriman form
            event.preventDefault();
        } else {
            // Sembunyikan peringatan jika nilai valid
            warningMessageKegiatanStatistik.style.display = 'none';
        }
    });
</script>
