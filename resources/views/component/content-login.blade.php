<section class="bg-gradient-to-b from-darkorange to-orange min-h-screen">
    <div class="flex flex-col items-center justify-center px-6 sm:py-8 py-20 mx-auto md:h-screen lg:py-0">
        <a href="#" class="flex items-center mb-6 text-2xl font-bold text-white dark:text-white">
            <img class="w-16 mr-8 rounded-box" src="{{ url('logo/logo-bps.png') }}"
            alt="logo">
            DIREKTORI PERUSAHAAN KOTA MEDAN
        </a>
        <div class="w-full bg-white rounded-lg shadow
        dark:border md:mt-0 sm:max-w-md xl:p-0
        dark:bg-gray-800 dark:border-gray-700">

            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">

                @include('component.pesan')

                <h1 class="text-xl font-bold leading-tight tracking-tight
                text-gray-900 md:text-2xl dark:text-white text-center">
                    Login
                </h1>
                <form class="space-y-4 md:space-y-6" action="{{route('login')}}" method="POST">
                    @csrf
                    <div>
                        <label for="email"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Email
                        </label>
                        <input type="email" name="email" id="email"
                        class="bg-gray-50 border border-darkgrey text-gray-900 rounded-lg
                        focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5
                        dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white
                        dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="name@company.com" required="">
                    </div>
                    <div>
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900
                        dark:text-white">Password</label>
                        <input type="password" name="password" id="password" placeholder="••••••••"
                        class="bg-gray-50 border border-darkgrey text-gray-900 rounded-lg
                        focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5
                        dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400
                        dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        required>
                    </div>
                    <div class="form-control w-full flex items-center justify-center">
                        <div class="w-40">
                            <label class="label cursor-pointer">
                                <span class="label-text">Lihat Password</span>
                                <input type="checkbox" class="toggle toggle-primary" id="toggle-password"/>
                            </label>
                        </div>
                    </div>
                    {{-- <div class="flex items-center">
                        <a href="#" class="text-sm font-medium text-primary-600
                        hover:underline dark:text-primary-500">Forgot password?</a>
                    </div> --}}
                    <button type="submit" class="w-full text-black bg-grey
                    hover:bg-orange hover:text-white font-medium rounded-lg
                    text-sm px-5 py-2.5 text-center ">login</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('toggle-password').addEventListener('change', function () {
            const password = document.getElementById('password');
            if (this.checked) {
                password.type = 'text'; // Tampilkan password
            } else {
                password.type = 'password'; // Sembunyikan password
            }
        });
    </script>
</section>
