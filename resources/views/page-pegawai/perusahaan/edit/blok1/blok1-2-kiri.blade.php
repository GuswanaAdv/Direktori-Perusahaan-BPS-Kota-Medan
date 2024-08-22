<div class="sm:pl-2 pl-0">
    <label class="form-control w-full max-w-xs">
        <div class="label">
            <span class="label-text">Pilih Unit Statistik</span>
        </div>
        <select class="select select-bordered" name="kode-unit-statistik" id="kode-unit-statistik">
            <option value="-">Pilih Unit Statistik</option>
            @foreach ($unitStatistiks as $unitStatistik)
                <option value="{{ $unitStatistik->kode_unit_statistik }}"
                    {{ ($unitStatistik->kode_unit_statistik === $perusahaan->kode_unit_statistik)? 'selected' : '' }}>
                    {{ $unitStatistik->nama_unit_statistik }}
                </option>
            @endforeach
        </select>
    </label>
    <div id="warning-message-kode-unit-statistik" class="text-left text-red pl-4" style="display:none">
        Silakan pilih kegiatan terlebih dahulu.
    </div>

    <label class="form-control w-full max-w-xs">
        <div class="label">
            <span class="label-text">Provinsi</span>
        </div>
        <input type="text" placeholder="Provinsi" name="provinsi" class="input input-bordered w-full max-w-xs"
        value="{{ $perusahaan->provinsi }}" required readonly/>
    </label>

    <label class="form-control w-full max-w-xs">
        <div class="label">
            <span class="label-text">Kabupaten</span>
        </div>
        <input type="text" placeholder="Kabupaten" name="kabupaten" class="input input-bordered w-full max-w-xs"
        value="{{ $perusahaan->kabupaten }}" required readonly/>
    </label>

    <label class="form-control w-full max-w-xs">
        <div class="label">
            <span class="label-text">Kecamatan</span>
        </div>
        <input type="text" placeholder="Kecamatan" name="kecamatan" class="input input-bordered w-full max-w-xs"
        value="{{ $perusahaan->kecamatan }}" required/>
    </label>

    <label class="form-control w-full max-w-xs">
        <div class="label">
            <span class="label-text">Kelurahan</span>
        </div>
        <input type="text" placeholder="Kelurahan" name="kelurahan" class="input input-bordered w-full max-w-xs"
        value="{{ $perusahaan->kelurahan }}" required/>
    </label>

    <label class="form-control w-full max-w-xs">
        <div class="label">
            <span class="label-text">Nama SLS</span>
        </div>
        <input type="text" placeholder="Nama SLS" name="nama-sls" class="input input-bordered w-full max-w-xs"
        value="{{ $perusahaan->nama_sls }}" required/>
    </label>

    <label class="form-control w-full max-w-xs">
        <div class="label">
            <span class="label-text">Alamat SBR</span>
        </div>
        <input type="text" placeholder="Alamat SBR" name="alamat-sbr" class="input input-bordered w-full max-w-xs"
        value="{{ $perusahaan->alamat_sbr }}" required/>
    </label>

    <label class="form-control w-full max-w-xs">
        <div class="label">
            <span class="label-text">Alamat Pencacahan</span>
        </div>
        <input type="text" placeholder="Alamat Pencacahan" name="alamat-pencacahan" class="input input-bordered w-full max-w-xs"
        value="{{ $perusahaan->alamat_pencacahan }}" required/>
    </label>
</div>

<script>
    document.getElementById('blok-form').addEventListener('submit', function(event) {
        // Ambil elemen select
        var unitStatistik = document.getElementById('kode-unit-statistik');
        // Ambil nilai yang dipilih
        var selectedUnitStatistik = unitStatistik.value;

        // Ambil elemen peringatan
        var warningMessageUnitStatistik = document.getElementById('warning-message-kode-unit-statistik');

        // Cek jika nilai yang dipilih adalah placeholder (kosong)
        if (selectedUnitStatistik === "-") {
            // Tampilkan peringatan
            warningMessageUnitStatistik.style.display = 'block';
            // Hentikan pengiriman form
            event.preventDefault();
        } else {
            // Sembunyikan peringatan jika nilai valid
            warningMessageUnitStatistik.style.display = 'none';
        }
    });
</script>
