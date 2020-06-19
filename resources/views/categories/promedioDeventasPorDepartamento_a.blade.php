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
                <div class="col-lg-3">
                    <div class="sticky-top mb-3">
                        <div class="card card-purple card-outline">
                            <div class="card-header">
                                <b>Categorias</b>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    @foreach($all_categories as $all_category)
                                        <div class="col-6">
                                            <div class="external-event bg-gradient-purple" style="position: relative;">
                                                <a href="/reportes/categories_promedio/{{$all_category->id}}" class="text-black-50">{{$all_category->category}}</a>
                                            </div>
                                            <hr>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <b>Promedio de ventas por departamento</b>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example3" class="table table-striped elevation-2">
                                <thead>
                                <tr>
                                    <th>Departamentos</th>
                                    <th>Productos</th>
                                    <th>Cantidad</th>
                                    <th>Total Por Ventas</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($categorias as $categoria)
                                    <tr>
                                        <td>{{$categoria->departamento}}</td>
                                        <td>{{$categoria->producto}}</td>
                                        <td>&ensp;&ensp;&ensp;{{$categoria->cantidad}}</td>
                                        <td>&ensp;&ensp;&ensp;{{$categoria->totalVenta}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Departamentos</th>
                                    <th>Productos</th>
                                    <th>Cantidad</th>
                                    <th>Total Por Ventas</th>
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
