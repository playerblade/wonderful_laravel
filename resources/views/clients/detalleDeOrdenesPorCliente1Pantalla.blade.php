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
        {{--                <div class="card-header">--}}
        {{--                    <h3 class="card-title">DataTable with default features</h3>--}}
        {{--                </div>--}}
                        <!-- /.card-header -->
                        <div class="card-body">
{{--                            table-striped projects  otro estilo=> table-bordered--}}
                            <table id="example1" class="table table-striped elevation-2">
                                <thead>
                                <tr>
                                    <th class="text-center">&ensp; ID</th>
                                    <th>Cliente</th>
                                    <th>Telefono</th>
                                    <th>Genero</th>
                                    <th>Usuario</th>
                                    <th>Activo</th>
                                    <th>Ver Ordenes</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($clients as $client)
                                        <tr>
                                            <th class="text-center">{{$client->id}}</th>
                                            <td>{{$client->cliente}}</td>
                                            <td>{{$client->telefono}}</td>
                                            <td>{{$client->genero}}</td>
                                            <td>{{$client->user}}</td>
                                            @if($client->activo == 'activo')
                                                <td><span class="right badge badge-success">{{$client->activo}}</span></td>
                                            @endif
                                            @if($client->activo == 'inactivo')
                                                <td><span class="right badge badge-danger">{{$client->activo}}</span></td>
                                            @endif
                                            <td>
                                                <button type="submit" class="btn">
                                                    <a class="btn btn-info btn-sm elevation-1" href="/reportes/cliente/{{$client->id}}/ordenes">
                                                        <i class="fas fa-eye"></i> ver
                                                    </a>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th class="text-center">&ensp; ID</th>
                                    <th>Cliente</th>
                                    <th>Telefono</th>
                                    <th>Genero</th>
                                    <th>Usuario</th>
                                    <th>Activo</th>
                                    <th>Ver Ordenes</th>
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
