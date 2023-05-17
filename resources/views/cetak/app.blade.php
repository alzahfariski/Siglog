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
    <div class="row">
        <div class="col-6"></div>
        <div class="col-6">
            <p class="text-center">Dikeluarkan di: Kota Bengkulu</p>
            <hr size="10" width="30%" color="black">
            <p class="text-center">a.n.KEPALA BAGIAN LOGISTIK</p>
            <p class="text-center">POLRESTA BENGKULU</p><br><br><br><br>
            <p class="text-center">BUDI HARTONO S.H</p>
            <hr size="10" width="30%" color="black">
            <p class="text-center">KOMPOL NRP.12345</p>
        </div>

    </div>
    <!-- REQUIRED SCRIPTS -->
    @vite('resources/js/app.js')
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
    </script>
    <script src='https://api.mapbox.com/mapbox-gl-js/v2.14.1/mapbox-gl.js'></script>
    <script>
        window.addEventListener("load", window.print());
    </script>
    @stack('script')
</body>

</html>
