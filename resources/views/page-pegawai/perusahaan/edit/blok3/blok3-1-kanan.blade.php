<div>
    <label class="form-control w-full max-w-xs">
        <div class="label">
            <span class="label-text">Pilih Jabatan Penanggung Jawab</span>
        </div>
        <select class="select select-bordered" name="kode-jabatan-penanggungjawab" id="kode-jabatan-penanggungjawab">
            <option value="-">Pilih Jabatan Penanggung Jawab</option>
            @foreach ($jabatanPenanggungjawabs as $jabatanPenanggungjawab)
                <option value="{{ $jabatanPenanggungjawab->kode_jabatan_penanggungjawab }}"
                    {{ ($jabatanPenanggungjawab->kode_jabatan_penanggungjawab === $perusahaan->kode_jabatan_penanggungjawab)? 'selected' : '' }}>
                    {{ $jabatanPenanggungjawab->nama_jabatan_penanggungjawab }}
                </option>
            @endforeach
        </select>
    </label>
    <div id="warning-message-kode-jabatan-penanggungjawab" class="text-left text-red pl-4" style="display:none">
        Silakan pilih terlebih dahulu.
    </div>

    <label class="form-control w-full max-w-xs">
        <div class="label">
            <span class="label-text">Nama Pemegang Saham</span>
        </div>
        <input type="text" placeholder="Nama Pemegang Saham" name="nama-pemegang-saham" class="input input-bordered w-full max-w-xs"
        value="{{ $perusahaan->nama_pemegang_saham }}" required/>
    </label>

    <label class="form-control w-full max-w-xs">
        <div class="label">
            <span class="label-text">NPWP Perusahaan</span>
        </div>
        <input type="text" placeholder="NPWP Perusahaan" name="npwp-perusahaan" class="input input-bordered w-full max-w-xs"
        value="{{ $perusahaan->npwp_perusahaan }}" required/>
    </label>

    <label class="form-control w-full max-w-xs">
        <div class="label">
            <span class="label-text">Pilih Status Penanaman Modal</span>
        </div>
        <select class="select select-bordered" name="kode-status-penanaman-modal" id="kode-status-penanaman-modal">
            <option value="-">Pilih Status Penanaman Modal</option>
            @foreach ($statusPenanamanModals as $statusPenanamanModal)
                <option value="{{ $statusPenanamanModal->kode_status_penanaman_modal }}"
                    {{ ($statusPenanamanModal->kode_status_penanaman_modal === $perusahaan->kode_status_penanaman_modal)? 'selected' : '' }}>
                    {{ $statusPenanamanModal->nama_status_penanaman_modal }}
                </option>
            @endforeach
        </select>
    </label>
    <div id="warning-message-kode-status-penanaman-modal" class="text-left text-red pl-4" style="display:none">
        Silakan pilih terlebih dahulu.
    </div>
</div>


<script>
    document.getElementById('blok-form').addEventListener('submit', function(event) {
        // Ambil elemen select
        var jabatanPenanggungjawab = document.getElementById('kode-jabatan-penanggungjawab');

        // Ambil nilai yang dipilih
        var selectedJabatanPenanggungjawab = jabatanPenanggungjawab.value;

        // Ambil elemen peringatan
        var warningMessageJabatanPenanggungjawab = document.getElementById('warning-message-kode-jabatan-penanggungjawab');

        // Cek jika nilai yang dipilih adalah placeholder (kosong)
        if (selectedJabatanPenanggungjawab === "-") {
            // Tampilkan peringatan
            warningMessageJabatanPenanggungjawab.style.display = 'block';
            // Hentikan pengiriman form
            event.preventDefault();
        } else {
            // Sembunyikan peringatan jika nilai valid
            warningMessageJabatanPenanggungjawab.style.display = 'none';
        }


        // Ambil elemen select
        var statusPenanamanModal = document.getElementById('kode-status-penanaman-modal');

        // Ambil nilai yang dipilih
        var selectedStatusPenanamanModal = statusPenanamanModal.value;

        // Ambil elemen peringatan
        var warningMessageStatusPenanamanModal = document.getElementById('warning-message-kode-status-penanaman-modal');

        // Cek jika nilai yang dipilih adalah placeholder (kosong)
        if (selectedStatusPenanamanModal === "-") {
            // Tampilkan peringatan
            warningMessageStatusPenanamanModal.style.display = 'block';
            // Hentikan pengiriman form
            event.preventDefault();
        } else {
            // Sembunyikan peringatan jika nilai valid
            warningMessageStatusPenanamanModal.style.display = 'none';
        }
    });
</script>
