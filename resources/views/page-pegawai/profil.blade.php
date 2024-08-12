@extends('layout.pegawai')
@section('content')
    <div class="flex items-center justify-center py-8">
        <div class="card bg-white sm:w-3/4 shadow-xl w-full">

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

                <form class="mx-auto w-full" action="{{ route('edit-profil') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="grid sm:grid-cols-2 grid-cols-1">
                        <div>
                            <label class="form-control w-full max-w-xs">
                                <div class="label">
                                    <span class="label-text">Nama Pegawai</span>
                                </div>
                                <input readonly type="text" name="nama-pegawai"
                                class="input input-bordered w-full max-w-xs"
                                value="{{ !empty(Auth::user()->pegawai->nama_pegawai)? Auth::user()->pegawai->nama_pegawai:'' }}"/>
                            </label>

                            <label class="form-control w-full max-w-xs">
                                <div class="label">
                                    <span class="label-text">NIP</span>
                                </div>
                                <input readonly type="text" name="nip"
                                class="input input-bordered w-full max-w-xs"
                                value="{{ !empty(Auth::user()->pegawai->nip)? Auth::user()->pegawai->nip:'' }}"/>
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

                        <div>
                            <label class="form-control w-full max-w-xs">
                                <div class="label">
                                    <span class="label-text">Jenis Kelamin</span>
                                </div>
                                <input readonly type="text" name="jenis-kelamin"
                                class="input input-bordered w-full max-w-xs"
                                value="{{ !empty(Auth::user()->pegawai->jenis_kelamin)? Auth::user()->pegawai->jenis_kelamin:'' }}"/>
                            </label>

                            <label class="form-control w-full max-w-xs">
                                <div class="label">
                                    <span class="label-text">Usia</span>
                                </div>
                                <input readonly type="number" name="usia"
                                class="input input-bordered w-full max-w-xs"
                                value="{{ !empty(Auth::user()->pegawai->usia)? Auth::user()->pegawai->usia:'' }}"/>
                            </label>

                            <label class="form-control w-full max-w-xs">
                                <div class="label">
                                    <span class="label-text">No WA</span>
                                </div>
                                <input readonly type="text" name="no-wa"
                                class="input input-bordered w-full max-w-xs"
                                value="{{ !empty(Auth::user()->pegawai->no_wa)? Auth::user()->pegawai->no_wa:'' }}"/>
                            </label>

                            <div class="flex justify-end w-full max-w-xs">
                                <button class="btn bg-grey hover:bg-darkblue hover:text-white mt-8 hidden"
                                id="edit-profil" type="submit">
                                    Edit
                                </button>
                            </div>
                        </div>
                    </div>
                </form>

            </div>

            {{-- @include('component.pesan') --}}
            <div class="card-body w-full sm:px-20 flex items-center justify-center">

                <p class="text-xl font-bold">Ubah Password</p>
                <div>
                    <form class="mx-auto w-full" action="{{ route('ganti-password') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <label class="form-control w-full max-w-lg">
                            <div class="label">
                                <span class="label-text">Password Baru</span>
                            </div>
                            <input type="password" name="password-baru"
                            class="input input-bordered w-full max-w-lg"/>
                        </label>

                        <label class="form-control w-full max-w-lg">
                            <div class="label">
                                <span class="label-text">Konfirmasi Password Baru</span>
                            </div>
                            <input type="password" name="konfirmasi-password-baru"
                            class="input input-bordered w-full max-w-lg"/>
                        </label>

                        <div class="flex justify-center w-full max-w-lg">
                            <button class="btn bg-grey hover:bg-darkblue hover:text-white mt-8"
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
            const inputs = document.querySelectorAll('input[name="nama-pegawai"], input[name="email"], input[name="jenis-kelamin"], input[name="usia"], input[name="no-wa"]');
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
    </script>
@endsection
