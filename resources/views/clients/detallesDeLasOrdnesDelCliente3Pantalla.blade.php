@extends('layouts.admin.app')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Ordenes</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/home">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="/reportes/detalle_ordenes_por_cliente">Clientes</a></li>
                        @if($orderDetails)
                        <li class="breadcrumb-item"><a href="/reportes/cliente/{{$orderDetails[0]->client_id}}/ordenes">Ordenes</a></li>
                        @else
{{--                            empty--}}
                        @endif
                        <li class="breadcrumb-item active">Detalle Orden</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- /.col-md-6 -->
                <div class="col-lg-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <div class="row">
                                @if($orderDetails)
                                    <div class="col-6 float-left">
                                        <h3 class="card-title"><b>Orden:</b>&ensp; {{$orderDetails[0]->order_id}}</h3><br>
                                        <h3 class="card-title"><b>Cliente:</b>&ensp; {{$orderDetails[0]->cliente}}</h3>
                                    </div>
                                    <div class="col-6 float-right">
                                        <h3 class="card-title"><b>Fecha:</b>&ensp; {{$orderDetails[0]->fecha}}</h3>
                                        @if($totalAmounts)
                                            <h3 class="card-title float-right"><b>Total:</b>&ensp; {{$totalAmounts[0]->montoTotal}}</h3>
                                        @else
                                            No hay datos...
                                        @endif
                                    </div>
                                @else
                                    <div class="col-12">
                                        <h2 class="card-title"><b>No hay registros disponibles de la orden</b></h2>
                                    </div>
                                @endif
                            </div>
                        </div>
                    <!-- /.card-header -->
                        <div class="card-body">
                            {{--                            table-striped projects  otro estilo=> table-bordered--}}
                            <table id="example3" class="table table-striped elevation-2">
                                <thead>
                                <tr>
                                    <th class="text-center">&ensp;&ensp;ID</th>
                                    <th>Articulo</th>
                                    <th>Precio</th>
                                    <th>Cantidad</th>
                                    <th>Sub Total</th>
                                    <th>Color</th>
                                    <th>Ver Articulo</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($orderDetails as $orderDetail)
                                        <tr>
                                            <th class="text-center">{{$orderDetail->article_id}}</th>
                                            <td>{{$orderDetail->articulo}}</td>
                                            <td>{{$orderDetail->precio}}</td>
                                            <td>{{$orderDetail->cantidad}}</td>
                                            <td>{{$orderDetail->subTotal}}</td>
                                            <td>
                                                <img class="img-circle fa-2x" style="width: 35px; height: 35px;" src="{{asset('/imagenes/imagenes_articulos/'.$orderDetail->color)}}" alt="">
                                            </td>
                                            <td>
                                                <button type="submit" class="btn">
                                                    <a class="btn bg-success elevation-1 btn-sm" href="/reportes/cliente/orden/detalle_orden/{{$orderDetail->article_id}}/articulo">
                                                        <i class="fas fa-eye"></i>
                                                        <span class="right badge badge-success">Ver</span>
                                                        {{--                                                    &ensp;Ver | {{$orderDetail->articulo}}--}}
                                                    </a>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th class="text-center">&ensp;ID</th>
                                    <th>Articulo</th>
                                    <th>Precio</th>
                                    <th>Cantidad</th>
                                    <th>Sub Total</th>
                                    <th>Color</th>
                                    <th>Ver Articulo</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
@endsection
