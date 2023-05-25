<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SIGLOG | POLRESTA BENGKULU</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="hold-transition sidebar-mini">
    <div class="row">
        <div class="col-4">
            <p class="text-center">
                KEPOLISIAN NEGARA REPUBLIK INDONESIA <br>
                DAERAH BENGKULU <br>
                RESOR KOTA BENGKULU
            </p>
            <hr size="10" width="60%" color="black">
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <h2 class="page-header">
                <img src="/img/LogoPOLRI.png" alt="AdminLTE Logo" class="rounded mx-auto d-block" width="80px">
            </h2>
            <p class="text-center fs-6"><b>LAPORAN {{ $page_title }}</b></p>
            <hr size="10" width="20%" color="black">
            <p class="text-center fs-6">Nomor: BR / .. / L / VII / 2023 /Polresta Bengkulu</p>
        </div>
    </div><br><br><br>
    <div class="wrapper">
        <div class="content">
            <div class="container-fluid">
                @yield('content')
            </div>
        </div>
    </div>
    <br><br><br>
    @php
        $mytime = Carbon\Carbon::now();
        $mytime->toDateTimeString();
    @endphp

    <div class="row">
        <div class="col-6"></div>
        <div class="col-6">
            <p class="text-center">Kota Bengkulu , {{ $mytime->format('d M Y') }}</p>
            <hr size="10" width="30%" color="black">
            <p class="text-center">a.n.{{ $terima->user->jabatan }}</p>
            <p class="text-center">POLRESTA BENGKULU</p>
            <br><br><br><br>
            <p class="text-center">{{ $terima->user->nama }}</p>
            <hr size="10" width="30%" color="black">
            <p class="text-center">KOMPOL NRP.{{ $terima->user->nrp }}</p>
        </div>

    </div>
    <script>
        window.addEventListener("load", window.print());
    </script>
</body>

</html>
