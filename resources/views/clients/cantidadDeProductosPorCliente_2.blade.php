@extends('layouts.menuAdmin')
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
                        <li class="breadcrumb-item active">Clientes</li>
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
                        <b>Clientes</b>
                    </div>
                    <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-striped elevation-2">
                                <thead>
                                <tr>
                                    <th>Cliente</th>
                                    <th>Cantidad De Producto</th>
                                    <th>Anio</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($clients as $client)
                                    <tr>
                                        <td>{{$client->cliente}}</td>
                                        <td>{{$client->cantidadProducto}}</td>
                                        <td>{{$client->anio}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Cliente</th>
                                    <th>Cantidad De Producto</th>
                                    <th>Anio</th>
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
