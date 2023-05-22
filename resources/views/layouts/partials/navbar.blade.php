<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown">
                <i class="far fa-user"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right bg-red">
                <a href="{{ route('logout') }}" class="dropdown-item dropdown-footer bg-red">
                    <i class="fas fa-sign-out-alt"></i>
                    &nbsp; &nbsp;Logout
                </a>
            </div>
        </li>
    </ul>
</nav>
<!-- /.navbar -->
