<div>
    <label class="form-control w-full max-w-xs">
        <div class="label">
            <span class="label-text">Kode Pos</span>
        </div>
        <input type="text" placeholder="Kode Pos" name="kode-pos" class="input input-bordered w-full max-w-xs"
        value="{{ $perusahaan->kode_pos }}" required/>
    </label>

    <label class="form-control w-full max-w-xs">
        <div class="label">
            <span class="label-text">Telepon</span>
        </div>
        <input type="text" placeholder="Telepon" name="telepon" class="input input-bordered w-full max-w-xs"
        value="{{ $perusahaan->telepon }}" required/>
    </label>

    <label class="form-control w-full max-w-xs">
        <div class="label">
            <span class="label-text">Email</span>
        </div>
        <input type="text" placeholder="Email" name="email" class="input input-bordered w-full max-w-xs"
        value="{{ $perusahaan->email }}" required/>
    </label>

    <label class="form-control w-full max-w-xs">
        <div class="label">
            <span class="label-text">Website</span>
        </div>
        <input type="text" placeholder="Website" name="website" class="input input-bordered w-full max-w-xs"
        value="{{ $perusahaan->website }}" required/>
    </label>

    <label class="form-control w-full max-w-xs">
        <div class="label">
            <span class="label-text">Pilih Kondisi Perusahaan</span>
        </div>
        <select class="select select-bordered" name="kode-kondisi-perusahaan" id="kode-kondisi-perusahaan">
            <option value="-">Pilih Kondisi Perusahaan</option>
            @foreach ($kondisiPerusahaans as $kondisiPerusahaan)
                <option value="{{ $kondisiPerusahaan->kode_kondisi_perusahaan }}"
                    {{ ($kondisiPerusahaan->kode_kondisi_perusahaan === $perusahaan->kode_kondisi_perusahaan)? 'selected' : ''}}>
                    {{ $kondisiPerusahaan->nama_kondisi_perusahaan }}
                </option>
            @endforeach
        </select>
    </label>
    <div id="warning-message-kode-kondisi-perusahaan" class="text-left text-red pl-4" style="display:none">
        Silakan pilih kegiatan terlebih dahulu.
    </div>

    <label class="form-control w-full max-w-xs">
        <div class="label">
            <span class="label-text">Lattitude</span>
        </div>
        <input type="text" placeholder="Lattitude" name="lattitude" class="input input-bordered w-full max-w-xs"
        value="{{ $perusahaan->lattitude }}" required/>
    </label>

    <label class="form-control w-full max-w-xs">
        <div class="label">
            <span class="label-text">Longitude</span>
        </div>
        <input type="text" placeholder="Longitude" name="longitude" class="input input-bordered w-full max-w-xs"
        value="{{ $perusahaan->longitude }}" required/>
    </label>
</div>

<script>
    document.getElementById('blok-form').addEventListener('submit', function(event) {
        // Ambil elemen select
        var kondisiPerusahaan = document.getElementById('kode-kondisi-perusahaan');

        // Ambil nilai yang dipilih
        var selectedKondisiPerusahaan = kondisiPerusahaan.value;

        // Ambil elemen peringatan
        var warningMessageKondisiPerusahaan = document.getElementById('warning-message-kode-kondisi-perusahaan');

        // Cek jika nilai yang dipilih adalah placeholder (kosong)
        if (selectedKondisiPerusahaan === "-") {
            // Tampilkan peringatan
            warningMessageKondisiPerusahaan.style.display = 'block';
            // Hentikan pengiriman form
            event.preventDefault();
        } else {
            // Sembunyikan peringatan jika nilai valid
            warningMessageKondisiPerusahaan.style.display = 'none';
        }
    });
</script>
