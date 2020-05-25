<div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand-md navbar-light navbar-white elevation-1">
        <div class="container">
            <a href="/home" class="navbar-brand">
                <img src="{{asset("/images/logo1.jpg")}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
                     style="opacity: .8; width: 35px;">
                <span class="brand-text font-weight-light">WonderFuL</span>
            </a>

            <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse order-3" id="navbarCollapse">
                <!-- Left navbar links -->
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Ordenes</a>
                        <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                            <li class="dropdown-divider"></li>
                            <li><a href="/reportes/detalleOrdenesPorCliente" class="dropdown-item">10. Detalle Orden </a></li>
                            <li class="dropdown-divider"></li>
                            <li class="dropdown-divider"></li>
                            <li><a href="/orders_initial" class="dropdown-item">Estado Inicial </a></li>
                            <li class="dropdown-divider"></li>
                            <li><a href="/orders_process" class="dropdown-item">Estado En Proceso </a></li>
                        </ul>
                    </li>
                </ul>

                <!-- SEARCH FORM -->
                <form class="form-inline ml-0 ml-md-3">
                    <div class="input-group input-group-sm">
                        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-navbar" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Right navbar links -->
            <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
                {{-- ESTO ES  PARA LOGUEARSE  --}}
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->first_name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest

                <li class="nav-item">
                    <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#"><i
                            class="fas fa-th-large"></i></a>
                </li>
            </ul>
        </div>
    </nav>
    <!-- /.navbar -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @yield('content')
        <!-- Main content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
        <div class="p-3">
            <h5>Title</h5>
            <p>Sidebar content</p>
        </div>
    </aside>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    <footer class="main-footer">
        <!-- To the right -->
        <div class="float-right d-none d-sm-inline">
            Anything you want
        </div>
        <!-- Default to the left -->
        <strong>Copyright &copy; 2014-2019 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
    </footer>
</div>
<!-- ./wrapper -->
