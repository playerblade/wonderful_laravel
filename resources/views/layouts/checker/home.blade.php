@extends('layouts.checker.app')
@section('content')
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
    <!-- /.content-header -->
    <div class="content">
{{--        <div class="container">--}}
            <div class="row">
                <div class="col-1">

                </div>
                <div class="col-4">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h4></h4>
                        </div>
                        <div class="card-body text-center">
                            <div class="row">
                                <div class="col-6 d-xl-flex justify-content-lg-center">
                                    <div class="card bg-light">
                                        <a href="/orders_dispatched">
                                            <img src="{{asset('/imagenes/imagenes_estados/despachado.jpg')}}" alt="">
                                        </a>
                                        <b>Estado Despachado</b>
                                    </div>
                                </div>
                                {{--                        ./ card--}}
                                <div class="col-6 d-xl-flex justify-content-lg-center">
                                    <div class="card bg-light">
                                        <a href="/orders_delivered">
                                            <img src="{{asset('/imagenes/imagenes_estados/entregado.jpg')}}" alt="">
                                        </a>
                                        <b>Estado Entregado</b>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.col-md-6 -->
                <div class="col-6">
                    <div class="card card-outline card-primary">
                        <div class="card-body ">
                            <table id="example3" class="table table-striped elevation-2">
                                <thead>
                                <tr>
                                    <th>Numero de Orden</th>
                                    <th>Estado</th>
                                    <th>Fecha</th>
                                    <th>Usuario</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($order_for_users_system as $order)
                                    <tr>
                                        @if($order->active == 1)
                                            <th class="text-center">{{$order->order_id}}</th>
                                            @if($order->estado == 'initial')
                                                <td><span class="right badge badge-secondary">{{$order->estado}}</span></td>
                                            @endif
                                            @if($order->estado == 'process')
                                                <td><span class="right badge badge-primary">{{$order->estado}}</span></td>
                                            @endif
                                            @if($order->estado == 'dispatched')
                                                <td><span class="right badge badge-info">{{$order->estado}}</span></td>
                                            @endif
                                            @if($order->estado == 'delivered')
                                                <td><span class="right badge badge-success">{{$order->estado}}</span></td>
                                            @endif
                                            <td>{{$order->fechaOrden}}</td>
                                            @if($order->estado == 'initial')
                                                <td><span class="right badge badge-secondary">{{$order->usuario}}</span></td>
                                            @else
                                                <td>{{$order->usuario}}</td>
                                            @endif

                                        @else
                                            <th style="opacity: .4" class="text-center"><span class="right badge badge-danger">{{$order->order_id}}</span></th>
                                            @if($order->active == 0)
                                                <td style="opacity: .4;"><span class="right badge badge-danger">Cancelado</span></td>
                                            @else
                                                @if($order->estado == 'initial')
                                                    <td style="opacity: .4"><span class="right badge badge-secondary">{{$order->estado}}</span></td>
                                                @endif
                                                @if($order->estado == 'process')
                                                    <td style="opacity: .4"><span class="right badge badge-primary">{{$order->estado}}</span></td>
                                                @endif
                                            @endif
                                            <td style="opacity: .4"><span class="right badge badge-danger">{{$order->fechaOrden}}</span></td>
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
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
{{--        </div>--}}
        <!-- /.container-fluid -->
    </div>
@endsection
