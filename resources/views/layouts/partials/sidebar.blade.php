 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-light-orange elevation-4">
     <!-- Brand Logo -->
     <a href="{{ route('dashboard.index') }}" class="brand-link bg-dark">
         <img src="/img/logistik.png" alt="Logistik Logo" class="brand-image">
         <span class="brand-text font-weight-light">&ensp;SILOG</span>
     </a>

     <!-- Sidebar -->
     <div class="sidebar">
         <!-- Sidebar user panel (optional) -->
         <div class="user-panel mt-3 pb-3 mb-3 d-flex">
             <div class="image">
                 <img src="/img/LogoPOLRI.png" class="img-circle elevation-2" alt="User Image">
             </div>
             <div class="info">
                 <a href="{{ route('dashboard.index') }}" class="d-block"> {{ Auth::user()->nama }}</a>
             </div>
         </div>

         <!-- Sidebar Menu -->
         <nav class="mt-2">
             <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                 data-accordion="false">
                 <!-- Add icons to the links using the .nav-icon class
              with font-awesome or any other icon font library -->
                 <li class="nav-item">
                     <a href="{{ route('dashboard.index') }}"
                         class="nav-link {{ Request::is('administrator/dashboard') ? 'active' : '' }}">
                         <i class="nav-icon fas fa-th"></i>
                         <p>
                             Dashboard
                         </p>
                     </a>
                 </li>
                 <li class="nav-item {{ Request::is('administrator/data*') ? 'menu-is-opening menu-open' : '' }}">
                     <a href="#" class="nav-link {{ Request::is('administrator/data*') ? 'active' : '' }}">
                         <i class="nav-icon fas fa-database"></i>
                         <p>
                             Manajemen Data
                             <i class="right fas fa-angle-left"></i>
                         </p>
                     </a>
                     <ul class="nav nav-treeview">
                         <li class="nav-item">
                             <a href="{{ route('lokasi.index') }}"
                                 class="nav-link {{ Request::is('administrator/data/lokasi*') ? 'active' : '' }}">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>
                                     Gudang
                                 </p>
                             </a>
                         </li>
                         @can('admin')
                             <li class="nav-item">
                                 <a href="{{ route('barang.jenis') }}"
                                     class="nav-link {{ Request::is('administrator/data/jenis') ? 'active' : '' }}">
                                     <i class="far fa-circle nav-icon"></i>
                                     <p>jenis Barang</p>
                                 </a>
                             </li>
                         @endcan
                         <li class="nav-item">
                             <a href="{{ route('barang.barang') }}"
                                 class="nav-link {{ Request::is('administrator/data/barang*') ? 'active' : '' }}">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Barang</p>
                             </a>
                         </li>
                         @can('admin')
                             <li class="nav-item">
                                 <a href="{{ route('ranmor.jenis') }}"
                                     class="nav-link  {{ Request::is('administrator/data/ranmor/jenis*') ? 'active' : '' }}">
                                     <i class="far fa-circle nav-icon"></i>
                                     <p>jenis Ranmor</p>
                                 </a>
                             </li>
                         @endcan
                     </ul>
                 </li>
                 <li
                     class="nav-item {{ Request::is('administrator/pengelolaan*') ? 'menu-is-opening menu-open' : '' }}">
                     <a href="#"
                         class="nav-link {{ Request::is('administrator/pengelolaan*') ? 'active' : '' }}">
                         <i class="nav-icon fas fa-database"></i>
                         <p>
                             Pengelolaan Data
                             <i class="right fas fa-angle-left"></i>
                         </p>
                     </a>
                     <ul class="nav nav-treeview">
                         @can('personel')
                             <li class="nav-item">
                                 <a href="{{ route('barang.terima') }}"
                                     class="nav-link {{ Request::is('administrator/pengelolaan/terima*') ? 'active' : '' }}">
                                     <i class="far fa-circle nav-icon"></i>
                                     <p>Barang Diterima</p>
                                 </a>
                             </li>
                         @endcan
                         @can('admin')
                             <li class="nav-item">
                                 <a href="{{ route('barang.masuk') }}"
                                     class="nav-link {{ Request::is('administrator/pengelolaan/masuk*') ? 'active' : '' }}">
                                     <i class="far fa-circle nav-icon"></i>
                                     <p>Barang Diterima</p>
                                 </a>
                             </li>
                             <li class="nav-item">
                                 <a href="{{ route('barang.keluar') }}"
                                     class="nav-link {{ Request::is('administrator/pengelolaan/keluar*') ? 'active' : '' }}">
                                     <i class="far fa-circle nav-icon"></i>
                                     <p>Penyerahaan Barang</p>
                                 </a>
                             </li>
                         @endcan
                         <li class="nav-item">
                             <a href="{{ route('ranmor.index') }}"
                                 class="nav-link {{ Request::is('administrator/pengelolaan/ranmor/data*') ? 'active' : '' }}">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Ranmor</p>
                             </a>
                         </li>
                     </ul>
                 </li>
                 @can('admin')
                     <li class="nav-item">
                         <a href="{{ route('user.index') }}"
                             class="nav-link {{ Request::is('administrator/user*') ? 'active' : '' }}">
                             <i class="nav-icon fas fa-user"></i>
                             <p>
                                 Data User
                             </p>
                         </a>
                     </li>
                 @endcan
                 <li class="nav-item">
                     <a href="{{ route('user.profil') }}"
                         class="nav-link {{ Request::is('administrator/profil*') ? 'active' : '' }}">
                         <i class="nav-icon fas fa-user"></i>
                         <p>
                             Profil
                         </p>
                     </a>
                 </li>

             </ul>
         </nav>
         <!-- /.sidebar-menu -->
     </div>
     <!-- /.sidebar -->
 </aside>
