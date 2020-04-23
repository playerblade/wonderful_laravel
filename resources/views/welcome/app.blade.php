<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>WonderFuL</title>

    <link rel="stylesheet" href="{{asset("/admin-lte/plugins/fontawesome-free/css/all.min.css")}}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{asset("/admin-lte/plugins/select2/css/select2.min.css")}}">
    <link rel="stylesheet" href="{{asset("/admin-lte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css")}}">

    <link rel="stylesheet" href="{{asset("/admin-lte/dist/css/adminlte.min.css")}}">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
    <body class="hold-transition layout-top-nav">
        <div class="wrapper">
            <!-- Navbar -->
            <nav class="main-header navbar navbar-expand-md navbar-light navbar-white elevation-1">
                <div class="container">
                    <a href="../../index3.html" class="navbar-brand">
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
                            <li class="nav-item">
                                <a href="#" class="nav-link">Contact</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Dropdown</a>
                                <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                                    <li><a href="#" class="dropdown-item">Some action </a></li>
                                    <li><a href="#" class="dropdown-item">Some other action</a></li>

                                    <li class="dropdown-divider"></li>

                                    <!-- Level two dropdown-->
                                    <li class="dropdown-submenu dropdown-hover">
                                        <a id="dropdownSubMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Hover for action</a>
                                        <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">
                                            <li>
                                                <a tabindex="-1" href="#" class="dropdown-item">level 2</a>
                                            </li>

                                            <!-- Level three dropdown-->
                                            <li class="dropdown-submenu">
                                                <a id="dropdownSubMenu3" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">level 2</a>
                                                <ul aria-labelledby="dropdownSubMenu3" class="dropdown-menu border-0 shadow">
                                                    <li><a href="#" class="dropdown-item">3rd level</a></li>
                                                    <li><a href="#" class="dropdown-item">3rd level</a></li>
                                                </ul>
                                            </li>
                                            <!-- End Level three -->

                                            <li><a href="#" class="dropdown-item">level 2</a></li>
                                            <li><a href="#" class="dropdown-item">level 2</a></li>
                                        </ul>
                                    </li>
                                    <!-- End Level two -->
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
                        <!-- Messages Dropdown Menu -->
{{--                        <li class="nav-item dropdown">--}}
{{--                            <a class="nav-link" data-toggle="dropdown" href="#">--}}
{{--                                <i class="fas fa-comments"></i>--}}
{{--                                <span class="badge badge-danger navbar-badge">3</span>--}}
{{--                            </a>--}}
{{--                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">--}}
{{--                                <a href="#" class="dropdown-item">--}}
{{--                                    <!-- Message Start -->--}}
{{--                                    <div class="media">--}}
{{--                                        <img src="../../dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">--}}
{{--                                        <div class="media-body">--}}
{{--                                            <h3 class="dropdown-item-title">--}}
{{--                                                Brad Diesel--}}
{{--                                                <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>--}}
{{--                                            </h3>--}}
{{--                                            <p class="text-sm">Call me whenever you can...</p>--}}
{{--                                            <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <!-- Message End -->--}}
{{--                                </a>--}}
{{--                                <div class="dropdown-divider"></div>--}}
{{--                                <a href="#" class="dropdown-item">--}}
{{--                                    <!-- Message Start -->--}}
{{--                                    <div class="media">--}}
{{--                                        <img src="../../dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">--}}
{{--                                        <div class="media-body">--}}
{{--                                            <h3 class="dropdown-item-title">--}}
{{--                                                John Pierce--}}
{{--                                                <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>--}}
{{--                                            </h3>--}}
{{--                                            <p class="text-sm">I got your message bro</p>--}}
{{--                                            <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <!-- Message End -->--}}
{{--                                </a>--}}
{{--                                <div class="dropdown-divider"></div>--}}
{{--                                <a href="#" class="dropdown-item">--}}
{{--                                    <!-- Message Start -->--}}
{{--                                    <div class="media">--}}
{{--                                        <img src="../../dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">--}}
{{--                                        <div class="media-body">--}}
{{--                                            <h3 class="dropdown-item-title">--}}
{{--                                                Nora Silvester--}}
{{--                                                <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>--}}
{{--                                            </h3>--}}
{{--                                            <p class="text-sm">The subject goes here</p>--}}
{{--                                            <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <!-- Message End -->--}}
{{--                                </a>--}}
{{--                                <div class="dropdown-divider"></div>--}}
{{--                                <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>--}}
{{--                            </div>--}}
{{--                        </li>--}}
                        <!-- Notifications Dropdown Menu -->
{{--                        <li class="nav-item dropdown">--}}
{{--                            <a class="nav-link" data-toggle="dropdown" href="#">--}}
{{--                                <i class="far fa-bell"></i>--}}
{{--                                <span class="badge badge-warning navbar-badge">15</span>--}}
{{--                            </a>--}}
{{--                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">--}}
{{--                                <span class="dropdown-header">15 Notifications</span>--}}
{{--                                <div class="dropdown-divider"></div>--}}
{{--                                <a href="#" class="dropdown-item">--}}
{{--                                    <i class="fas fa-envelope mr-2"></i> 4 new messages--}}
{{--                                    <span class="float-right text-muted text-sm">3 mins</span>--}}
{{--                                </a>--}}
{{--                                <div class="dropdown-divider"></div>--}}
{{--                                <a href="#" class="dropdown-item">--}}
{{--                                    <i class="fas fa-users mr-2"></i> 8 friend requests--}}
{{--                                    <span class="float-right text-muted text-sm">12 hours</span>--}}
{{--                                </a>--}}
{{--                                <div class="dropdown-divider"></div>--}}
{{--                                <a href="#" class="dropdown-item">--}}
{{--                                    <i class="fas fa-file mr-2"></i> 3 new reports--}}
{{--                                    <span class="float-right text-muted text-sm">2 days</span>--}}
{{--                                </a>--}}
{{--                                <div class="dropdown-divider"></div>--}}
{{--                                <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>--}}
{{--                            </div>--}}
{{--                        </li>--}}
                        {{-- ESTO ES  PARA LOGUEARSE  --}}
                        {{-- <li class="nav-item"> --}}
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ url('/home') }}" class="nav-link">Home</a>
                            @else
                                <a href="{{ route('login') }}" class="nav-link">Login</a>

                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="nav-link">Register</a>
                                @endif
                            @endauth
                        @endif
                        {{-- </li> --}}
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
                <div class="content-header">
                    <div class="container">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1 class="m-0 text-dark"> Welcome To Wonderful <small>Version 1.0</small></h1>
                            </div><!-- /.col -->
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item"><a href="#">Layout</a></li>
                                    <li class="breadcrumb-item active">Top Navigation</li>
                                </ol>
                            </div><!-- /.col -->
                        </div><!-- /.row -->
                    </div><!-- /.container-fluid -->
                </div>
                <!-- Main content -->
                <section class="content">
                    @yield('content')
                </section>
                <!-- /.content -->
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
    </body>
</html>
<!-- jQuery -->
{{--<script src="{{asset('js/jquery-3.4.1/jquery.min.js')}}"></script>--}}
<script src="{{asset("/admin-lte/plugins/jquery/jquery.min.js")}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset("/admin-lte/plugins/bootstrap/js/bootstrap.bundle.min.js")}}"></script>
<!-- Select2 -->
<script src="{{asset("/admin-lte/plugins/select2/js/select2.full.min.js")}}"></script>
<!-- AdminLTE App -->
<script src="{{asset("/admin-lte/dist/js/adminlte.min.js")}}"></script>
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


