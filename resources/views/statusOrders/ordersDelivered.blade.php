@extends('layouts.checker.app')
@section('content')
    <section class="content-header">
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
    </section>
    <section class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h4></h4>
                        </div>
                        <div class="card-body">
                            <table id="example3" class="table table-striped elevation-2">
                                <thead>
                                <tr>
                                    <th>Numero de Orden</th>
                                    <th>Estado</th>
                                    <th>Fecha</th>
                                    <th>Usuario</th>
{{--                                    <th>Cambiar Estado A:</th>--}}
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($order_delivered as $order)
                                    <tr>
                                        @if($order->active == 1)
                                            <th class="text-center">{{$order->order_id}}</th>
                                            @if($order->estado == 'delivered')
                                                <td><span class="right badge badge-success">{{$order->estado}}</span></td>
                                            @endif
                                            <td>{{$order->fechaOrden}}</td>
                                            <td>{{$order->usuario}}</td>
                                        @else
                                        <!-- <td><span class="right badge badge-danger">Cancelado</span></td> -->
                                            <th style="opacity: .4" class="text-center">{{$order->order_id}}</th>
                                            @if($order->active == 0)
                                                <td style="opacity: .4;"><span class="right badge badge-danger">Cancelado</span></td>
                                            @else
                                                @if($order->estado == 'delivered')
                                                    <td style="opacity: .4"><span class="right badge badge-success">{{$order->estado}}</span></td>
                                                @endif
                                            @endif
                                            <td style="opacity: .4">{{$order->fechaOrden}}</td>
                                            <td style="opacity: .4"><span class="right badge badge-danger">{{$order->usuario}}</span></td>
                                        @endif

                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Numero de Orden</th>
                                    <th>Estado</th>
                                    <th>Fecha</th>
                                    <th>Usuario</th>
{{--                                    <th>Cambiar Estado A:</th>--}}
                                    {{--                                    <th>Color</th>--}}
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.col-md-6 -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
@endsection
@section('script_reload_this_page')
    <script>
        $(document).ready(function () {
            setTimeout(refresh,1000);
        });
        function refresh() {
            // location.reload();
            // $("#refresh").load("http://127.0.0.1:8000/orders_initial");
        }
    </script>
@endsection
