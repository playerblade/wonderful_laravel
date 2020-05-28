<div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light elevation-2">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a class="navbar-brand" href="{{ url('/home') }}">
                    {{'Inicio'}}
                </a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="#" class="nav-link">Contact</a>
            </li>
        </ul>

        <!-- SEARCH FORM -->
        <form class="form-inline ml-3">
            <div class="input-group input-group-sm">
                <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-navbar" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </form>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <!-- Authentication Links -->
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
                {{--               logout o perfil--}}
                <li class="nav-item dropdown user-menu">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <img src="{{asset("/admin-lte/dist/img/user3-128x128.jpg")}}" class="user-image img-circle elevation-2" alt="User Image">
                        <span class="d-none d-md-inline">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</span>
                        &ensp;<i class="fas fa-power-off"></i>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <!-- User image -->
                        <li class="user-header bg-dark">
                            <img src="{{asset("/admin-lte/dist/img/user3-128x128.jpg")}}" class="img-circle elevation-2" alt="User Image">
                            <p>
                                {{ Auth::user()->first_name }} {{ Auth::user()->last_name }} {{ Auth::user()->mother_last_name }}
                                <br> Adminstrador
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <a href="#" class="btn btn-default btn-flat">Profile</a>
                            <a class="btn btn-default btn-flat float-right"
                               href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                {{ __('Salir') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </li>
            @endguest
            <li class="nav-item">
                <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#"><i
                        class="fas fa-th-large"></i></a>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    {{--    sidebar-dark-primary--}}
    <aside class="main-sidebar navWonder sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="/" class="brand-link">
            {{--            {{asset("/admin-lte/dist/img/AdminLTELogo.png")}}--}}
            <img src="{{asset("/images/logo1.jpg")}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
                 style="opacity: .8">
            <span class="brand-text font-weight-light">WonderFuL</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar heightMenu">
            <!-- Sidebar user panel (optional) -->
            <div class="mt-2 pb-4 mb-2 d-flex">
                &ensp;
                <div class="image">
                    <img src="{{asset("/admin-lte/dist/img/user3-128x128.jpg")}}" class="img-circle elevation-2" alt="User Image" style="width: 43px; height: 43px;">
                </div>
                &ensp;&ensp;
                <div class="info">
                    <a href="#" class="d-block">
                        {{ Auth::user()->first_name }} {{ Auth::user()->last_name }} {{ Auth::user()->mother_last_name }}
                    </a>
                    <a href="#"><i class="fa fa-circle text-success"></i> Online <br>{{session(['auth'])}} </a>
                </div>
            </div>
            <!-- Sidebar Menu -->
            <nav class="mt-2 navMenu">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-copy"></i>
                            <p>
                                Reportes
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="/reportes/articulos" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p> 1.- Productos mas</p> <br> &ensp;&ensp;&ensp;&ensp;
                                    <p>vendidos por mes</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/reportes/clientes" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p> 2.- Clientes que mass</p> <br> &ensp;&ensp;&ensp;&ensp;
                                    <p>compraron por anio</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/reportes/categorias" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p> 3.- Ventas por Departamento</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/reportes/categories_promedio" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p> 4.- Promedio de productos</p> <br> &ensp;&ensp;&ensp;&ensp;
                                    <p>vendidos por departamento</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/reportes/colaboradores/ordenes_despachados" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p> 7.- Lista de colaboradores</p> <br> &ensp;&ensp;&ensp;&ensp;
                                    <p>y ordenes que despacharon</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/reportes/usuarios_verificadores" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p> 8.- Lista de verificadores con</p> <br> &ensp;&ensp;&ensp;&ensp;
                                    <p>sus cantidades de ordenes entregados</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/reportes/raitings/raiting_comentarios_articulos" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p> 9.- Raiting y comentarios</p> <br> &ensp;&ensp;&ensp;&ensp;
                                    <p>de los productos</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            {{-- <i class="fa fa-area-chart"></i> --}}
                            <i class="nav-icon fas fa-edit" aria-hidden="true"></i>
                            <p>
                                Reportes Estadisticos
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="/reportes/categories_promedio_chart" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p> 4.- Promedio de productos</p> <br> &ensp;&ensp;&ensp;&ensp;
                                    <p>vendidos por departamento</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/reportes/ventas_ciudades" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p> 5.- Promedio de ventas por ciudad</p>
                                    {{--                                    <br> &ensp;&ensp;&ensp;&ensp;--}}
                                    {{--                                    <p>de los productos</p>--}}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/reportes/ventas/{{1}}/articulos_promedio_ventas_ciudades" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p> 6.- Promedio de productos por ciudades</p>
                                    {{--                                    <br> &ensp;&ensp;&ensp;&ensp;--}}
                                    {{--                                    <p>de los productos</p>--}}
                                </a>
                            </li>
                        </ul>
                    </li>

                    {{--                    ordenes --}}
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-table"></i>
                            <p>
                                Ordenes
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="/reportes/detalle_ordenes_por_cliente" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p> 10.- Detalle Orden</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    {{-- GESTIOANR  ===== >>>> CRUDs --}}
                    <li class="nav-header">ADMINISTRAR</li>
                    <li class="nav-item">
                        <a href="{{ route('articles.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-tv"></i>
                            <p>
                                Articulos
                                {{-- <span class="badge badge-info right">2</span> --}}
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('categories.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-align-justify"></i>
                            <p>
                                Categorias
                                {{-- <span class="badge badge-info right">2</span> --}}
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('sub_categories.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-list-ul"></i>
                            <p>
                                Sub Categorias
                                {{-- <span class="badge badge-info right">2</span> --}}
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('colors.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Colores
                                {{-- <span class="badge badge-info right">2</span> --}}
                            </p>
                        </a>
                    </li>
{{--                    FIN ADMINSTRAR--}}

                    {{-- GESTIOANR  ===== >>>> Usuarios --}}
                    <li class="nav-header">USUARIOS</li>
                    <li class="nav-item">
                        <a href="{{ route('users.index') }}" class="nav-link">
{{--                            <i class="nav-icon fas fa-user-plus"></i>--}}
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                Usuarios
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('clients.index') }}" class="nav-link">
                            {{--                            <i class="nav-icon fas fa-user-plus"></i>--}}
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                Clientes
                            </p>
                        </a>
                    </li>
                    {{--      FIN             GESTIOANR  ===== >>>> Usuarios --}}
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        @yield('content')
    </div>
    <!-- /.content-wrapper -->
    <!-- /.Footer -->
    <footer class="main-footer">
        <div class="float-right d-none d-sm-block">
            <b>Version</b> 3.0.2
        </div>
        <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong> All rights
        reserved.
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
