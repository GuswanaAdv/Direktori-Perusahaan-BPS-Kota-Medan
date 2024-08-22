<div>
    <label class="form-control w-full max-w-xs">
        <div class="label">
            <span class="label-text">Pilih Skala Usaha</span>
        </div>
        <select class="select select-bordered" name="kode-skala-usaha" id="kode-skala-usaha">
            <option value="-">Pilih Skala Usaha</option>
            @foreach ($skalaUsahas as $skalaUsaha)
                <option value="{{ $skalaUsaha->kode_skala_usaha }}"
                    {{ ($skalaUsaha->kode_skala_usaha === $perusahaan->kode_skala_usaha)? 'selected' : '' }}>
                    {{ $skalaUsaha->nama_skala_usaha }}
                </option>
            @endforeach
        </select>
    </label>
    <div id="warning-message-kode-skala-usaha" class="text-left text-red pl-4" style="display:none">
        Silakan pilih terlebih dahulu.
    </div>

    <label class="form-control w-full max-w-xs">
        <div class="label">
            <span class="label-text">Pilih Jaringan Usaha</span>
        </div>
        <select class="select select-bordered" name="kode-jaringan-usaha" id="kode-jaringan-usaha">
            <option value="-">Pilih Jaringan Usaha</option>
            @foreach ($jaringanUsahas as $jaringanUsaha)
                <option value="{{ $jaringanUsaha->kode_jaringan_usaha }}"
                    {{ ($jaringanUsaha->kode_jaringan_usaha === $perusahaan->kode_jaringan_usaha)? 'selected' : '' }}>
                    {{ $jaringanUsaha->nama_jaringan_usaha }}
                </option>
            @endforeach
        </select>
    </label>
    <div id="warning-message-kode-jaringan-usaha" class="text-left text-red pl-4" style="display:none">
        Silakan pilih terlebih dahulu.
    </div>

    <label class="form-control w-full max-w-xs">
        <div class="label">
            <span class="label-text">Pilih Preferensi</span>
        </div>
        <select class="select select-bordered" name="kode-preferensi" id="kode-preferensi">
            <option value="-">Pilih Preferensi</option>
            @foreach ($preferensis as $preferensi)
                <option value="{{ $preferensi->kode_preferensi }}"
                    {{ ($preferensi->kode_preferensi === $perusahaan->kode_preferensi)? 'selected' : '' }}>
                    {{ $preferensi->nama_preferensi }}
                </option>
            @endforeach
        </select>
    </label>
    <div id="warning-message-kode-preferensi" class="text-left text-red pl-4" style="display:none">
        Silakan pilih terlebih dahulu.
    </div>

    <label class="form-control w-full max-w-xs">
        <div class="label">
            <span class="label-text">Nama Kantor Pusat</span>
        </div>
        <input type="text" placeholder="Nama Kantor Pusat" name="nama-kantor-pusat" class="input input-bordered w-full max-w-xs"
        value="{{ $perusahaan->nama_kantor_pusat }}" required/>
    </label>

    <label class="form-control w-full max-w-xs">
        <div class="label">
            <span class="label-text">Alamat Kantor Pusat</span>
        </div>
        <input type="text" placeholder="Alamat Kantor Pusat" name="alamat-kantor-pusat" class="input input-bordered w-full max-w-xs"
        value="{{ $perusahaan->alamat_kantor_pusat }}" required/>
    </label>

    <label class="form-control w-full max-w-xs">
        <div class="label">
            <span class="label-text">Email Kantor Pusat</span>
        </div>
        <input type="text" placeholder="Email Kantor Pusat" name="email-kantor-pusat" class="input input-bordered w-full max-w-xs"
        value="{{ $perusahaan->email_kantor_pusat }}" required/>
    </label>

    <label class="form-control w-full max-w-xs">
        <div class="label">
            <span class="label-text">Negara Kantor Pusat</span>
        </div>
        <input type="text" placeholder="Negara Kantor Pusat" name="negara-kantor-pusat" class="input input-bordered w-full max-w-xs"
        value="{{ $perusahaan->negara_kantor_pusat }}" required/>
    </label>

    <label class="form-control w-full max-w-xs">
        <div class="label">
            <span class="label-text">Provinsi Kantor Pusat</span>
        </div>
        <input type="text" placeholder="Provinsi Kantor Pusat" name="provinsi-kantor-pusat" class="input input-bordered w-full max-w-xs"
        value="{{ $perusahaan->provinsi_kantor_pusat }}" required/>
    </label>

    <label class="form-control w-full max-w-xs">
        <div class="label">
            <span class="label-text">Kabupaten Kantor Pusat</span>
        </div>
        <input type="text" placeholder="Kabupaten Kantor Pusat" name="kabupaten-kantor-pusat" class="input input-bordered w-full max-w-xs"
        value="{{ $perusahaan->kabupaten_kantor_pusat }}" required/>
    </label>

    <label class="form-control w-full max-w-xs">
        <div class="label">
            <span class="label-text">Kecamatan Kantor Pusat</span>
        </div>
        <input type="text" placeholder="Kecamatan Kantor Pusat" name="kecamatan-kantor-pusat" class="input input-bordered w-full max-w-xs"
        value="{{ $perusahaan->kecamatan_kantor_pusat }}" required/>
    </label>
</div>

<script>
    document.getElementById('blok-form').addEventListener('submit', function(event) {
        // Ambil elemen select
        var skalaUsaha = document.getElementById('kode-skala-usaha');

        // Ambil nilai yang dipilih
        var selectedSkalaUsaha = skalaUsaha.value;

        // Ambil elemen peringatan
        var warningMessageSkalaUsaha = document.getElementById('warning-message-kode-skala-usaha');

        // Cek jika nilai yang dipilih adalah placeholder (kosong)
        if (selectedSkalaUsaha === "-") {
            // Tampilkan peringatan
            warningMessageSkalaUsaha.style.display = 'block';
            // Hentikan pengiriman form
            event.preventDefault();
        } else {
            // Sembunyikan peringatan jika nilai valid
            warningMessageSkalaUsaha.style.display = 'none';
        }


        // Ambil elemen select
        var jaringanUsaha = document.getElementById('kode-jaringan-usaha');

        // Ambil nilai yang dipilih
        var selectedJaringanUsaha = jaringanUsaha.value;

        // Ambil elemen peringatan
        var warningMessageJaringanUsaha = document.getElementById('warning-message-kode-jaringan-usaha');

        // Cek jika nilai yang dipilih adalah placeholder (kosong)
        if (selectedJaringanUsaha === "-") {
            // Tampilkan peringatan
            warningMessageJaringanUsaha.style.display = 'block';
            // Hentikan pengiriman form
            event.preventDefault();
        } else {
            // Sembunyikan peringatan jika nilai valid
            warningMessageJaringanUsaha.style.display = 'none';
        }


        // Ambil elemen select
        var preferensi = document.getElementById('kode-preferensi');

        // Ambil nilai yang dipilih
        var selectedPreferensi = preferensi.value;

        // Ambil elemen peringatan
        var warningMessagePreferensi = document.getElementById('warning-message-kode-preferensi');

        // Cek jika nilai yang dipilih adalah placeholder (kosong)
        if (selectedPreferensi === "-") {
            // Tampilkan peringatan
            warningMessagePreferensi.style.display = 'block';
            // Hentikan pengiriman form
            event.preventDefault();
        } else {
            // Sembunyikan peringatan jika nilai valid
            warningMessagePreferensi.style.display = 'none';
        }
    });
</script>
