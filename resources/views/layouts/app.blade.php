<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SIGLOG | POLRESTA BENGKULU</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    @yield('css')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        @include('layouts.partials.navbar')

        @include('layouts.partials.sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">{{ $page_title }}</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Starter Page</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    @yield('content')
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        @include('layouts.partials.footer')
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->
    @vite('resources/js/app.js')
    <script>
        $(function() {
          var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
          });
      
          $('.swalDefaultSuccess').click(function() {
            Toast.fire({
              icon: 'success',
              title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
            })
          });
          $('.swalDefaultInfo').click(function() {
            Toast.fire({
              icon: 'info',
              title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
            })
          });
          $('.swalDefaultError').click(function() {
            Toast.fire({
              icon: 'error',
              title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
            })
          });
          $('.swalDefaultWarning').click(function() {
            Toast.fire({
              icon: 'warning',
              title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
            })
          });
          $('.swalDefaultQuestion').click(function() {
            Toast.fire({
              icon: 'question',
              title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
            })
          });
      
          $('.toastrDefaultSuccess').click(function() {
            toastr.success('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
          });
          $('.toastrDefaultInfo').click(function() {
            toastr.info('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
          });
          $('.toastrDefaultError').click(function() {
            toastr.error('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
          });
          $('.toastrDefaultWarning').click(function() {
            toastr.warning('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
          });
      
          $('.toastsDefaultDefault').click(function() {
            $(document).Toasts('create', {
              title: 'Toast Title',
              body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
            })
          });
          $('.toastsDefaultTopLeft').click(function() {
            $(document).Toasts('create', {
              title: 'Toast Title',
              position: 'topLeft',
              body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
            })
          });
          $('.toastsDefaultBottomRight').click(function() {
            $(document).Toasts('create', {
              title: 'Toast Title',
              position: 'bottomRight',
              body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
            })
          });
          $('.toastsDefaultBottomLeft').click(function() {
            $(document).Toasts('create', {
              title: 'Toast Title',
              position: 'bottomLeft',
              body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
            })
          });
          $('.toastsDefaultAutohide').click(function() {
            $(document).Toasts('create', {
              title: 'Toast Title',
              autohide: true,
              delay: 750,
              body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
            })
          });
          $('.toastsDefaultNotFixed').click(function() {
            $(document).Toasts('create', {
              title: 'Toast Title',
              fixed: false,
              body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
            })
          });
          $('.toastsDefaultFull').click(function() {
            $(document).Toasts('create', {
              body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.',
              title: 'Toast Title',
              subtitle: 'Subtitle',
              icon: 'fas fa-envelope fa-lg',
            })
          });
          $('.toastsDefaultFullImage').click(function() {
            $(document).Toasts('create', {
              body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.',
              title: 'Toast Title',
              subtitle: 'Subtitle',
              image: '../../dist/img/user3-128x128.jpg',
              imageAlt: 'User Picture',
            })
          });
          $('.toastsDefaultSuccess').click(function() {
            $(document).Toasts('create', {
              class: 'bg-success',
              title: 'Toast Title',
              subtitle: 'Subtitle',
              body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
            })
          });
          $('.toastsDefaultInfo').click(function() {
            $(document).Toasts('create', {
              class: 'bg-info',
              title: 'Toast Title',
              subtitle: 'Subtitle',
              body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
            })
          });
          $('.toastsDefaultWarning').click(function() {
            $(document).Toasts('create', {
              class: 'bg-warning',
              title: 'Toast Title',
              subtitle: 'Subtitle',
              body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
            })
          });
          $('.toastsDefaultDanger').click(function() {
            $(document).Toasts('create', {
              class: 'bg-danger',
              title: 'Toast Title',
              subtitle: 'Subtitle',
              body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
            })
          });
          $('.toastsDefaultMaroon').click(function() {
            $(document).Toasts('create', {
              class: 'bg-maroon',
              title: 'Toast Title',
              subtitle: 'Subtitle',
              body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
            })
          });
        });
      </script>
</body>

</html>