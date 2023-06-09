<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SiLog | Log in </title>

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

                <a href="#" class="h1"><b>SI</b>LOG</a>

            </div>
            <div class="card-body">
                <p class="login-box-msg">Sistem informasi Logistik</p>
                <form action="{{ route('authenticate') }}" method="post">
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
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Password" name="password"
                            id="password" required>
                        <div class="input-group-append">
                            <span class="input-group-text" onclick="password_show_hide();">
                                <i class="fas fa-eye" id="show_eye"></i>
                                <i class="fas fa-eye-slash d-none" id="hide_eye"></i>
                            </span>
                        </div>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <a href="{{ route('forgotpw') }}" class="text-primary float-right">Lupa Password
                                ?</a><br><br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 mx-auto">
                            <button type="submit" class="btn btn-primary btn-block">Masuk</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>


        @vite('resources/js/app.js')
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        @if ($massege = Session::get('info'))
            <script>
                Swal.fire({
                    icon: 'info',
                    title: 'Password berhasil di ubah',
                    text: 'Silakan Login Kembali',
                })
            </script>
        @endif
        @if ($massege = Session::get('failed'))
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Login Gagal !',
                    text: 'Email / Password Salah !',
                })
            </script>
        @endif
        @if ($massege = Session::get('success'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Anda telah Logout',
                })
            </script>
        @endif
        <script>
            function password_show_hide() {
                var x = document.getElementById("password");
                var show_eye = document.getElementById("show_eye");
                var hide_eye = document.getElementById("hide_eye");
                hide_eye.classList.remove("d-none");
                if (x.type === "password") {
                    x.type = "text";
                    show_eye.style.display = "none";
                    hide_eye.style.display = "block";
                } else {
                    x.type = "password";
                    show_eye.style.display = "block";
                    hide_eye.style.display = "none";
                }
            }
        </script>
</body>

</html>
