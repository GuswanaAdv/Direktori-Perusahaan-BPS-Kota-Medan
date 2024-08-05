<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('js/app.js') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Login</title>

    <style>
    </style>
</head>
<body class="bg-darkblue">

    <section class="bg-darkblue min-h-screen">
        <div class="flex flex-col items-center justify-center px-6 sm:py-8 py-20 mx-auto md:h-screen lg:py-0">
            <a href="#" class="flex items-center mb-6 text-2xl font-bold text-white dark:text-white">
                <img class="w-16 mr-8 rounded-box" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSskAcjFxQzZFo7W70mjP4OwNoovJe62tZ5Yw&s"
                alt="logo">
                BPS KOTA MEDAN
            </a>
            <div class="w-full bg-white rounded-lg shadow
            dark:border md:mt-0 sm:max-w-md xl:p-0
            dark:bg-gray-800 dark:border-gray-700">

                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">

                    @if (session()->has('loginError'))
                        <div role="alert" class="alert alert-error">
                            <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-6 w-6 shrink-0 stroke-current"
                            fill="none"
                            viewBox="0 0 24 24">
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span>{{ session('loginError') }}</span>
                        </div>
                    @endif
                    <h1 class="text-xl font-bold leading-tight tracking-tight
                    text-gray-900 md:text-2xl dark:text-white text-center">
                        Masuk ke Direktori Perusahaan
                    </h1>
                    <form class="space-y-4 md:space-y-6" action="{{route('login')}}" method="POST">
                        @csrf
                        <div>
                            <label for="email"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Email
                            </label>
                            <input type="email" name="email" id="email"
                            class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg
                            focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5
                            dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white
                            dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="name@company.com" required="">
                        </div>
                        <div>
                            <label for="password" class="block mb-2 text-sm font-medium text-gray-900
                            dark:text-white">Password</label>
                            <input type="password" name="password" id="password" placeholder="••••••••"
                            class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg
                            focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5
                            dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400
                            dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            required="">
                        </div>
                        {{-- <div class="flex items-center">
                            <a href="#" class="text-sm font-medium text-primary-600
                            hover:underline dark:text-primary-500">Forgot password?</a>
                        </div> --}}
                        <button type="submit" class="w-full text-black bg-grey
                        hover:bg-darkblue hover:text-white font-medium rounded-lg
                        text-sm px-5 py-2.5 text-center ">Sign in</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>
</html>
