<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('js/app.js') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>{{$judul}}</title>
    <link rel="icon" href="{{ url('logo/logo-bps.png') }}" type="image/x-icon">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>

    <style>
        .text-center {
            text-align: center;
        }
        #map {
            width: '30%';
            height: 200px;
        }
    </style>
    <link rel='stylesheet' href='https://unpkg.com/leaflet@1.8.0/dist/leaflet.css' crossorigin='' />
</head>
<body class="bg-lightgrey">

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @else
       <header class="bg-darkblue">
            @include('component.navbar.navbar-admin')
        </header>
        @yield('content')
        <div id="footer">
            @include('component.footer')
        </div>
    @endif


</body>
</html>
