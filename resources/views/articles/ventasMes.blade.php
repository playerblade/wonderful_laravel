@extends('layouts.admin.app')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Articulos</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/home">Inicio</a></li>
                        <li class="breadcrumb-item active">Articulos</li>
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
                <div class="col-md-3">
                    <div class="sticky-top mb-3">
                        <div class="card card-purple card-outline">
                            <div class="card-header">
                                <b>Months</b>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <di class="col-6">
                                        @foreach($months1 as $month)
                                            <div class="external-event bg-gradient-purple" style="position: relative;">
                                                <a href="/ventas_mes/{{$mes_id2++}}" class="text-black-50">{{$month}}</a>
                                            </div>
                                            <hr>
                                        @endforeach
                                    </di>
                                    <di class="col-6">
                                        @foreach($months2 as $month)
                                            <div class="external-event bg-gradient-purple" style="position: relative;">
                                                <a href="/ventas_mes/{{$mes_id2++}}" class="text-black-50">{{$month}}</a>
                                            </div>
                                            <hr>
                                        @endforeach
                                    </di>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="card card-info card-outline">
                    <div class="card-header">
                        <b>Articulos</b>
                    </div>
                    <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example3" class="table table-striped elevation-2">
                                <thead>
                                <tr>
                                    <th>Mes</th>
                                    <th>Producto</th>
                                    <th>Cantidad Vendido</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($articles as $article)
                                    <tr>
                                        <td>{{$article->mes}}</td>
                                        <td>{{$article->producto}}</td>
                                        <td>{{$article->cantidad}}</td>
        {{--                                        <td>--}}
        {{--                                            <button type="submit" class="btn">--}}
        {{--                                                <a class="btn btn-info btn-sm elevation-1" href="/reportes/cliente/{{$client->id}}/ordenes">--}}
        {{--                                                    <i class="fas fa-eye"></i> ver--}}
        {{--                                                </a>--}}
        {{--                                            </button>--}}
        {{--                                        </td>--}}
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Mes</th>
                                    <th>Producto</th>
                                    <th>Cantidad Vendido</th>
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
