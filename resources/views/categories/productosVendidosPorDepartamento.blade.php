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
                                <b>Fechas</b>
                            </div>
                            <form action="{{route('categorias_a')}}">
                                <div class="card-body">
                                    <input type="date" name="date_1" class="form-control">
                                    <hr>
                                    <input type="date" name="date_2" class="form-control">
                                </div>
                                <div class="card-footer">
                                    <button class="btn btn-block bg-gradient-purple btn-sm">Buscar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-lg-9">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <b>Ventas</b>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example3" class="table table-striped elevation-2">
                                <thead>
                                <tr>
                                    <th>Departamentos</th>
                                    <th class="text-center">Catidad de Ventas</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($categories as $category)
                                    <tr>
                                        <td>{{$category->departamentos}}</td>
                                        <td class="text-center">{{$category->cantidadVentas}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Departamentos</th>
                                    <th class="text-center">Catidad de Ventas</th>
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
