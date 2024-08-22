<div class="sm:pl-2 pl-0">
    <label class="form-control w-full max-w-xs">
        <div class="label">
            <span class="label-text">Kegiatan Utama</span>
        </div>
        <input type="text" placeholder="Kegiatan Utama" name="kegiatan-utama" class="input input-bordered w-full max-w-xs"
        value="{{ $perusahaan->kegiatan_utama }}" required/>
    </label>

    <label class="form-control w-full max-w-xs">
        <div class="label">
            <span class="label-text">Kode KBLI</span>
        </div>
        <input type="text" placeholder="Kode KBLI" name="kode-kbli" class="input input-bordered w-full max-w-xs"
        value="{{ $perusahaan->kode_kbli }}" required/>
    </label>

    <label class="form-control w-full max-w-xs">
        <div class="label">
            <span class="label-text">Produk Utama</span>
        </div>
        <input type="text" placeholder="Produk Utama" name="produk-utama" class="input input-bordered w-full max-w-xs"
        value="{{ $perusahaan->produk_utama }}" required/>
    </label>

    <label class="form-control w-full max-w-xs">
        <div class="label">
            <span class="label-text">Kode KBKI</span>
        </div>
        <input type="text" placeholder="Kode KBKI" name="kode-kbki" class="input input-bordered w-full max-w-xs"
        value="{{ $perusahaan->kode_kbki }}" required/>
    </label>

    <label class="form-control w-full max-w-xs">
        <div class="label">
            <span class="label-text">Pilih Jenis Kepemilikan</span>
        </div>
        <select class="select select-bordered" name="kode-jenis-kepemilikan" id="kode-jenis-kepemilikan">
            <option value="-">Pilih Jenis Kepemilikan</option>
            @foreach ($jenisKepemilikans as $jenisKepemilikan)
                <option value="{{ $jenisKepemilikan->kode_jenis_kepemilikan }}"
                    {{ ($jenisKepemilikan->kode_jenis_kepemilikan === $perusahaan->kode_jenis_kepemilikan)? 'selected' : '' }}>
                    {{ $jenisKepemilikan->nama_jenis_kepemilikan }}
                </option>
            @endforeach
        </select>
    </label>
    <div id="warning-message-kode-jenis-kepemilikan" class="text-left text-red pl-4" style="display:none">
        Silakan pilih terlebih dahulu.
    </div>

    <label class="form-control w-full max-w-xs">
        <div class="label">
            <span class="label-text">Pilih Bentuk Badan Usaha</span>
        </div>
        <select class="select select-bordered" name="kode-bentuk-badan-usaha" id="kode-bentuk-badan-usaha">
            <option value="-">Pilih Bentuk Badan Usaha</option>
            @foreach ($bentukBadanUsahas as $bentukBadanUsaha)
                <option value="{{ $bentukBadanUsaha->kode_bentuk_badan_usaha }}"
                    {{ ($bentukBadanUsaha->kode_bentuk_badan_usaha === $perusahaan->kode_bentuk_badan_usaha)? 'selected' : '' }}>
                    {{ $bentukBadanUsaha->nama_bentuk_badan_usaha }}
                </option>
            @endforeach
        </select>
    </label>
    <div id="warning-message-kode-bentuk-badan-usaha" class="text-left text-red pl-4" style="display:none">
        Silakan pilih terlebih dahulu.
    </div>

    <label class="form-control w-full max-w-xs">
        <div class="label">
            <span class="label-text">Pilih Laporan Keuangan</span>
        </div>
        <select class="select select-bordered" name="kode-laporan-keuangan" id="kode-laporan-keuangan">
            <option value="-">Pilih Laporan Keuangan</option>
            @foreach ($laporanKeuangans as $laporanKeuangan)
                <option value="{{ $laporanKeuangan->kode_laporan_keuangan }}"
                    {{ ($laporanKeuangan->kode_laporan_keuangan === $perusahaan->kode_laporan_keuangan)? 'selected' : '' }}>
                    {{ $laporanKeuangan->nama_laporan_keuangan }}</option>
            @endforeach
        </select>
    </label>
    <div id="warning-message-kode-laporan-keuangan" class="text-left text-red pl-4" style="display:none">
        Silakan pilih terlebih dahulu.
    </div>

    <label class="form-control w-full max-w-xs">
        <div class="label">
            <span class="label-text">Tahun Berdiri</span>
        </div>
        <input type="text" placeholder="Tahun Berdiri" name="tahun-berdiri" class="input input-bordered w-full max-w-xs"
        value="{{ $perusahaan->tahun_berdiri }}" required/>
    </label>

    <label class="form-control w-full max-w-xs">
        <div class="label">
            <span class="label-text">Tahun Mulai Beroperasi</span>
        </div>
        <input type="text" placeholder="Tahun Mulai Beroperasi" name="tahun-mulai-beroperasi" class="input input-bordered w-full max-w-xs"
        value="{{ $perusahaan->tahun_mulai_beroperasi }}" required/>
    </label>

    <label class="form-control w-full max-w-xs">
        <div class="label">
            <span class="label-text">No Induk Berusaha</span>
        </div>
        <input type="text" placeholder="No Induk Berusaha" name="no-induk-berusaha" class="input input-bordered w-full max-w-xs"
        value="{{ $perusahaan->no_induk_berusaha }}" required/>
    </label>
</div>

<script>
    document.getElementById('blok-form').addEventListener('submit', function(event) {
        // Ambil elemen select
        var jenisKepemilikan = document.getElementById('kode-jenis-kepemilikan');

        // Ambil nilai yang dipilih
        var selectedJenisKepemilikan = jenisKepemilikan.value;

        // Ambil elemen peringatan
        var warningMessageJenisKepemilikan = document.getElementById('warning-message-kode-jenis-kepemilikan');

        // Cek jika nilai yang dipilih adalah placeholder (kosong)
        if (selectedJenisKepemilikan === "-") {
            // Tampilkan peringatan
            warningMessageJenisKepemilikan.style.display = 'block';
            // Hentikan pengiriman form
            event.preventDefault();
        } else {
            // Sembunyikan peringatan jika nilai valid
            warningMessageJenisKepemilikan.style.display = 'none';
        }


        // Ambil elemen select
        var bentukBadanUsaha = document.getElementById('kode-bentuk-badan-usaha');

        // Ambil nilai yang dipilih
        var selectedBentukBadanUsaha = bentukBadanUsaha.value;

        // Ambil elemen peringatan
        var warningMessageBentukBadanUsaha = document.getElementById('warning-message-kode-bentuk-badan-usaha');

        // Cek jika nilai yang dipilih adalah placeholder (kosong)
        if (selectedBentukBadanUsaha === "-") {
            // Tampilkan peringatan
            warningMessageBentukBadanUsaha.style.display = 'block';
            // Hentikan pengiriman form
            event.preventDefault();
        } else {
            // Sembunyikan peringatan jika nilai valid
            warningMessageBentukBadanUsaha.style.display = 'none';
        }


        // Ambil elemen select
        var laporanKeuangan = document.getElementById('kode-laporan-keuangan');

        // Ambil nilai yang dipilih
        var selectedLaporanKeuangan = laporanKeuangan.value;

        // Ambil elemen peringatan
        var warningMessageLaporanKeuangan = document.getElementById('warning-message-kode-laporan-keuangan');

        // Cek jika nilai yang dipilih adalah placeholder (kosong)
        if (selectedLaporanKeuangan === "-") {
            // Tampilkan peringatan
            warningMessageLaporanKeuangan.style.display = 'block';
            // Hentikan pengiriman form
            event.preventDefault();
        } else {
            // Sembunyikan peringatan jika nilai valid
            warningMessageLaporanKeuangan.style.display = 'none';
        }
    });
</script>
