<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SigLog | Forgot Password </title>

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<style>
    body {
        background: linear-gradient(rgba(0, 0, 0, 0.7),
                rgba(0, 0, 0, 0.7)),
            url(/img/bgpol.jpeg);
        background-repeat: no-repeat;
        background-size: cover;
    }
</style>

<body class="hold-transition login-page">

    <div class="login-box">

        <div class="card card-outline card-primary">
            <div class="mx-auto mt-2">
                <img src="/img/logistik.png" alt="" style="max-height: 80px; max-width: 80px">
            </div>

            <div class="card-header text-center">

                <a href="#" class="h1"><b>SIG</b>LOG</a>

            </div>
            <div class="card-body">
                <p class="login-box-msg">LUPA PASSWORD</p>
                <p class="login-box-msg">masukan email yang terdaftar</p>
                <form action="{{ route('forgot.password.link') }}" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Email" name="email" id="email"
                            autofocus required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <a href="{{ route('login') }}" class="text-primary float-right">Login
                                ?</a><br><br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 mx-auto">
                            <button type="submit" class="btn btn-primary btn-block">Verifikasi email</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>


        @vite('resources/js/app.js')
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        @if ($massege = Session::get('success'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil !',
                    text: 'Silahkan Cek Email Anda',
                })
            </script>
        @endif
        @if ($massege = Session::get('fail'))
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'gagal !',
                    text: 'Silahkan Masukan Email Yang Terdaftar',
                })
            </script>
        @endif
</body>

</html>
