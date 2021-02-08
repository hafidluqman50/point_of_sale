<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Point Of Sale | {{ $title }}</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('assets/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{asset('assets/plugins/jqvmap/jqvmap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
  
  <link rel="stylesheet" href="{{asset('assets/plugins/select2/css/select2.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets/dist/css/adminlte.min.css')}}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{asset('assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">
  <link rel="stylesheet" href="{{asset('assets/dist/css/custom.css')}}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
      {{-- <li class="nav-item">
        <a class="nav-link" href="{{ url('/admin/kasir') }}">Kasir</a>
      </li> --}}
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fa fa-user mr-2"></i> {{ Auth::user()->name }}
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">Profile</span>
          <div class="dropdown-divider"></div>
          <a href="{{ url('/settings-profile') }}" class="dropdown-item">
            Ubah Profile
          </a>
          <div class="dropdown-divider"></div>
          <a href="{{ url('/logout') }}" class="dropdown-item">
            Logout
          </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="{{asset('assets/dist/img/AdminLTELogo.png')}}" alt="POS Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Point Of Sale</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('assets/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{Auth::user()->name}}</a>
        </div>
      </div>

      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="{{ url('/admin/dashboard') }}" class="nav-link {{ $page == 'dashboard' ? 'active' : '' }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('/admin/item-jual') }}" class="nav-link {{ $page == 'item-jual' ? 'active' : '' }}">
              <i class="nav-icon fas fa-clipboard"></i>
              <p>
                Item Jual
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview @if (isset($treeview)){{ $treeview == 'inventory' ? 'menu-open' : '' }}@endif">
            <a href="#" class="nav-link @if (isset($treeview)){{ $treeview == 'inventory' ? 'active' : '' }}@endif">
              <i class="nav-icon fas fa-warehouse"></i>
              <p>Inventory Barang
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ url('/admin/data-jenis-barang') }}" class="nav-link {{ $page == 'jenis-barang' ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Jenis Barang</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('/admin/data-barang') }}" class="nav-link {{ $page == 'barang' ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Barang</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('/admin/data-supplier') }}" class="nav-link {{ $page == 'supplier' ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Supplier</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('/admin/data-barang-masuk') }}" class="nav-link {{ $page == 'barang-masuk' ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Barang Masuk</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('/admin/data-barang-keluar') }}" class="nav-link {{ $page == 'barang-keluar' ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Barang Keluar</p>
                </a>
              </li>
              {{-- <li class="nav-item">
                <a href="{{ url('/admin/data-belanja') }}" class="nav-link {{ $page == 'barang' ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Belanja</p>
                </a>
              </li> --}}
            </ul>
          </li>
          <li class="nav-item">
            <a href="{{ url('/admin/transaksi') }}" class="nav-link {{ $page == 'transaksi' ? 'active' : '' }}">
              <i class="nav-icon fas fa-money-check"></i>
              <p>
                Transaksi
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('/admin/tagihan') }}" class="nav-link {{ $page == 'tagihan' ? 'active' : '' }}">
              <i class="nav-icon fas fa-money-bill-wave"></i>
              <p>
                Tagihan
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('/admin/users') }}" class="nav-link {{ $page == 'users' ? 'active' : '' }}">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Users
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('/admin/kasir') }}" class="nav-link">
              <i class="nav-icon fas fa-money-bill-wave"></i>
              <p>
                Kasir
              </p>
            </a>
          </li>
        </ul>
      </nav>
    </div>
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">