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
                        <li class="breadcrumb-item active">Ordenes</li>
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
                                        @if($orders)
                                            <h3 class="card-title">Ordenes: <b><u>{{$orders[0]->cliente}}</u></b></h3>
                                        @else
                                            <h3 class="card-title">Ordenes: <b> No tiene ordenes.</b></h3>
                                        @endif
                                    </div>
                    <!-- /.card-header -->
                        <div class="card-body">
                            {{--                            table-striped projects  otro estilo=> table-bordered--}}
                            <table id="example1" class="table table-striped elevation-2">
                                <thead>
                                <tr>
                                    <th>&ensp; Numero de orden</th>
                                    <th>Estado</th>
                                    <th>Fecha</th>
                                    <th>Usuario</th>
                                    <th>Ver Detalle</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($orders as $order)
                                    <tr>
                                        <th>&ensp; {{$order->order_id}}</th>
                                        @if($order->estado == 'inicial')
                                            <td><span class="right badge badge-secondary">{{$order->estado}}</span></td>
                                        @endif
                                        @if($order->estado == 'proceso')
                                            <td><span class="right badge badge-primary">{{$order->estado}}</span></td>
                                        @endif
                                        @if($order->estado == 'preparacion')
                                            <td><span class="right badge badge-info">{{$order->estado}}</span></td>
                                        @endif
                                        @if($order->estado == 'despachado')
                                            <td><span class="right badge badge-warning">{{$order->estado}}</span></td>
                                        @endif
                                        @if($order->estado == 'entregado')
                                            <td><span class="right badge badge-success">{{$order->estado}}</span></td>
                                        @endif
                                        <td>{{$order->fechaOrden}}</td>
{{--                                        cuando el estado es inicial se matiene el usuario como el cliente mismo--}}
                                        @if($order->estado == 'inicial')
                                            <td><span class="right badge badge-secondary">{{$order->cliente}}</span></td>
                                        @else
                                            <td>{{$order->usuario}}</td>
                                        @endif
                                        {{--              disabled   @if($order->activo == 'activo')--}}
                                        <td>
                                            <button type="submit" class="btn">
                                                <a class="btn bg-purple elevation-1 btn-sm" href="/reportes/cliente/orden/{{$order->order_id}}/detalle_orden">
                                                    <i class="fas fa-eye"></i> ver
                                                </a>
                                            </button>
                                        </td>

                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>&ensp; Numero de orden</th>
                                    <th>Estado</th>
                                    <th>Fecha</th>
                                    <th>Usuario</th>
                                    <th>Ver Detalle</th>
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
