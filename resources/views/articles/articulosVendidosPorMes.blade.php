@extends('layouts.menuAdmin')
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
                <div class="col-lg-12">
                    <div class="card card-primary card-outline">
                    {{--                <div class="card-header">--}}
                    {{--                    <h3 class="card-title">DataTable with default features</h3>--}}
                    {{--                </div>--}}
                    <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-striped elevation-2">
                                <thead>
                                <tr>
                                    <th>Producto</th>
                                    <th>Cantidad</th>
                                    <th>Mes</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($articles as $article)
                                    <tr>
                                        <td>{{$article->producto}}</td>
                                        <td>{{$article->cantidad}}</td>
                                        <td>{{$article->mes}}</td>
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
                                    <th>Producto</th>
                                    <th>Cantidad</th>
                                    <th>Mes</th>
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
