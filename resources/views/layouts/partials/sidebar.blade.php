 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-light-orange elevation-4">
     <!-- Brand Logo -->
     <a href="{{ route('dashboard.index') }}" class="brand-link bg-dark">
         <img src="/img/logistik.png" alt="Logistik Logo" class="brand-image">
         <span class="brand-text font-weight-light">&ensp;SIGLOG</span>
     </a>

     <!-- Sidebar -->
     <div class="sidebar">
         <!-- Sidebar user panel (optional) -->
         <div class="user-panel mt-3 pb-3 mb-3 d-flex">
             <div class="image">
                 <img src="/img/LogoPOLRI.png" class="img-circle elevation-2" alt="User Image">
             </div>
             <div class="info">
                 <a href="{{ route('dashboard.index') }}" class="d-block"> {{ Auth::user()->username }}</a>
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
                             Data Barang
                             <i class="right fas fa-angle-left"></i>
                         </p>
                     </a>
                     <ul class="nav nav-treeview">
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
                         @can('personel')
                             <li class="nav-item">
                                 <a href="{{ route('barang.terima') }}"
                                     class="nav-link {{ Request::is('administrator/data/terima*') ? 'active' : '' }}">
                                     <i class="far fa-circle nav-icon"></i>
                                     <p>Barang Diterima</p>
                                 </a>
                             </li>
                         @endcan
                         @can('admin')
                             <li class="nav-item">
                                 <a href="{{ route('barang.masuk') }}"
                                     class="nav-link {{ Request::is('administrator/data/masuk*') ? 'active' : '' }}">
                                     <i class="far fa-circle nav-icon"></i>
                                     <p>Barang Masuk</p>
                                 </a>
                             </li>
                             <li class="nav-item">
                                 <a href="{{ route('barang.keluar') }}"
                                     class="nav-link {{ Request::is('administrator/data/keluar*') ? 'active' : '' }}">
                                     <i class="far fa-circle nav-icon"></i>
                                     <p>Barang keluar</p>
                                 </a>
                             </li>
                         @endcan

                     </ul>
                 </li>
                 <li class="nav-item {{ Request::is('administrator/ranmor*') ? 'menu-is-opening menu-open' : '' }}">
                     <a href="#" class="nav-link {{ Request::is('administrator/ranmor*') ? 'active' : '' }}">
                         <i class="nav-icon fas fa-database"></i>
                         <p>
                             Data RANMOR
                             <i class="right fas fa-angle-left"></i>
                         </p>
                     </a>
                     <ul class="nav nav-treeview">
                         @can('admin')
                             <li class="nav-item">
                                 <a href="{{ route('ranmor.jenis') }}"
                                     class="nav-link  {{ Request::is('administrator/ranmor/jenis*') ? 'active' : '' }}">
                                     <i class="far fa-circle nav-icon"></i>
                                     <p>jenis Ranmor</p>
                                 </a>
                             </li>
                         @endcan
                         <li class="nav-item">
                             <a href="#" class="nav-link ">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>RANMOR</p>
                             </a>
                         </li>
                     </ul>
                 </li>
                 <li class="nav-item">
                     <a href="{{ route('gudang.index') }}"
                         class="nav-link {{ Request::is('administrator/gudang*') ? 'active' : '' }}">
                         <i class="nav-icon fas fa-warehouse"></i>
                         <p>
                             Gudang
                         </p>
                     </a>
                 </li>
                 <li class="nav-item">
                     <a href="{{ route('lokasi.index') }}"
                         class="nav-link {{ Request::is('administrator/lokasi*') ? 'active' : '' }}">
                         <i class="nav-icon fas fa-map"></i>
                         <p>
                             Lokasi
                         </p>
                     </a>
                 </li>
                 @can('admin')
                     <li class="nav-item">
                         <a href="{{ route('user.index') }}"
                             class="nav-link {{ Request::is('administrator/user*') ? 'active' : '' }}">
                             <i class="nav-icon far fa-user"></i>
                             <p>
                                 Data User
                             </p>
                         </a>
                     </li>
                 @endcan

             </ul>
         </nav>
         <!-- /.sidebar-menu -->
     </div>
     <!-- /.sidebar -->
 </aside>
