<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Wonderful | Admin') }}</title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{asset("/admin-lte/plugins/fontawesome-free/css/all.min.css")}}">
    <!-- IonIcons -->
    <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- daterange picker -->
    <link rel="stylesheet" href="{{asset("/admin-lte/plugins/daterangepicker/daterangepicker.css")}}">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="{{asset("/admin-lte/plugins/icheck-bootstrap/icheck-bootstrap.min.css")}}">
    <!-- Bootstrap Color Picker -->
    <link rel="stylesheet" href="{{asset("/admin-lte/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css")}}">
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet" href="{{asset("/admin-lte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css")}}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{asset("/admin-lte/plugins/select2/css/select2.min.css")}}">
    <link rel="stylesheet" href="{{asset("/admin-lte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css")}}">
    <!-- Bootstrap4 Duallistbox -->
    <link rel="stylesheet" href="{{asset("/admin-lte/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css")}}">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{asset("/admin-lte/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css")}}">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{asset("/admin-lte/plugins/toastr/toastr.min.css")}}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset("/admin-lte/plugins/datatables-bs4/css/dataTables.bootstrap4.css")}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset("/admin-lte/dist/css/adminlte.min.css")}}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <style>
        .navWonder{
            background: #1a2226;
        }

        .navMenu{
            background: #222d32;
        }
        .heightMenu{
            height: 10%;
        }
    </style>
</head>
{{--layout-navbar-fixed--}}
<body class="hold-transition sidebar-mini">
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

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{asset("/admin-lte/plugins/jquery/jquery.min.js")}}"></script>
<!-- Bootstrap -->
<script src="{{asset("/admin-lte/plugins/bootstrap/js/bootstrap.bundle.min.js")}}"></script>
<!-- Select2 -->
<script src="{{asset("/admin-lte/plugins/select2/js/select2.full.min.js")}}"></script>
<!-- Bootstrap4 Duallistbox -->
<script src="{{asset("/admin-lte/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js")}}"></script>
<!-- bs-custom-file-input -->
<script src="{{asset("/admin-lte/plugins/bs-custom-file-input/bs-custom-file-input.min.js")}}"></script>
<!-- InputMask -->
<script src="{{asset("/admin-lte/plugins/moment/moment.min.js")}}"></script>
<script src="{{asset("/admin-lte/plugins/inputmask/min/jquery.inputmask.bundle.min.js")}}"></script>
<!-- date-range-picker -->
<script src="{{asset("/admin-lte/plugins/daterangepicker/daterangepicker.js")}}"></script>
<!-- bootstrap color picker -->
<script src="{{asset("/admin-lte/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js")}}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{asset("/admin-lte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js")}}"></script>
<!-- Bootstrap Switch -->
<script src="{{asset("/admin-lte/plugins/bootstrap-switch/js/bootstrap-switch.min.js")}}"></script>
<!-- SweetAlert2 -->
<script src="{{asset("/admin-lte/plugins/sweetalert2/sweetalert2.min.js")}}"></script>
<!-- Toastr -->
<script src="{{asset("/admin-lte/plugins/toastr/toastr.min.js")}}"></script>
<!-- DataTables -->
<script src="{{asset("/admin-lte/plugins/datatables/jquery.dataTables.js")}}"></script>
<script src="{{asset("/admin-lte/plugins/datatables-bs4/js/dataTables.bootstrap4.js")}}"></script>
<!-- AdminLTE -->
<script src="{{asset("/admin-lte/dist/js/adminlte.js")}}"></script>
<!-- OPTIONAL SCRIPTS -->
<script src="{{asset("/admin-lte/plugins/chart.js/Chart.min.js")}}"></script>

<script src="{{asset("/admin-lte/dist/js/demo.js")}}"></script>
<!-- DASHBOARD LAST VERSION-->
<script src="{{asset("/admin-lte/dist/js/pages/dashboard3.js")}}"></script>
<!--SCRIPTS PARA LAS TABLAS-->
<script>
    $(function () {
        $("#example1").DataTable();
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
        });
    });
</script>

<script type="text/javascript">
    $(function() {
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });

        $('.swalDefaultSuccess').click(function() {
            Toast.fire({
                type: 'success',
                title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
            })
        });
        $('.swalDefaultInfo').click(function() {
            Toast.fire({
                type: 'info',
                title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
            })
        });
        $('.swalDefaultError').click(function() {
            Toast.fire({
                type: 'error',
                title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
            })
        });
        $('.swalDefaultWarning').click(function() {
            Toast.fire({
                type: 'warning',
                title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
            })
        });
        $('.swalDefaultQuestion').click(function() {
            Toast.fire({
                type: 'question',
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
<script>
    $(function () {
      //Initialize Select2 Elements
      $('.select2').select2()
  
      //Initialize Select2 Elements
      $('.select2bs4').select2({
        theme: 'bootstrap4'
      })
  
      //Datemask dd/mm/yyyy
      $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
      //Datemask2 mm/dd/yyyy
      $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
      //Money Euro
      $('[data-mask]').inputmask()
  
      //Date range picker
      $('#reservation').daterangepicker()
      //Date range picker with time picker
      $('#reservationtime').daterangepicker({
        timePicker: true,
        timePickerIncrement: 30,
        locale: {
          format: 'MM/DD/YYYY hh:mm A'
        }
      })
      //Date range as a button
      $('#daterange-btn').daterangepicker(
        {
          ranges   : {
            'Today'       : [moment(), moment()],
            'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month'  : [moment().startOf('month'), moment().endOf('month')],
            'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
          },
          startDate: moment().subtract(29, 'days'),
          endDate  : moment()
        },
        function (start, end) {
          $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
        }
      )
  
      //Timepicker
      $('#timepicker').datetimepicker({
        format: 'LT'
      })
      
      //Bootstrap Duallistbox
      $('.duallistbox').bootstrapDualListbox()
  
      //Colorpicker
      $('.my-colorpicker1').colorpicker()
      //color picker with addon
      $('.my-colorpicker2').colorpicker()
  
      $('.my-colorpicker2').on('colorpickerChange', function(event) {
        $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
      });
  
      $("input[data-bootstrap-switch]").each(function(){
        $(this).bootstrapSwitch('state', $(this).prop('checked'));
      });
  
    })
  </script>
  
  <script type="text/javascript">
    $(document).ready(function () {
      bsCustomFileInput.init();
    });
  </script>

@yield('scriptsBarChart')
@yield('scriptReadMore')
@yield('modal_edit')
</body>
</html>
