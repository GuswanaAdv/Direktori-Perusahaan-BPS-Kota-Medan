@extends('layout.admin')
@section('content')
    <div class="flex items-center justify-center py-8">
        <div class="card bg-white sm:w-5/6 md:w-3/4 shadow-xl w-full">

            <div class="card-body w-full text-2xl text-left sm:px-20 border-b-2 font-bold">
                Profil Admin Direktori
            </div>

            @include('component.pesan')
            <div class="grid sm:grid-cols-2 grid-cols-1">
                <div class="card-body w-full text-left sm:px-20 border-b-2">
                    <label class="flex cursor-pointer gap-2 mb-2">
                        <span class="label-text font-bold">Lihat Saja</span>
                        <input type="checkbox" value="synthwave" class="toggle theme-controller" id="editToggle"/>
                        <span class="label-text font-bold">Edit</span>
                    </label>

                    <form class="mx-auto w-full" action="{{ route('edit-profil-admin') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <label class="form-control w-full max-w-xs">
                            <div class="label">
                                <span class="label-text">Email</span>
                            </div>
                            <input readonly type="text" name="email"
                            class="input input-bordered w-full max-w-xs"
                            value="{{ !empty(Auth::user()->email)? Auth::user()->email:'' }}"/>
                        </label>

                        <label class="form-control w-full max-w-xs">
                            <div class="label">
                                <span class="label-text">Peran</span>
                            </div>
                            <input readonly type="text" name="peran"
                            class="input input-bordered w-full max-w-xs"
                            value="{{ !empty(Auth::user()->peran->nama_peran)? Auth::user()->peran->nama_peran:'' }}"/>
                        </label>

                        <div class="flex justify-end w-full max-w-xs">
                            <button class="btn bg-orange text-white hover:bg-yellowpastel hover:text-darkgrey mt-8 hidden"
                            id="edit-profil" type="submit">
                                Edit
                            </button>
                        </div>
                    </form>

                </div>

                {{-- @include('component.pesan') --}}
                <div class="card-body w-full">

                    <p class="text-xl font-bold">Ubah Password</p>
                    <div>
                        <form class="mx-auto w-full" action="{{ route('ganti-password-admin') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <label class="form-control w-full max-w-lg">
                                <div class="label">
                                    <span class="label-text">Password Lama</span>
                                </div>
                                <input type="password" name="password-lama"
                                class="input input-bordered w-full max-w-lg"/>
                            </label>

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
    </div>

    <script>
        document.getElementById('editToggle').addEventListener('change', function () {
            const isEditMode = this.checked;
            const inputs = document.querySelectorAll('input[name="email"]');
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
