<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>WonderFuL</title>

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

</head>
    <body class="hold-transition layout-top-nav">
        <section class="wrapper">
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
        </section>
        <!-- ./wrapper -->
    </body>
</html>
<!-- jQuery -->
<script src="{{asset("/admin-lte/plugins/jquery/jquery.min.js")}}"></script>
{{--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>--}}
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
<!-- OPTIONAL SCRIPTS -->
<script src="{{asset("/admin-lte/plugins/chart.js/Chart.min.js")}}"></script>
<!-- AdminLTE -->
<script src="{{asset("/admin-lte/dist/js/adminlte.js")}}"></script>
<!-- ADMINLTE DEMO SCRIPTS -->
<script src="{{asset("/admin-lte/dist/js/demo.js")}}"></script>
<!--SCRIPTS PARA LAS TABLAS-->
<script>
    $(function () {
        // habilitar todos
        $("#example1").DataTable();
        $("#example2").DataTable();
        // habilitarlos 1 por 1
        // $('#example2').DataTable({
        //     "paging": true,
        //     "lengthChange": false,
        //     "searching": false,
        //     "ordering": true,
        //     "info": true,
        //     "autoWidth": false,
        // });
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

@yield('script_for_search')
