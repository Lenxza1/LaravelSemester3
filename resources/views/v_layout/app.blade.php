<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title> {{$title}} | Project Akhir</title>
  <link rel="shortcut icon" type="image/png" href="{{ asset('template/assets/images/logos/favicon.png') }}" />
  <link rel="stylesheet" href="{{ asset('template/assets/css/styles.min.css') }}" />
  <link href=" https://cdn.jsdelivr.net/npm/sweetalert2@11.15.0/dist/sweetalert2.min.css " rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
    <aside class="left-sidebar">
      <!-- Sidebar scroll-->
      <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
          <a href="{{route('dashboard')}}" class="text-nowrap logo-img">
            <img src="{{ asset('template/assets/images/logos/dark-logo.svg') }}" width="180" alt="" />
          </a>
          <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
            <i class="ti ti-x fs-8"></i>
          </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
            <ul id="sidebarnav">
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Home</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{route('dashboard')}}" aria-expanded="false">
                        <span>
                            <i class="ti ti-layout-dashboard"></i>
                        </span>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>
                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'staff')
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{route('produk.index')}}" aria-expanded="false">
                        <span>
                            <i class="ti ti-building-warehouse"></i>
                        </span>
                        <span class="hide-menu">Produk</span>
                    </a>
                </li>
                @endif
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{route('order.index')}}" aria-expanded="false">
                        <span>
                            <i class="ti ti-shopping-cart"></i>
                        </span>
                        <span class="hide-menu">Order</span>
                    </a>
                </li>
                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'staff')
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{route('transaksi.index')}}" aria-expanded="false">
                        <span>
                            <i class="ti ti-receipt"></i>
                        </span>
                        <span class="hide-menu">Transaksi</span>
                    </a>
                </li>
                @endif
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
      </div>
      <!-- End Sidebar scroll-->
    </aside>
    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper">
      <!--  Header Start -->
      <header class="app-header">
        <nav class="navbar navbar-expand-lg navbar-light">
          <ul class="navbar-nav">
            <li class="nav-item d-block d-xl-none">
              <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                <i class="ti ti-menu-2"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link nav-icon-hover" href="javascript:void(0)">
                <i class="ti ti-bell-ringing"></i>
                <div class="notification bg-primary rounded-circle"></div>
              </a>
            </li>
          </ul>
          <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
              <li class="nav-item dropdown">
                <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown"
                  aria-expanded="false">
                  <img src="{{ asset('template/assets/images/profile/user-1.jpg') }}" alt="" width="35" height="35" class="rounded-circle">
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                  <div class="message-body">
                    <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-user fs-6"></i>
                      <p class="mb-0 fs-3">Profile</p>
                    </a>
                    <form action="{{route('backend.logout')}}" method="post">
                      @csrf
                      <button type="submit" class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</button>
                    </form>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!--  Header End -->
      <div class="container-fluid">
        <!--  Row 1 -->
        @yield('content')
      </div>
    </div>
  </div>
  <script src="{{ asset('template/assets/libs/jquery/dist/jquery.min.js') }}"></script>
  <script src="{{ asset('template/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('template/assets/js/sidebarmenu.js') }}"></script>
  <script src="{{ asset('template/assets/js/app.min.js') }}"></script>
  <script src="{{ asset('template/assets/libs/apexcharts/dist/apexcharts.min.js') }}"></script>
  <script src="{{ asset('template/assets/libs/simplebar/dist/simplebar.js') }}"></script>
  <script src="{{ asset('template/assets/js/dashboard.js') }}"></script>
  <script src=" https://cdn.jsdelivr.net/npm/sweetalert2@11.15.0/dist/sweetalert2.all.min.js "></script>

  @if (session('success'))
    <script>
      Swal.fire({
        icon: 'success',
        title: 'Berhasil',
        text: '{{session('success')}}',
      })
    </script>
  @endif
  @if (session('error'))
    <script>
      Swal.fire({
        icon: 'error',
        title: 'Gagal',
        text: '{{session('error')}}',
      })
    </script>
  @endif
  
</body>

</html>