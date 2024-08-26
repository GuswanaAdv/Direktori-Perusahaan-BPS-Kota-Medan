@extends('layout.petugas')
@section('content')
    <div class="flex items-center justify-center py-8">
        <div class="card bg-white sm:w-5/6 md:w-3/4 shadow-xl w-full">

            <div class="card-body w-full text-2xl text-left sm:px-20 border-b-2 font-bold">
                Profil Anda
            </div>

            <div class="card-body w-full text-2xl text-left sm:px-20 border-b-2 font-bold flex justify-left">
                <label class="flex cursor-pointer gap-2">
                    <span class="label-text">Lihat Saja</span>
                    <input type="checkbox" value="synthwave" class="toggle theme-controller" id="editToggle"/>
                    <span class="label-text">Edit</span>
                </label>
            </div>

            @include('component.pesan')
            <div class="card-body w-full text-left sm:px-20 border-b-2">

                <form class="mx-auto w-full" action="{{ route('edit-profil-petugas') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="grid sm:grid-cols-2 grid-cols-1">
                        <div class="sm:mr-4 mr-0">
                            <label class="form-control w-full max-w-xs">
                                <div class="label">
                                    <span class="label-text">Nama Petugas</span>
                                </div>
                                <input readonly type="text" name="nama-petugas"
                                class="input input-bordered w-full max-w-xs"
                                value="{{ !empty(Auth::user()->petugas->nama_petugas)? Auth::user()->petugas->nama_petugas:'' }}"/>
                            </label>

                            <label class="form-control w-full max-w-xs">
                                <div class="label">
                                    <span class="label-text">ID Petugas</span>
                                </div>
                                <input readonly type="text" name="id-petugas"
                                class="input input-bordered w-full max-w-xs"
                                value="{{ !empty(Auth::user()->petugas->id_petugas)? Auth::user()->petugas->id_petugas:'' }}"/>
                            </label>

                            <label class="form-control w-full max-w-xs">
                                <div class="label">
                                    <span class="label-text">Email</span>
                                </div>
                                <input readonly type="email" name="email"
                                class="input input-bordered w-full max-w-xs"
                                value="{{ !empty(Auth::user()->email)? Auth::user()->email:'' }}"/>
                            </label>
                        </div>

                        <div class="sm:ml-4 ml-0">
                            <label class="form-control w-full max-w-xs">
                                <div class="label">
                                    <span class="label-text">Jenis Kelamin</span>
                                </div>
                                <input readonly type="text" name="jenis-kelamin"
                                class="input input-bordered w-full max-w-xs"
                                value="{{ !empty(Auth::user()->petugas->jenis_kelamin)? Auth::user()->petugas->jenis_kelamin:'' }}"/>
                            </label>

                            <label class="form-control w-full max-w-xs">
                                <div class="label">
                                    <span class="label-text">Usia</span>
                                </div>
                                <input readonly type="number" name="usia"
                                class="input input-bordered w-full max-w-xs"
                                value="{{ !empty(Auth::user()->petugas->usia)? Auth::user()->petugas->usia:'' }}"/>
                            </label>

                            <label class="form-control w-full max-w-xs">
                                <div class="label">
                                    <span class="label-text">No WA</span>
                                </div>
                                <input readonly type="text" name="no-wa"
                                class="input input-bordered w-full max-w-xs"
                                value="{{ !empty(Auth::user()->petugas->no_wa)? Auth::user()->petugas->no_wa:'' }}"/>
                            </label>

                            <div class="flex justify-end w-full max-w-xs">
                                <button class="btn bg-orange text-white hover:bg-yellowpastel hover:text-darkgrey mt-8 hidden"
                                id="edit-profil" type="submit">
                                    Edit
                                </button>
                            </div>
                        </div>
                    </div>
                </form>

            </div>

            {{-- @include('component.pesan') --}}
            <div class="card-body w-full flex items-center justify-center">

                <p class="text-xl font-bold">Ubah Password</p>
                <div class="md:w-1/3 w-full max-w-xs">
                    <form class="mx-auto" action="{{ route('ganti-password-petugas') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <label class="form-control w-full max-w-xs">
                            <div class="label">
                                <span class="label-text">Password Lama</span>
                            </div>
                            <input type="password" name="password-lama" id="password-lama"
                            class="input input-bordered w-full max-w-xs"/>
                        </label>

                        <label class="form-control w-full max-w-xs">
                            <div class="label">
                                <span class="label-text">Password Baru</span>
                            </div>
                            <input type="password" name="password-baru" id="password-baru"
                            class="input input-bordered w-full max-w-xs"/>
                        </label>

                        <label class="form-control w-full max-w-xs">
                            <div class="label">
                                <span class="label-text">Konfirmasi Password Baru</span>
                            </div>
                            <input type="password" name="konfirmasi-password-baru" id="konfirmasi-password-baru"
                            class="input input-bordered w-full max-w-xs" id="konfirmasi-password-baru"/>
                        </label>

                        <div class="form-control w-full flex items-center justify-center">
                            <div class="w-40">
                                <label class="label cursor-pointer">
                                    <span class="label-text">Lihat Password</span>
                                    <input type="checkbox" class="toggle toggle-primary" id="toggle-password"/>
                                </label>
                            </div>
                        </div>

                        <div class="flex justify-center w-full max-w-lg">
                            <button class="btn bg-orange text-white hover:bg-yellowpastel hover:text-darkgrey mt-8"
                            type="submit">
                                Ubah Password
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <script>
        document.getElementById('editToggle').addEventListener('change', function () {
            const isEditMode = this.checked;
            const inputs = document.querySelectorAll('input[name="nama-petugas"], input[name="email"], input[name="jenis-kelamin"], input[name="usia"], input[name="no-wa"]');
            const submitButton = document.getElementById('edit-profil');

            inputs.forEach(input => {
                input.readOnly = !isEditMode; // Jika tidak dalam mode edit, set readonly
            });

            if (isEditMode) {
                submitButton.classList.remove('hidden'); // Tampilkan tombol submit saat mode edit
            } else {
                submitButton.classList.add('hidden'); // Sembunyikan tombol submit saat mode readonly
            }
        });

        document.getElementById('toggle-password').addEventListener('change', function () {
            const lama = document.getElementById('password-lama');
            const baru = document.getElementById('password-baru');
            const konfirmasi = document.getElementById('konfirmasi-password-baru');

            if (this.checked) {
                lama.type = 'text'; // Tampilkan password
                baru.type = 'text'; // Tampilkan password
                konfirmasi.type = 'text'; // Tampilkan password
            } else {
                lama.type = 'password'; // Sembunyikan password
                baru.type = 'password'; // Sembunyikan password
                konfirmasi.type = 'password'; // Sembunyikan password
            }
        });
    </script>
@endsection
