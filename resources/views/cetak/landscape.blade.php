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
<style>
    body {
        font-size: 10px;
    }

    @media print {
        @page {
            size: landscape
        }
    }

    td {
        font-size: 10px;
    }

    th {
        font-size: 10px;
    }
</style>

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
    <div class="text-center">DATA RANMOR POLRESTA BENGKULU</div>
    <div class="wrapper">
        <div class="content">
            <div class="container-fluid">
                @yield('content')
            </div>
        </div>
    </div>
    <br><br><br>
    @php
        $mytime = Carbon\Carbon::now()->locale('id');
        $mytime->toDateTimeString();
    @endphp

    <div class="row">
        <div class="col">
            <div class="row">
                <div class="col-6">
                    <p class="text-center">MENGETAHUI</p>
                    <p class="text-center">{{ Auth::user()->jabatan }}</p>
                    <p class="text-center">POLRESTA BENGKULU</p>
                    <br><br><br><br>
                    <p class="text-center"><u>{{ Auth::user()->nama }}</u></p>
                    <p class="text-center">{{ Auth::user()->pangkat }} NRP.{{ Auth::user()->nrp }}</p>
                </div>
            </div>
        </div>
        <div class="col">
            <p class="text-center">Kota Bengkulu , {{ $mytime->translatedFormat('d M Y') }}</p>
            <p class="text-center">Penganggug Jawab</p>
            <div class="row">
                <div class="col">
                    <p class="text-center">{{ $pj1->jabatan }}</p>
                    <br><br><br><br>
                    <p class="text-center"><u>{{ $pj1->nama }}</u></p>
                    <p class="text-center">{{ $pj1->pangkat }} statik NRP.{{ $pj1->nrp }} </p>
                </div>
                <div class="col">
                    <p class="text-center">{{ $pj2->jabatan }}</p>
                    <br><br><br><br>
                    <p class="text-center"><u>{{ $pj2->nama }}</u> </p>
                    <p class="text-center"> {{ $pj2->pangkat }} NRP.{{ $pj2->nrp }}
                    </p>
                </div>
            </div>


        </div>
    </div>
    <script>
        window.addEventListener("load", window.print());
    </script>
</body>

</html>
