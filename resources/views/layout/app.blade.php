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
    <link rel="icon" href="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSskAcjFxQzZFo7W70mjP4OwNoovJe62tZ5Yw&s" type="image/x-icon">

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
<body class="bg-blue">
    <header class="bg-darkblue">
        @include('component.navbar')
    </header>
    @yield('content')
    <div id="footer">
        @include('component.footer')
    </div>
</body>
</html>